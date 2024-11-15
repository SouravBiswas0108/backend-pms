<?php

namespace App\Http\Controllers\personalInfo;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Models\DepartmentAssignStaff;
use App\Models\Organization;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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


          $primaryImage = $user->avatar;  
          $imagePath = public_path('profileimage/' . $primaryImage);

            // Check if the file exists
           if (File::exists($imagePath)) {
               // Get the image content
               $imageContent = File::get($imagePath);
    
               // Encode the image to Base64
               $base64Image = base64_encode($imageContent);

               // Optionally, add data URL prefix (useful if embedding image in HTML or sending it as a response)
               $base64ImageWithPrefix = 'data:image/jpeg;base64,' . $base64Image;

               // dd($base64ImageWithPrefix); // Use this to inspect the base64-encoded image if needed
           } else {
               $base64Image = null;  // Or you can set a default image here, or return an error message
         // $base64ImageWithPrefix = 'data:image/png;base64,' . base64_encode(File::get(public_path('profileimage/default.png'))); // Set a default image
          }


        return response()->json([
            'status' => 'success',
            'assignRole' => $role,
            // 'personalInfo' => $personalInfo,
            'ippisInfo' => $ippisInfo,
            // 'Image' => $base64Image,
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
        // dd($request->all());
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'staff_id' => 'required|string|max:20',
                'F_name' => 'required|string|max:255',
                'M_name' => 'nullable|string|max:255',
                'L_name' => 'nullable|string|max:255',
                'email' => 'required|string|email|max:255',              
                'recovery_email' => 'nullable|email|max:255',
                'file' => 'nullable',           
            ]);
        } catch (ValidationException $e) {
            // Return a JSON response if validation fails
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

        $staffIdToFind = JWTAuth::user()->staff_id;

        $mail =User::where('staff_id',$staffIdToFind)->first();
       

        if (($staffIdToFind == $request->staff_id) && ($mail->email == $request->email) )
     {

        // Check if a file is uploaded
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Create a file name with time prefix to avoid overwriting
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Move the file to the public/profileimage folder
            $filePath = public_path('profileimage') . DIRECTORY_SEPARATOR . $fileName;
            
            // Move the uploaded file to the desired directory
            $file->move(public_path('profileimage'), $fileName);
    
            // Set the file path to save in the database or return as a response
            $validatedData['avatar'] = 'profileimage/' . $fileName;

            $toUpdateImage = User::where('staff_id',$staffIdToFind)->update([
                'avatar' => $fileName
             ]);
        }

    // dd($fileName);


            # code...
          
            $toUpdate = User::where('staff_id',$staffIdToFind)->update([
               'F_name' => $request->F_name,
               'M_name' => $request->M_name,
               'L_name' => $request->L_name,
            ]);

            $recoveyEmailUpdate = UserDetail::where('staff_id',$staffIdToFind)->update([
                'recovery_email' => $request->recovery_email
            ]);

            return response()->json([
                'status' => 'success',
                'messege' => "data updated succesfully"
            ]);
        }
        // dd($recovery_mail);
        else {
            # code...
            return response()->json([
                "message" => "unable to update",
                ],404);
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
        // dd(1234);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        dd($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function security(Request $request)
    {
        //
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'password' => 'required|string',
                'newPassword' => 'required|string',
                'confirmPassword' => 'required|string|same:newPassword',          
            ]);
        } catch (ValidationException $e) {
            // Return a JSON response if validation fails
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
        
        $user = JWTAuth::user();
        
        if (!Hash::check($request->password, $user->password)) {
            # code...
            return response()->json([
                'status' => 'error',
                'message' => 'The current password is incorrect'
            ], 403);
        }
        // dd($request->all());

        // Password is correct; proceed with updating to the new password
        $user->password = Hash::make($request->newPassword);
        $user->save();


        $authController = new AuthController();
        $authController->logout($request);

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully'
          ]);
        
    }
}
