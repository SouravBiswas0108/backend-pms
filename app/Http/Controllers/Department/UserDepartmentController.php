<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\DepartmentAssignStaff;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

use function PHPUnit\Framework\isEmpty;

class UserDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch the current authenticated user's staff ID
        $staffIdToFind = JWTAuth::user()->staff_id;
    
        // Get the Bearer token from the request
        $token = $request->bearerToken();
        JWTAuth::setToken($token); // Set the token for JWTAuth
        $payload = JWTAuth::getPayload(); // Get the payload data from the token
        $role = $payload->get('role'); // Extract the 'role' from the payload
    
        // Fetch departments assigned to the user with the specified role
        $departmentNames = DepartmentAssignStaff::with('department')
            ->where('staff_id', $staffIdToFind)
            ->where('assign_role_name', $role)
            ->get()
            // Map the results to include department_id, department_name, and year
            ->map(function ($item) {
                return [
                    'department_id' => $item->department->department_id,
                    'department_name' => $item->department->department_name,
                    'year' => $item->year,
                ];
            })
            ->toArray();
        // Debugging output to check the fetched departments
        // dd($departmentNames);
        
    
        // Fetching the current year
        $currentYear = (int) date("Y");
        // dd($currentYear); // Debugging output to verify the current year
    
        // Check if there are any departments assigned
        if (!empty($departmentNames)) {
            $groupedDepartments = [];
            $years = range(2021, $currentYear); // Create a range of years from 2021 to the current year
    
            // Group departments by their assigned year
            foreach ($departmentNames as $department) {
                // Add department details to the corresponding year group
                $groupedDepartments[$department['year']][] = [
                    'department_id' => $department['department_id'],
                    'department_name' => $department['department_name']
                ];
            }
    
            // Ensure every year in the range is present, even if no departments are assigned
            foreach ($years as $year) {
                if (!isset($groupedDepartments[$year])) {
                    $groupedDepartments[$year] = []; // Initialize empty array for years with no assignments
                }
            }
    
            // Sort the grouped departments by year in descending order
            krsort($groupedDepartments);
    
            // Return the grouped departments as a JSON response
            return response()->json([
                'departmentNames' => $groupedDepartments,
            ]);
        } else {
            // If no departments are assigned, return a 404 response with a message
            return response()->json([
                "message" => "Still not assigned any department, please contact the admin!",
            ], 404);
        }
    
        // Output the department names for debugging (this will not be reached due to the return statements above)
        // dd($departmentNames);
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
