<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentAssignStaff;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class SupervisorPlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $year = $request->year;
        $departmentId = $request->departmentid;
        $staffIdToFind = $request->staff_id;
        $supervisorIdToFind = JWTAuth::user()->staff_id;
     
        $departmentName = Department::select('department_name')->where('department_id', $departmentId)->first();     

        if (!$departmentName) {
            # code...
            return response()->json('department has no data', 404);
        }
        $userInfo = DepartmentAssignStaff::where('department_id', $departmentId)->where('staff_id', $staffIdToFind)->where('supervisor_id', $supervisorIdToFind)->where('year', $year)->first();
        // dd($userInfo);
        if (!$userInfo) {
            # code...
            return response()->json('correct the year or staff_id', 404);
        }

        $staffDetails = User::with('userDetails')->where('staff_id', $userInfo['staff_id'])->get()->toArray();

        $supervisorDetails = User::with('userDetails')->where('staff_id', $supervisorIdToFind)->get()->toArray();

        $officerDetails = User::with('userDetails')->where('staff_id', $userInfo['officer_id'])->get()->toArray();


        $UserDetails = [
            'staffDetails' => $staffDetails,
            'supervisorDetails' => $supervisorDetails,
            'officerDetails' => $officerDetails,
            'departmentName' => $departmentName->department_name,
        ];


        $etag = md5(json_encode($UserDetails));
        $response = response()->json($UserDetails);
        $response->header('mahadev-etag-supervisor', $etag);
        $response->header('Access-Control-Expose-Headers', 'mahadev-etag');


        return $response;
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
