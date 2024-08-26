<?php

namespace App\Http\Controllers\personalInfo;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;

class PersonalInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departmentId = 'DP670434'; 
        $staffIdToFind = 'STAFF705069';
        $organization = Organization::first();
        // $organization_name = $organization->org_name;
        $user = User::with('userDetails')->where('staff_id',$staffIdToFind)->first();
        //   dd($user->F_name);
        if ($user) {
            $personalInfo = [
                'F_name' => $user->F_name,
                'M_name' => $user->M_name,
                'L_name' => $user->L_name,
                'email' => $user->email,
                'recovery_email' => $user->userDetails->recovery_email, // from userDetails
            ];
        
            $ippisInfo = [
                'ippis_no' => $user->ippis_no,
                'staff_id' => $user->staff_id,
                'job_title' => $user->userDetails->job_title, // from userDetails
                'designation' => $user->designation,
                'cadre' => $user->cadre,
                'date_of_current_posting' => $user->userDetails->date_of_current_posting, // from userDetails
                'date_of_MDA_posting' => $user->userDetails->date_of_MDA_posting, // from userDetails
                'date_of_last_promotion' => $user->userDetails->date_of_last_promotion, // from userDetails
                'gender' => $user->userDetails->gender, // from userDetails
                'grade_level' => $user->userDetails->grade_level, // from userDetails
                'organization' =>  $organization->org_name,
                'role' => $user->userDetails->type, // assuming 'type' refers to the role from userDetails
            ];
        } else {
            $firstArray = [];
            $secondArray = [];
        }

        return response()->json([
            'status' => 'success',
            'personalInfo' => $personalInfo,
            'ippisInfo' => $ippisInfo
        ]);
        // dd($secondArray);
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