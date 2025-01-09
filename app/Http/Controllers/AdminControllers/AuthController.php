<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function login(Request $request)
     {

        try{
            $validatedData = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

             // Extract credentials and role
        $credentials = $request->only('email', 'password');
        $role = $request->input('role');

        // Attempt to authenticate with provided credentials
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = JWTAuth::setToken($token)->toUser();
        $check = User::where('email', $user->email)->where('staff_id',$user['staff_id'])->where('designation','admin')->exists();
         
        if($check){

             $response = [
                    'token' => $token,
                    'type' => 'bearer',
                
             ];
            //  dd($response);

             $user = JWTAuth::user()->toArray();
             if (!empty($user)) {
                # code...
                $data = [
                   "First_Name"  => $user['F_name'] ?? null,
                   "Middle_Name" => $user['M_name'] ?? null,
                   "Last_Name"   => $user['L_name'] ?? null,
                   "Email"       => $user['email'] ?? null,
                ];
    
    
                $user = User::with('userDetails')->where('staff_id',$user['staff_id'])->first();
                $primaryImage = $user->avatar;  
                $imagePath = public_path('profileimage/' . $primaryImage);
    
                $base64ImageWithPrefix = null;
        
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
        
                // $ans = array_push($data,"profileImage" => $base64ImageWithPrefix);
                $data['profileImage'] = $base64ImageWithPrefix;
    
               return response()->json([
                   'auth' => $response,
                   'data' => $data,
               ]);
    
                
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'not found',
                ], 404);
               }

          }
          else{
            return response()->json([
                'status' => 'error',
                'message' => 'You are not admin',
            ], 401);

          }
        
    } catch (ValidationException $e) {
        // Return a JSON response if validation fails
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $e->errors(),
        ], 422);
    }

        
     }
    public function index()
    {
        //
        return response()->json(['message' => 'Right now not available'],404);
        $user = JWTAuth::user()->toArray();
// dd($user);
        if (!empty($user)) {
            # code...
            $data = [
               "First Name"  => $user['F_name'] ?? null,
               "Middle Name" => $user['M_name'] ?? null,
               "Last Name"   => $user['L_name'] ?? null,
               "Email"       => $user['email'] ?? null,
            ];


            $user = User::with('userDetails')->where('staff_id',$user['staff_id'])->first();
            $primaryImage = $user->avatar;  
            $imagePath = public_path('profileimage/' . $primaryImage);

            $base64ImageWithPrefix = null;
    
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
    
            // $ans = array_push($data,"profileImage" => $base64ImageWithPrefix);
            $data['profileImage'] = $base64ImageWithPrefix;

           return response()->json([
               'status' => 'success',
               'data' => $data,
           ]);

            
        }
       else{
        return response()->json([
            'status' => 'error',
            'message' => 'not found',
        ], 404);
       }
       
        
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
