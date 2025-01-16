<?php

namespace App\Http\Controllers\AdminControllers;

use App\Events\TestNotification;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use spatie\permission\Models\Role;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //displaying stafflist 
    public function index()
    {
        // Get the authenticated user
        $user = JWTAuth::user();
        if ($user->hasRole('admin') or $user->hasRole('Total User')) {
            # code...
            $stafflist = User::with('userDetails')->get()->toArray();

            // dd($stafflist);

            $data  = collect($stafflist)->map(function ($item) {
                return [
                    "id" => $item['id'],
                    "staff_id" => $item['staff_id'],
                    "ippis_no" => $item['ippis_no'],
                    "name" => $item['F_name'] . " " . $item['M_name'] . " " . $item['L_name'],
                    "email" => $item['email'],
                    "is_active" => $item['user_details']['is_active'],
                    "type" => $item['is_admin']? 'admin' : 'user',
                    "grade_level" => $item['user_details']['grade_level'],
                ];
            });

            if ($data->isEmpty()) {
                return response()->json(['message' => 'No staff found'], 404);
            } else {
                $etag = md5(json_encode($data));
                $response = response()->json($data, 200);
                $response->header('stafflist-etag', $etag);
                $response->header('Access-Control-Expose-Headers', 'stafflist-etag');
                return $response;
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

        if (JWTAuth::user()->hasRole('admin')) {
            # code...
            // dd('admin');

            if ($request->input('role') == 'admin' || $request->input('role') == 'Admin') {
                # code...

                return $this->createAdmin($request);
                // dd('admin');
            }
        
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

            //pusher notification
            event(new TestNotification(['message' => 'New staff created']));

            return response()->json(['message' => 'Staff created successfully'], 201);
            // dd($request->all());
        } catch (ValidationException $e) {
            // Return all validation errors
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    } 
    else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }

        // dd($request->all());
    }

    public function createAdmin(Request $request){

        // dd($request->all());

        try {

            $validatedData =  $request->validate([
                'staff_id' => 'required|string|unique:users,staff_id|max:255',
                'ippis_no' => 'required|string|unique:users,ippis_no|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'F_Name' => 'required|string|max:255',
                'M_Name' => 'nullable|string|max:255',
                'L_Name' => 'required|string|max:255',
                'phone' => 'required|string|max:15|regex:/^\d+$/',
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
                'grade_level' => 'required|string|max:255',
                'permission' => 'required|array',
                'permission.total_user' => 'required|integer|in:0,1',
                'permission.total_department' => 'required|integer|in:0,1',
                'permission.employee_performance_rating_by_grade_level' => 'required|integer|in:0,1',
                'permission.employee_performance_rating_score_by_department' => 'required|integer|in:0,1',
                'permission.top_30_employees_by_performance_rating' => 'required|integer|in:0,1',
                'permission.bottom_30_employees_by_performance_rating' => 'required|integer|in:0,1',
                'permission.report_on_overall_training_needs' => 'required|integer|in:0,1',
                'permission.report_on_training_needs_by_department' => 'required|integer|in:0,1',
                'permission.report_on_employees_percentage_distribution' => 'required|integer|in:0,1',
            ]);

            // dd($validatedData);



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
                'cadre' => $validatedData['cadre'],
                'is_admin' => 1
                // 'organization' => $validatedData['organization'],
            ])->id;

            $userForAssignRole = User::find($user);

            // dd(auth::user()->id);

            $userDetails =  UserDetail::create([
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
            //spaty role permission

            $permissionRoles = [
                'total_user' => 'Total User',
                'total_department' => 'Total Department',
                'employee_performance_rating_by_grade_level' => 'Employee Performance Rating By Grade Level',
                'employee_performance_rating_score_by_department' => 'Employee Performance Rating Score By Department',
                'top_30_employees_by_performance_rating' => 'Top 30 Employees By Performance Rating',
                'bottom_30_employees_by_performance_rating' => 'Bottom 30 Employees By Performance Rating',
                'report_on_overall_training_needs' => 'Report On Overall Training Needs',
                'report_on_training_needs_by_department' => 'Report On Training Needs By Department',
                'report_on_employees_percentage_distribution' => 'Report On Employees Percentage Distribution',
            ];

            // Assign roles based on permissions
           foreach ($permissionRoles as $permissionKey => $roleName) {
           if (!empty($validatedData['permission'][$permissionKey]) && $validatedData['permission'][$permissionKey] == 1) {
                $userForAssignRole->assignRole($roleName);
              }
            }

            //pusher notification
            event(new TestNotification(['message' => 'New admin created']));

            return response()->json(['message' => 'Admin created successfully'], 201);
            // dd($request->all());
        } catch (ValidationException $e) {
            // Return all validation errors
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        if (!(JWTAuth::user()->hasRole('admin') or JWTAuth::user()->hasRole('Total User')) ) {

            return response()->json(['message' => 'Unauthorized'], 401);
            // dd('admin');
            # code...
        }

        try {
            // Validate the string $id
            if (!is_string($id) || empty($id) || strlen($id) > 255) {
                throw new ValidationException(validator(['id' => $id], [
                    'id' => 'required|string|max:255',
                ]));
            }
    
            $data = User::with('userDetails')->where('staff_id', $id)->get()->toArray();

            if (empty($data)) {
                # code...
                return response()->json(['message' => 'No staff found'], 404);
            }

            $result = collect($data)->map(function($item){
                return [
                    "staff_id" => $item['staff_id'],
                    "ippis_no" => $item['ippis_no'],
                    // "is_active" => $item['user_details']['is_active'],
                    "grade_level" => $item['user_details']['grade_level'],
                    "F_name" => $item['F_name'],
                    "M_name" => $item['M_name'],
                    "L_name" => $item['L_name'],
                    "email" => $item['email'],
                    "phone" => $item['phone'],
                    "job_title" => $item['user_details']['job_title'],
                    "designation" => $item['user_details']['designation'],
                    "cadre" => $item['user_details']['cadre'],
                    "date_of_current_posting" => $item['user_details']['date_of_current_posting'],
                    "date_of_MDA_posting" => $item['user_details']['date_of_MDA_posting'],
                    "date_of_last_promotion" => $item['user_details']['date_of_last_promotion'],
                    "gender" => $item['user_details']['gender'],
                    "organization" => $item['user_details']['org_name'],
                    "role" => $item['is_admin'] == 1 ? 'admin' : 'user',
                    "recovery_email" => $item['user_details']['recovery_email'],
                ];
            });
            // dd($result);
            // Perform further actions using the validated id
            return response()->json([ "data" => $result], 200);
    
        } catch (ValidationException $th) {
            // Return a JSON response with validation errors
            return response()->json(['errors' => $th->errors()], 422);
        }
        // dd($id);
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
        if (!(JWTAuth::user()->hasRole('admin') or JWTAuth::user()->hasRole('Total User')) ) {

            return response()->json(['message' => 'Unauthorized'], 401);
            // dd('admin');
            # code...
        }

        if ($request->input('role') == 'admin' || $request->input('role') == 'Admin') {
            # code...

            return $this->updateAdmin($request);
            // dd('admin');
        }

        try {

            $validatedData =  $request->validate([
                'staff_id' => 'required|string|max:255',
                'ippis_no' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'F_Name' => 'required|string|max:255',
                'M_Name' => 'nullable|string|max:255',
                'L_Name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
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

            if ($id != $validatedData['staff_id']) {
                return response()->json(['message' => 'Unauthorized'], 401);              
            }
            $user = User::updateUser($id,$validatedData);

            if ($user) {
                $userDetails = UserDetail::updateUserDetails($id, $validatedData, $request);
                return response()->json(['message' => 'User updated successfully.']);
            } else {
                return response()->json(['message' => 'User update failed.'], 400);
            }

        } catch (ValidationException $e) {
            // Return all validation errors
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
        //
    }


    public function updateAdmin(){
        dd('admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if (!(JWTAuth::user()->hasRole('admin') or JWTAuth::user()->hasRole('Total User')) ) {

            return response()->json(['message' => 'Unauthorized'], 401);
            // dd('admin');
            # code...
        }

        try {
            // Validate the string $id
            if (!is_string($id) || empty($id) || strlen($id) > 255) {
                throw new ValidationException(validator(['id' => $id], [
                    'id' => 'required|string|max:255',
                ]));
            }
    
            $user = User::where('staff_id', $id)->first();
            if (empty($user)) {
                # code...
                return response()->json(['message' => 'No staff found'], 404);
            }

            $user->delete();
            return response()->json(['message' => 'Staff deleted successfully'], 200);
    
        } catch (ValidationException $th) {
            // Return a JSON response with validation errors
            return response()->json(['errors' => $th->errors()], 422);
        }
        // dd(123);
    }
}
