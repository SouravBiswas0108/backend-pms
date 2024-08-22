<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentAssignStaff;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.department.listview');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = [];
        $user = Auth::user();
        // dd($user->userDetails);

        $org_code = $user->org_code;
        $organization = Organization::where('org_code', '=', $org_code)->get()->toArray();
        $stafflist = User::with('userDetails')->whereHas('userDetails', function ($query) {
            $query->where('type', 'user');
        })->get()->toArray();
        // dd($stafflist);


        // print_r($stafflist);die('++++');
        return view('admin.department.create', compact('organization', 'user', 'stafflist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $objUser = Auth::user();
        $resp = '';


        $validator = \Validator::make(
            $request->all(),
            [
                'dept_id' => 'required',
                'dept_name' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->route('admin.department.create')->with('error', $messages->first());
        }

        if ($request->selected_staff != '') {
            $staffs = $request->selected_staff;
        } else {
            $staffs = null;
        }
        $user = Department::create(
            [
                'department_id' => $request->dept_id,
                'department_name' => $request->dept_name,
                'org_code' => $request->org_code,
                // 'staff_list' => $staffs,
                // 'created_by' => $objUser->id,
                // 'created_at' => date('Y-m-d H:i:s'),
                // 'updated_at' => date('Y-m-d H:i:s'),
                // 'year' => $request->year
            ]
        );
        // dd('hi');
        if (isset($request->selected_staff) && !empty($request->selected_staff)) {
         

            $stafflist = explode(',', $request->selected_staff);

            foreach ($stafflist as $key => $value)
            {
                $userstaff = User::where('staff_id', '=', $value)->first();
                // dd($userstaff);

                $fname = ($userstaff['F_name'] != "") ? $userstaff['F_name'].' ' : '';
                $mid_name = ($userstaff['M_name'] != "") ? $userstaff['M_name'].' ' : '';
                $lname = ($userstaff['L_name'] != "") ? $userstaff['L_name'].' ' : '';

                $staff_name =  $fname.$mid_name.$lname;
                $user = DepartmentAssignStaff::create(
                    [
                        'department_id' => $request->dept_id,
                        // 'org_code' => $request->org_code,
                        'staff_id' => $value,
                        // 'staff_name' => $staff_name,
                        'assign_role_name' => 'Staff',
                        'assign_role_id' => '0001',
                        'year' => $request->year,
                        'created_by' => $objUser->id,
                    ]
                );
            }
        }
        return redirect()->route('admin.departments.index')->with('success', __('Department created Successfully!') . ((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));

        // dd($objUser);
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
