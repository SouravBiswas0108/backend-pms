<?php

namespace App\Http\Controllers\AdminControllers;

use App\Events\TestNotification;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the authenticated user
        $user = JWTAuth::user();
        if ($user->hasRole('admin')) {
            # code...
            $stafflist = User::with('userDetails')->get()->toArray();

            $data  = collect($stafflist)->map(function ($item) {
                return [
                    "id" => $item['id'],
                    "staff_id" => $item['staff_id'],
                    "ippis_no" => $item['ippis_no'],
                    "name" => $item['F_name'] . " " . $item['M_name'] . " " . $item['L_name'],
                    "email" => $item['email'],
                    "is_active" => $item['user_details']['is_active'],
                    "type" => "user",
                    "grade_level" => $item['user_details']['grade_level'],
                ];
            });

            if ($data->isEmpty()) {
                return response()->json(['message' => 'No staff found'], 404);
            } else {
                return response()->json(['data' => $data], 200);
            }
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
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
        try {

            $validatedData =  $request->validate([
                'staff_id' => 'required|string|unique:users,staff_id|max:255',
                'ippis_no' => 'required|string|unique:users,ippis_no|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'F_Name' => 'required|string|max:255',
                'M_Name' => 'nullable|string|max:255',
                'L_Name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'password' => 'required|string|min:4',
                'job_Title' => 'required|string|max:255',
                'Designation' => 'required|string|max:255',
                'cadre' => 'required|string|max:255',
                'date_of_current_posting' => 'required|date_format:d/m/Y',
                'date_of_MDA_posting' => 'required|date_format:d/m/Y',
                'date_of_last_promotion' => 'required|date_format:d/m/Y',
                'gender' => 'required|in:male,female,other',
                'organization' => 'required|string|max:255',
                'role' => 'required|string|max:255',
                'recovery_email' => 'required|email|max:255',
                "grade_level" => 'required|string|max:255',
            ]);

            $user =  User::create([
                'ippis_no' => $validatedData['ippis_no'],
                'staff_id' => $validatedData['staff_id'],
                'F_name' => $validatedData['F_Name'],
                'M_name' => $validatedData['M_Name'],
                'L_name' => $validatedData['L_Name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'password' => hash::make($validatedData['password']),
                'designation' => $validatedData['Designation'],
                'cadre' => $validatedData['cadre']
                // 'organization' => $validatedData['organization'],
            ]);

            // dd(auth::user()->id);

            $userDetails =  UserDetail::create([
                'staff_id' => 'STAFF352162',
                'staff_id' => $validatedData['staff_id'],
                'gender' => $validatedData['gender'],
                'designation' => $validatedData['Designation'],
                'cadre' => $validatedData['cadre'],
                // 'org_code' => $validatedData['organization'],
                // 'org_name' => $validatedData['organization'],
                'date_of_current_posting' => $request->input('date_of_current_posting'),
                'date_of_MDA_posting' => $request->input('date_of_MDA_posting'),
                'date_of_last_promotion' => $request->input('date_of_last_promotion'),
                'job_title' => $validatedData['job_Title'],
                'grade_level' => $validatedData['grade_level'],
                // 'org_name' => $validatedData['organization'],
                'recovery_email' => $validatedData['recovery_email'],
                'created_by' => JWTAuth::user()->id,
                'type' => $validatedData['role'],
            ]);

            event(new TestNotification(['message' => 'New staff created']));

            return response()->json(['message' => 'Staff created successfully'], 201);
            // dd($request->all());
        } catch (\Throwable $th) {
            // Log the error if necessary
            return response()->json(['error' => $th->getMessage()], 404);
        }

        // dd($request->all());
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
