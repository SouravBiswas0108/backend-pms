<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentAssignStaff;
use App\Models\Mpms;
use App\Models\User;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $departmentId = 'DP154120';
        $staffIdToFind = 'STAFF705069';


        $departmentName = Department::select('department_name')->where('department_id', $departmentId)->first();
        //    dd(123);
        $userInfo = DepartmentAssignStaff::where('department_id', $departmentId)->where('staff_id', $staffIdToFind)->first();
        //  dd($userInfo);
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

        $employeeTasks = Mpms::with(['kras.objs'])->get()->toArray();

        $formAIntial = [
            'UserDetails' => $UserDetails,
            'employeeTasks' => $employeeTasks,
        ];
        return response()->json([
            'status' => 'success',
            'formAIntial' => $formAIntial,
            'competencies' => [],
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

   
        $response  = $employeeTasks->map(function($task){
            return[
                'heading' => $task->heading,
                'kras' => $task->kras->map(function($kra){
                     return[
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
