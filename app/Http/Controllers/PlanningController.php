<?php

namespace App\Http\Controllers;

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
        $departmentId = 'DP670434'; 
        $staffIdToFind = 'STAFF705069';

        $userInfo = DepartmentAssignStaff::where('department_id',$departmentId)->where('staff_id',$staffIdToFind)->first()->toArray();

        $staffDetails =  User::with('userDetails')->where('staff_id',$userInfo['staff_id'])->get()->toArray();
       
        $supervisorDetails = User::with('userDetails')->where('staff_id',$userInfo['supervisor_id'])->get()->toArray();

        $officerDetails = User::with('userDetails')->where('staff_id',$userInfo['officer_id'])->get()->toArray();

        $UserDetails = [
            'staffDetails' => $staffDetails,
            'supervisorDetails' => $supervisorDetails,
            'officerDetails' => $officerDetails,
        ];
        
        // Print or return the combined array
        
        $employeeTasks = Mpms::with(['kras.objs'])->get()->toArray();

        $formAIntial = [
               'UserDetails' => $UserDetails,
               'employeeTasks'=> $employeeTasks,
        ];
        return response()->json([
            'status' => 'success',
            'formAIntial' => $formAIntial,
        ]);
        
     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
}
