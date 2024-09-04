<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentAssignStaff;
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
        //
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
