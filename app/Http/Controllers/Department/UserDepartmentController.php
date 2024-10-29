<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\DepartmentAssignStaff;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

use function PHPUnit\Framework\isEmpty;

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
            ->get()
            ->pluck('year','department.department_name','department.department_id')->toArray();
            // dd($departmentNames);

            if (!empty($departmentNames)) {
                # code...
                $groupedDepartments = [];
                foreach ($departmentNames as $department => $year) {
                    $groupedDepartments[$year][] = $department;
                }
                return response()->json([
                    'status' => 'success',
                    'departmentNames' => $groupedDepartments,
                ]);
            }
            else {
                # code...
                return response()->json([
                "message" => "Still not assign any department , please contact with admin !!",
                ],404);
            }
            
        
        

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
