<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\DepartmentAssignStaff;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $staffIdToFind = JWTAuth::user()->staff_id;

        $token = $request->bearerToken();
        JWTAuth::setToken($token);
        $payload = JWTAuth::getPayload();
        $role = $payload->get('role');

        $departmentNames = DepartmentAssignStaff::with('department')
            ->where('staff_id', $staffIdToFind)
            ->where('assign_role_name', $role)
            ->where('year',$request->year)
            ->get()
            ->pluck('department.department_name');

            return response()->json([
                'status' => 'success',
                'departmentNames' => $departmentNames,
            ]);
        
        

        // Output the department names for debugging
        // dd($departments);
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
}