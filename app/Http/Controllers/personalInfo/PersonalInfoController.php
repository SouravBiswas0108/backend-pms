<?php

namespace App\Http\Controllers\personalInfo;

use App\Http\Controllers\Controller;
use App\Models\DepartmentAssignStaff;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class PersonalInfoController extends Controller
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

       

       
        $organization = Organization::first();
      
        $user = User::with('userDetails')->where('staff_id', $staffIdToFind)->first();
        
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
                'organization' => $organization->org_name,
                'role' => $user->userDetails->type, // assuming 'type' refers to the role from userDetails
            ];
        } else {
            $firstArray = [];
            $secondArray = [];
        }


        // Path to the image
        $imagePath = public_path('assets/profileimage/profile.png');

        // Check if the file exists
        if (File::exists($imagePath)) {
            // Get the image content
            $imageContent = File::get($imagePath);

            // Encode the image to Base64
            $base64Image = base64_encode($imageContent);
        } else {
            $base64Image = null; // Or some default image or error message
        }

        return response()->json([
            'status' => 'success',
            'assignRole' => $role,
            'personalInfo' => $personalInfo,
            'ippisInfo' => $ippisInfo,
            'Image' => $base64Image,
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
        dd($request->all());
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
