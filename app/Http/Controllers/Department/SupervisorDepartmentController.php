<?php

namespace App\Http\Controllers\Department;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentAssignStaff;
use Illuminate\Http\Request;

class SupervisorDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $supervisorId = JWTAuth::user()->staff_id;

        $token = $request->bearerToken();
        JWTAuth::setToken($token);
        $payload = JWTAuth::getPayload();
        $role = $payload->get('role');

          if (!$supervisorId or !$role) {
            # code...
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
          }
        // dd($request->year); 
        $department = DepartmentAssignStaff::where('assign_role_name','Supervisor')->where('staff_id',$supervisorId)->where('year',$request->year)->get()->toArray();
        // dd($department);
        
        $departments = array_map(function($item){
                return $item['department_id'];
         },$department);

         if (empty($departments)) {
            # code...
            return response()->json([
                "stafflist" => 'No department is assigned'
            ], );
        }

         return response()->json([
          'departmentList' => $departments
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

    public function stafflist(Request $request)
    {
        //
        //  dd($request->all());
        
        $supervisorId = JWTAuth::user()->staff_id;

        $token = $request->bearerToken();
        JWTAuth::setToken($token);
        $payload = JWTAuth::getPayload();
        $role = $payload->get('role');

        if (!$supervisorId or !$role) {
            # code...
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
          }

        $stafflists = DepartmentAssignStaff::where('supervisor_id',$supervisorId)->where('department_id',$request->department_id)->get()->toArray();

        
        $stafflist = array_map(function ($item){
            return $item['staff_id'];
        },$stafflists);

        if (empty($stafflist)) {
            # code...
            return response()->json([
                "stafflist" => 'No staff is assigned'
            ], );
        }
        return response()->json([
            "stafflist" => $stafflist
        ]);
        // dd($stafflist);
    }
}
