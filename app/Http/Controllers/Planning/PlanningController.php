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
        return response()->json([
            'status' => 'success',
            'form-A-Intial' => $UserDetails,
        ]);
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
                'kras' => 'required|array',
                'kras.*.kra_title' => 'required|string',
                'kras.*.kra_weight' => 'required|numeric',
                'kras.*.objs' => 'required|array',
                'kras.*.objs.*.obj_title' => 'required|string',
                'kras.*.objs.*.obj_weight' => 'required|numeric',
                'kras.*.objs.*.gradeed_weight' => 'required|numeric',
                'kras.*.objs.*.target' => 'required|numeric',
                'kras.*.objs.*.kpi' => 'required|string',
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
                    ->where("kra_id", $kraId)
                    ->exists();

                if (!$exists) {
                    // Create EmployeeTask if it doesn't exist

                    $EmployeeTask = EmployeeTask::create([
                        "staff_id" => $staffId,
                        "dept_id" => $data['dept_id'],
                        "year" => $year,
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
                        ->where("kra_id", $kraId)
                        ->update(["kra_weight" => $kra['kra_weight']]);

                    // Get the EmployeeTask ID for further use
                    $EmployeeTaskUpdateId = EmployeeTask::where('staff_id', $staffId)
                        ->where('dept_id', $data['dept_id'])
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
                    return [
                        'kra_title' => $kra->kra_title,
                        'kra_weight' => $kra->kra_weight,
                        'objs' => $kra->objs->map(function ($obj) {
                            return [
                                'obj_title' => $obj->obj_title,
                                'obj_weight' => $obj->obj_weight,
                                'Initiative' => $obj->Initiative,
                                'kpi' => $obj->kpi,
                                'target' => $obj->target,
                                'Responsible' => $obj->Responsible,
                            ];
                        }),
                    ];
                }),
            ];
        });

        return response()->json([
            'status' => 'success',
            'employeeTasks' => $response,
        ]);
    }
}
