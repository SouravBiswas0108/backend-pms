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
        $check = User::where('email', $user->email)->where('staff_id',$user['staff_id'])->where('is_admin',1)->exists();
         
        if($check){

             $response = [
                    'token' => $token,
                    'type' => 'bearer',
                
             ];
            //  dd($response);

             $user = JWTAuth::user();
            //  dd($user);
             if (!empty($user)) {
                # code...
                $data = [
                   "First_Name"  => $user['F_name'] ?? null,
                   "Middle_Name" => $user['M_name'] ?? null,
                   "Last_Name"   => $user['L_name'] ?? null,
                   "Email"       => $user['email'] ?? null,
                ];

                // $userPermission = JWTAuth::user();

                $roles = [
                    'admin' => 'admin',
                    'Total User' => 'total_user',
                    'Total Department' => 'total_department',
                    'Employee Performance Rating By Grade Level' => 'employee_performance_by_grade_level',
                    'Employee Performance Rating Score By Department' => 'employee_performance_by_department',
                    'Top 30 Employees By Performance Rating' => 'top_30_employees_performance',
                    'Bottom 30 Employees By Performance Rating' => 'bottom_30_employees_performance',
                    'Report On Overall Training Needs' => 'report_on_training_needs',
                    'Report On Training Needs By Department' => 'report_on_training_needs_by_department',
                    'Report On Employees Percentage Distribution' => 'report_on_employees_percentage_distribution',
                ];
                
                $dashboard_menu = [];
                
                if ($user->hasRole('admin')) {
                    // If user is an admin, include all roles except 'admin'
                    $dashboard_menu = array_values(array_filter($roles, function($role) {
                        return $role !== 'admin';
                    }));
                } else {
                    // Filter the roles based on the user's assigned roles
                    $dashboard_menu = array_filter($roles, function($dashboard, $role) use ($user) {
                        return $user->hasRole($role);
                    }, ARRAY_FILTER_USE_BOTH);
                    $dashboard_menu = array_values($dashboard_menu); // Reindex the array
                }
                
                $data['dashboard_menu'] = $dashboard_menu;
                

                // dd($dashboard_menu);
    
    
                 // Check if the file exists image path currently off

                // $user = User::with('userDetails')->where('staff_id',$user['staff_id'])->first();
                // $primaryImage = $user->avatar;  
                // $imagePath = public_path('profileimage/' . $primaryImage);
                // dd($imagePath);
    
                $base64ImageWithPrefix = null;
        
                  // Check if the file exists image path currently off 
            //      if (File::exists($imagePath)) {
            //          // Get the image content
            //          $imageContent = File::get($imagePath);
          
            //          // Encode the image to Base64
            //          $base64Image = base64_encode($imageContent);
        
            //          // Optionally, add data URL prefix (useful if embedding image in HTML or sending it as a response)
            //          $base64ImageWithPrefix = 'data:image/jpeg;base64,' . $base64Image;
        
            //          // dd($base64ImageWithPrefix); // Use this to inspect the base64-encoded image if needed
            //      } else {
            //          $base64Image = null;  // Or you can set a default image here, or return an error message
            //    // $base64ImageWithPrefix = 'data:image/png;base64,' . base64_encode(File::get(public_path('profileimage/default.png'))); // Set a default image
            //     }
        
                // $ans = array_push($data,"profileImage" => $base64ImageWithPrefix);
                // $data['profileImage'] = $base64ImageWithPrefix;
    
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
