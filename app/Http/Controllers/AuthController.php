<?php

namespace App\Http\Controllers;

use App\Models\DepartmentAssignStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    //submission from ubuntu


    public function login(Request $request)
    {
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

        // Retrieve authenticated user
        $customClaims = ['role' => $role];
        $token = JWTAuth::setToken($token)->claims($customClaims)->attempt($credentials);
        $user = JWTAuth::setToken($token)->toUser();


        // Check if the user has the required role in DepartmentAssignStaff
        $exists = DepartmentAssignStaff::where('staff_id', $user->staff_id)
            ->where('assign_role_name', $role)
            ->exists();



        if ($exists) {
            // Create token with custom claims
            // $customClaims = ['role' => $role];
            // $token = JWTAuth::claims($customClaims)->attempt($credentials);

            return response()->json([
                'status' => 'success',
                'user' => $user,
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
    public function logout(Request $request)
    {
        // dd(767676);
        try {
            // Parse the token
            $token = JWTAuth::getToken();
            $user = JWTAuth::authenticate($token);

            // Check your specific condition here
            // For example, checking if the user is active or some other condition
            if ($user->some_condition) {
                // Invalidate the token
                JWTAuth::invalidate($token);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully logged out',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Condition not met for logout',
                ], 400);
            }
        } catch (\Exception $e) {
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
