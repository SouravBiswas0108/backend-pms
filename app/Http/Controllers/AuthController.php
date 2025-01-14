<?php

namespace App\Http\Controllers;

use App\Events\TestNotification;
use App\Models\DepartmentAssignStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    //submission from ubuntu


    public function login(Request $request)
    {
        // event(new TestNotification([
        //     'author' => 'Admin',
        //     'title' => 'Test Notification',
        // ]));

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'role' => 'required|string',
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
        // dd(123);

        // Retrieve authenticated user
        $customClaims = ['role' => $role];
        $token = JWTAuth::setToken($token)->claims($customClaims)->attempt($credentials);
        $user = JWTAuth::setToken($token)->toUser();

        
        // Check if the user has the required role in DepartmentAssignStaff
        $exists = DepartmentAssignStaff::where('staff_id', $user->staff_id)
            ->where('assign_role_name', $role)
            ->exists();



        if ($exists) {

            $primaryImage = $user->avatar;  
            $imagePath = public_path('profileimage/' . $primaryImage);

              // Check if the file exists
             if (is_file($imagePath)) {
                // dd(File::exists($imagePath));
                 // Get the image content
                 $imageContent = File::get($imagePath);

                 $profileImageUrl = $imagePath;// sending without encrypt
      
                 // Encode the image to Base64
                 $base64Image = base64_encode($imageContent);
  
                 // Optionally, add data URL prefix (useful if embedding image in HTML or sending it as a response)
                 $base64ImageWithPrefix = 'data:image/jpeg;base64,' . $base64Image;
  
                 // dd($base64ImageWithPrefix); // Use this to inspect the base64-encoded image if needed
             } else {
                $profileImageUrl = null;// sending without encrypt
                 $base64Image = null;  // Or you can set a default image here, or return an error message
           // $base64ImageWithPrefix = 'data:image/png;base64,' . base64_encode(File::get(public_path('profileimage/default.png'))); // Set a default image
            }
            // dd($base64Image);
            // Create token with custom claims
            // $customClaims = ['role' => $role];
            // $token = JWTAuth::claims($customClaims)->attempt($credentials);

            return response()->json([
                'status' => 'success',
                'user' => array_merge($user->toArray(),[
                    'ProfileImage' => $profileImageUrl,
                ]),
               
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
        ], 401);
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //     ]);
    //     $credentials = $request->only('email', 'password');

    //     $token = Auth::attempt($credentials);
    //     if (!$token) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Unauthorized',
    //         ], 401);
    //     }

    //     $user = Auth::user();
    //     return response()->json([
    //             'status' => 'success',
    //             'user' => $user,
    //             'authorisation' => [
    //                 'token' => $token,
    //                 'type' => 'bearer',
    //             ]
    //         ]);

    // }

    public function register(Request $request)
    {
        // dd(1243);
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = Auth::login($user);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    // public function logout(Request $request)
    // {
    //     // dd(767676);
    //     try {
    //         // Parse the token
    //         $token = JWTAuth::getToken();
    //         $user = JWTAuth::authenticate($token);

    //         // Check your specific condition here
    //         // For example, checking if the user is active or some other condition
    //         if ($user->some_condition) {
    //             // Invalidate the token
    //             JWTAuth::invalidate($token);

    //             return response()->json([
    //                 'status' => 'success',
    //                 'message' => 'Successfully logged out',
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Condition not met for logout',
    //             ], 400);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to log out',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function logout(Request $request)
    {

        try {
            // Parse the token
            $token = JWTAuth::getToken();
            $user = JWTAuth::authenticate($token);
            
            // Debugging: log user information
            Log::info('User data:', ['user' => $user]);
    
            // Invalidate the token
            JWTAuth::invalidate($token);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
            ]);
        } catch (\Exception $e) {
            // Debugging: log exception message
            Log::error('Logout failed:', ['error' => $e->getMessage()]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to log out',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // public function logout(Request $request)
    // {
    //     try {
    //         // Invalidate the token
    //         JWTAuth::parseToken()->invalidate();

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Successfully logged out',
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to log out',
    //         ], 500);
    //     }
    // }

    // public function logout()
    // {
    //     Auth::logout();
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Successfully logged out',
    //     ]);
    // }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
