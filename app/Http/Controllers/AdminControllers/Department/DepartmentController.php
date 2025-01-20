<?php

namespace App\Http\Controllers\AdminControllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentAssignStaff;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $data = Department::where('')
        if (!(JWTAuth::user()->hasRole('admin') or JWTAuth::user()->hasRole('Total User'))) {

            return response()->json(["you don't have permission to perform this action"], 403);
            // dd('admin');
            # code...
        }
        $data = Department::where('year', $request->year)->get()->map(function ($item) {
            return [
                'department_id' => $item->department_id,
                'department_name' => $item->department_name,
                'year' => $item->year,
                'description' => $item->description,
                'organization' => $item->organization,
            ];
        });

        if ($data->isEmpty()) {
            return response()->json("No department found for the year " . $request->year, 404);
            # code...
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd(123);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (!(JWTAuth::user()->hasRole('admin') or JWTAuth::user()->hasRole('Total User'))) {

            return response()->json(["you don't have permission to perform this action"], 403);
            // dd('admin');
            # code...
        }
        try {
            $validatedData =  $request->validate([
                'department_id'   => 'required|string|max:20|unique:departments,department_id',
                'department_name' => 'required|string|max:255',
                'year'            => ['required', 'integer', function ($attribute, $value, $fail) {
                    if ($value != now()->year) {
                        $fail("The $attribute must be the current year.");
                    }
                }],
                'description'     => 'nullable|string|max:1000', // Allowable paragraph size
                "organization"    => 'string|max:255',
            ]);

            // $department = Department::create([
            //     'department_id'   => $validatedData['department_id'],
            //     'department_name' => $validatedData['department_name'],
            //     'year'            => $request->year, // Explicitly pass 'year'
            //     'description'     => $validatedData['description'],
            // ]);

            $department = Department::create($validatedData);

            if ($department) {
                return response()->json("department created successfully", 201);
            }
            return response()->json("department not created", 500);



            // dd($validatedData);
        } catch (ValidationException $e) {
            // Return all validation errors
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }

        // $department = Department::create($request->all());

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

    //assign staff and all staff 

    public function assignStaff(string $department_id, Request $request)
    {

        if (!(JWTAuth::user()->hasRole('admin') or JWTAuth::user()->hasRole('Total User'))) {

            return response()->json(["you don't have permission to perform this action"], 403);
            // dd('admin');
            # code...
        }
        try {
            $validatedData =  $request->validate([
                'year' => ['required', 'integer', 'between:2020,2100', function ($attribute, $value, $fail) use ($department_id) {
                    // Check if the department exists and the year matches
                    $department = \App\Models\Department::where('department_id', $department_id)->first();
                    if (!$department) {
                        return $fail('Department not found.');
                    }

                    // Compare the year in the request with the department's year
                    if ($department->year != $value) {
                        return $fail('The year must match the department\'s year.');
                    }
                }],
                'staff_ids' => 'required|array', // Ensure it's an array
                'staff_ids.*' => 'required|string|regex:/^STAFF\d{6}$/', // Validate each array element
            ]);

            // dd($validatedData);

            try {
                // Loop through the staff IDs and assign them to the department
                foreach ($validatedData['staff_ids'] as $staff_id) {
                    // Check if the staff is already assigned to this department and year
                    $existingAssignment = DepartmentAssignStaff::where('department_id', $department_id)
                        ->where('staff_id', $staff_id)
                        ->where('year', $validatedData['year'])
                        ->first();

                    // If the staff is already assigned, skip and return an error message
                    if ($existingAssignment) {
                        return response()->json([
                            'message' => 'Staff already assigned to the department for this year.',
                            'staff_id' => $staff_id,
                        ], 400);
                    }

                    // Create the assignment record if not already assigned
                    DepartmentAssignStaff::create([
                        "department_id" => $department_id,
                        "staff_id" => $staff_id,
                        "assign_role_name" => "Staff",
                        "assign_role_id" => 1,
                        "year" => $validatedData['year'],
                    ]);
                }

                // Return a success response if assignment is successful
                return response()->json([
                    'message' => 'Staff successfully assigned to the department.',
                    'assigned_staff' => $validatedData['staff_ids'],
                    'department_id' => $department_id,
                    'year' => $validatedData['year'],
                ], 200);
            } catch (\Exception $e) {
                // Return a failure response if any exception occurs
                return response()->json([
                    'message' => 'Failed to assign staff to the department.',
                    'error' => $e->getMessage(),
                ], 500);
            }
            // dd($request->all());

            // dd($validatedData);
        } catch (ValidationException $e) {
            // Return all validation errors
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    //already assigned staff
    public function assignedStaff(string $department_id, Request $request)
    {
        // dd($department_id);
        if (!(JWTAuth::user()->hasRole('admin') or JWTAuth::user()->hasRole('Total User'))) {

            return response()->json(["you don't have permission to perform this action"], 403);
            // dd('admin');
            # code...
        }

        $departmentAssignedStaff = DepartmentAssignStaff::with('user')->where('department_id', $department_id)
            ->where('year', $request->year)
            ->get()->map(function ($item) {
                return [
                    "staff_id" => $item->staff_id,
                    "name" => $item->user->F_name . ' ' . $item->user->M_name . ' ' . $item->user->L_name,
                ];
            })
            ->unique('staff_id') // Ensures unique staff_id
            ->values(); // Reindex the collection
   
       
        if ($departmentAssignedStaff->isEmpty()) {
            # code...
            return response()->json([
                "data" => [],
            ]);
        }

        return response()->json([
            "data" => $departmentAssignedStaff,
        ]);


        // dd($departmentAssignStaff);

    }

    public function assignAll(string $department_id, Request $request)
    {
        dd(123);
        if (!(JWTAuth::user()->hasRole('admin') or JWTAuth::user()->hasRole('Total User'))) {

            return response()->json(["you don't have permission to perform this action"], 403);
            // dd('admin');
            # code...
        }

        try {
            $validatedData =  $request->validate([
                'year' => ['required', 'integer', 'between:2020,2100', function ($attribute, $value, $fail) use ($department_id) {
                    // Check if the department exists and the year matches
                    $department = \App\Models\Department::where('department_id', $department_id)->first();
                    if (!$department) {
                        return $fail('Department not found.');
                    }

                    // Compare the year in the request with the department's year
                    if ($department->year != $value) {
                        return $fail('The year must match the department\'s year.');
                    }
                }],
                'team_id' => 'required|string',
                'staff_ids' => 'required|array', // Ensure it's an array
                'staff_ids.*' => 'required|string|regex:/^STAFF\d{6}$/', // Validate each array element
            ]);
        } catch (ValidationException $e) {
            // Return all validation errors
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }

        dd($request->all());
    }
}
