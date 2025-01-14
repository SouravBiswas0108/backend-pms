<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentAssignStaff;
use App\Models\EmployeeSubTask;
use App\Models\EmployeeTask;
use App\Models\Kra;
use App\Models\Mpms;
use App\Models\User;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (session()->has('year2')) {
            $year = session('year2');
            //dd($year);
        } else {
            $year = date('Y');
        }


        $departmentId = $request->departmentid;
        // dd($departmentId);

        $staffIdToFind = JWTAuth::user()->staff_id;
        // dd($staffIdToFind);


        $departmentName = Department::select('department_name')->where('department_id', $departmentId)->first();
        //    dd(123);
        $userInfo = DepartmentAssignStaff::where('department_id', $departmentId)->where('staff_id', $staffIdToFind)->where('year', $year)->first();
        // dd($userInfo);
        $staffDetails = User::with('userDetails')->where('staff_id', $userInfo['staff_id'])->get()->toArray();

        $supervisorDetails = User::with('userDetails')->where('staff_id', $userInfo['supervisor_id'])->get()->toArray();

        $officerDetails = User::with('userDetails')->where('staff_id', $userInfo['officer_id'])->get()->toArray();

        $UserDetails = [
            'staffDetails' => $staffDetails,
            'supervisorDetails' => $supervisorDetails,
            'officerDetails' => $officerDetails,
            'departmentName' => $departmentName->department_name,
        ];

        // Print or return the combined array


        // $formAIntial = [
        //     'UserDetails' => $UserDetails,

        // ];

    

        
        $etag = md5(json_encode($UserDetails));
        $response = response()->json($UserDetails);
        $response->header('mahadev-etag', $etag);
        $response->header('Access-Control-Expose-Headers', 'mahadev-etag');

        // return response()->json($UserDetails)
        //       ->header('mahadev-etag',$etag);
        return $response;
        // return response()->json([
        //     'status' => 'success',
        //     'form-A-Intial' => $UserDetails,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation
            $request->validate([
                'dept_id' => 'required|string',
                'year' => 'required|numeric',
                'quater' => 'required|numeric|in:1,2,3,4', // Main quarter validation
                'kras' => 'required|array',
                'kras.*.kra_title' => 'required|string',
                'kras.*.kra_weight' => 'required|numeric',
                'kras.*.objs' => 'required|array',
                'kras.*.objs.*.obj_title' => 'required|string',
                'kras.*.objs.*.obj_weight' => 'required|numeric',
                'kras.*.objs.*.gradeed_weight' => 'required|numeric',
                'kras.*.objs.*.target' => 'required|numeric',
                'kras.*.objs.*.kpi' => 'required|string',
                'kras.*.objs.*.quater' => 'required|numeric|in:1,2,3,4|same:quater', // Ensure same as root quater
            ], [
                'kras.*.objs.*.quater.same' => 'The quarter in the objectives must match the main quarter.',
            ]);

            // Retrieve data
            $data = $request->all();
            $year = $request->year;
            $staffId = JWTAuth::user()->staff_id;

            $kraName = [];
            // $employeeSubTask = [];  // Initialize the array here

            foreach ($data['kras'] as $key => $kra) {
                $kraName[] = $kra['kra_title'];

                // Find the KRA by title
                $kraRecord = Kra::where('kra_title', $kra['kra_title'])->firstOrFail();
                $kraId = $kraRecord->id;

                // Check if EmployeeTask already exists
                $exists = EmployeeTask::where('staff_id', $staffId)
                    ->where('dept_id', $data['dept_id'])
                    ->where('year', $year)->where('quater', $data['quater'])
                    ->where("kra_id", $kraId)
                    ->exists();

                if (!$exists) {
                    // Create EmployeeTask if it doesn't exist

                    $EmployeeTask = EmployeeTask::create([
                        "staff_id" => $staffId,
                        "dept_id" => $data['dept_id'],
                        "year" => $year,
                        "quater" => $data['quater'],
                        "kra_id" => $kraId,
                        "kra_weight" => $kra['kra_weight']
                    ]);

                    // Insert EmployeeSubTask
                    $employeeSubTask = [];

                    foreach ($kra["objs"] as $key => $obj) {
                        $employeeSubTask[] = [
                            "employee_tasks_id" => $EmployeeTask->id,
                            "objectives" => $obj['obj_title'],
                            "objective_weight" => $obj['obj_weight'],
                            "gradeed_weight" => $obj['gradeed_weight'],
                            "target" => $obj['target'],
                            "kpi" => $obj['kpi'],
                            "unit" => $obj['unit'],
                            "quater" => $obj['quater'],
                        ];
                    }
                    // Bulk insert EmployeeSubTask records
                    EmployeeSubTask::insert($employeeSubTask);
                } else {
                    // dd(123);
                    // Update EmployeeTask if it already exists
                    $EmployeeTaskUpdate = EmployeeTask::where('staff_id', $staffId)
                        ->where('dept_id', $data['dept_id'])
                        ->where('year', $year)->where('quater', $data['quater'])
                        ->where("kra_id", $kraId)
                        ->update(["kra_weight" => $kra['kra_weight']]);

                    // Get the EmployeeTask ID for further use
                    $EmployeeTaskUpdateId = EmployeeTask::where('staff_id', $staffId)
                        ->where('dept_id', $data['dept_id'])
                        ->where('year', $year)->where('quater', $data['quater'])
                        ->where("kra_id", $kraId)
                        ->first()->id;

                    // Optionally: Update EmployeeSubTask if necessary (you can decide based on business logic)
                    foreach ($kra["objs"] as $key => $obj) {
                        EmployeeSubTask::updateOrCreate(
                            ["employee_tasks_id" => $EmployeeTaskUpdateId, "objectives" => $obj['obj_title']],
                            [
                                "objective_weight" => $obj['obj_weight'],
                                "gradeed_weight" => $obj['gradeed_weight'],
                                "target" => $obj['target'],
                                "kpi" => $obj['kpi'],
                                "unit" => $obj['unit'],
                                "quater" => $obj['quater'],
                            ]
                        );
                    }
                }
            }

            return response()->json(["message" => "Tasks created/updated successfully"]);
        } catch (\Throwable $th) {
            // Log the error if necessary
            return response()->json(['error' => $th->getMessage()], 404);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        dd(123);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function employeeTask()
    {
        $employeeTasks = Mpms::with(['kras.objs'])->get();


        $response = $employeeTasks->map(function ($task) {
            return [
                'heading' => $task->heading,
                'kras' => $task->kras->map(function ($kra) {
                    // Group objs by obj_title
                    $groupedObjs = [];
                    $kra->objs->each(function ($obj) use (&$groupedObjs) {
                        // Check if obj_title already exists in the array
                        if (isset($groupedObjs[$obj->obj_title])) {
                            // Append kpi and target to the existing obj_title entry
                            $groupedObjs[$obj->obj_title]['kpi'][] = $obj->kpi;
                            $groupedObjs[$obj->obj_title]['target'][] = $obj->target;
                        } else {
                            // Create a new entry for obj_title
                            $groupedObjs[$obj->obj_title] = [
                                'obj_title' => $obj->obj_title,
                                'kpi' => [$obj->kpi], // Initialize as an array
                                'target' => [$obj->target], // Initialize target as an array
                            ];
                        }
                    });
        
                    return [
                        'kra_id' => $kra->id, // Add kra_id here
                        'kra_title' => $kra->kra_title,
                        'objs' => array_values($groupedObjs), // Convert associative array to indexed array
                    ];
                }),
            ];
        });
        
        
        

        return response()->json([
            'status' => 'success',
            'employeeTasks' => $response,
        ]);
    }


    public function data(Request $request){

        $departmentId = $request->departmentid;
        $year = $request->year;
        $quater = $request->quater;

        $staffIdToFind = JWTAuth::user()->staff_id;
        // dd($staffIdToFind);

       $SubmittedEmployeeTask = EmployeeTask::with(['savedemployeetask','kraDetails.mpms'])->where('dept_id',$departmentId)->where('year', $year)->where('quater',$quater)->where('staff_id',$staffIdToFind)->get()->toArray();
    //   $employeeSubTask = EmployeeSubTask::get()->toArray();
    // dd($SubmittedEmployeeTask);

      $transformedResponse = collect($SubmittedEmployeeTask)
    ->groupBy('dept_id')
    ->map(function ($tasks, $dept_id) use ($year) {
        return [
            'dept_id' => $dept_id,
            'year' => $year, // Assuming all tasks share the same year
            'kras' => $tasks->map(function ($task) {
                return [
                    'kra_title' => $task['kra_details']['kra_title'],
                    'kra_weight' => $task['kra_weight'],
                    'objs' => collect($task['savedemployeetask'])->map(function ($savedTask) {
                        return [
                            'obj_title' => $savedTask['objectives'],
                            'obj_weight' => $savedTask['objective_weight'],
                            'gradeed_weight' => $savedTask['gradeed_weight'],
                            'target' => $savedTask['target'],
                            'kpi' => $savedTask['kpi'],
                            'unit' => $savedTask['unit'],
                            'quater' => $savedTask['quater'],
                        ];
                    }) // Reset the array keys for the objectives
                ];
            }) // Reset the array keys for the KRAs
        ];
    })->toArray(); // Reset the array keys and convert to an array

  
                   return response()->json(
                       [ 'data' => $transformedResponse]
                    );

    //    dd($response);
    }
    
}
