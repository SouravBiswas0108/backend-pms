<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Utility::settings();
        return view('admin.users.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request->all());
        //validating Data
        $validatedData = $request->validate([
            'ippis_no' => 'required|string|max:200',
            'staff_id' => 'required|string|max:20',
            'fname' => 'required|string|max:255',
            'mid_name' => 'nullable|string|max:255',
            'lname' => 'nullable|string|max:255',
            'email' => 'required|max:255|email|unique:users,email', // Check against `users` table
            'phone' => 'nullable|string|max:20', // Adjust max length if necessary
            'password' => 'required|string|min:6',
            'job_title' => 'nullable|string|max:255',
            'designation' => 'string|max:255',
            'cadre' => 'nullable|string|max:255',
            'date_of_current_posting' => 'nullable|date',
            'date_of_MDA_posting' => 'nullable|date',
            'date_of_last_promotion' => 'nullable|date',
            'gender' => 'nullable|string|max:255',
            'grade_level' => 'nullable|string|max:50',
            'organization' => 'required|string|max:255',
            'recovery_email' => 'nullable|max:255'
        ]);
    
        // dd($validatedData);

        User::create([
            'ippis_no' => $validatedData['ippis_no'],
            'staff_id' => $validatedData['staff_id'],
            'F_name' => $validatedData['fname'],
            'M_name' => $validatedData['mid_name'],
            'L_name' => $validatedData['lname'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => hash::make($validatedData['password']), 
            'designation' => $validatedData['designation'],
            'cadre' => $validatedData['cadre']
            // 'organization' => $validatedData['organization'],
        ]);


    
    UserDetail::create([
        'staff_id' => $validatedData['staff_id'],
        'gender' => $validatedData['gender'],
        'designation' => $validatedData['designation'],      
        'cadre' => $validatedData['cadre'],
        // 'org_code' => $validatedData['organization'],
        // 'org_name' => $validatedData['organization'],
        'date_of_current_posting' => $request->input('date_of_current_posting'),
        'date_of_MDA_posting' => $request->input('date_of_MDA_posting'),
        'date_of_last_promotion' => $request->input('date_of_last_promotion'),
        'job_title' => $validatedData['job_title'],
        'grade_level' => $validatedData['grade_level'],
        // 'org_name' => $validatedData['organization'],
        'recovery_email' => $validatedData['recovery_email'],
        // 'type'=>$validatedData['role'] ,
    ]);
  

        dd($request->all());
      
            // print_r($organization);die('++++');
           
        
        // else
        // {
        //     return response()->json(['error' => __('Permission Denied.')], 401);
        // }
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
