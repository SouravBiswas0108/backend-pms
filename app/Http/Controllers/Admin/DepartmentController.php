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
        $department = Department::get()->toArray();
        // dd($department);
        return view('admin.department.listview', compact('department'));
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

            foreach ($stafflist as $key => $value) {
                $userstaff = User::where('staff_id', '=', $value)->first();
                // dd($userstaff);

                $fname = ($userstaff['F_name'] != "") ? $userstaff['F_name'] . ' ' : '';
                $mid_name = ($userstaff['M_name'] != "") ? $userstaff['M_name'] . ' ' : '';
                $lname = ($userstaff['L_name'] != "") ? $userstaff['L_name'] . ' ' : '';

                $staff_name = $fname . $mid_name . $lname;
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
        $dept_id = decrypt($id);
        if (session()->has('year2')) {
            $year = session('year2');
            //dd($year);
        } else {
            $year = date('Y');
        }
        // print_r($dept_id);die('++++++');
        $user = Auth::user();
        $departmentlist = array();
        $departmentlist['activedepartmentstaff'] = array();
        $departmentlist['departmentallstaff'] = array();
        $data = array();
        $dept_user_organization = '';
        $departmentstafflist = DepartmentAssignStaff::select('*')->where('department_id', $dept_id)->where('year', $year)->get()->toArray();

        if (!empty($departmentstafflist)) {

            foreach ($departmentstafflist as $key => $value) {


                $userstaff = User::where('staff_id', $value['staff_id'])->first();
                if (isset($userstaff) && !empty($userstaff)) {
                    $fname = ($userstaff['F_name'] != "") ? $userstaff['F_name'] . ' ' : '';
                    $mid_name = ($userstaff['M_name'] != "") ? $userstaff['M_name'] . ' ' : '';
                    $lname = ($userstaff['L_name'] != "") ? $userstaff['L_name'] . ' ' : '';

                    $staff_name = $fname . $mid_name . $lname;
                    $data['stafflist'][$value['staff_id']] = $fname . $mid_name . $lname;
                }
            }

            // if(isset($departmentstafflist) && !empty($departmentstafflist)){
            //     foreach ($departmentstafflist as $key => $value) {
            //         dd( $departmentlist['departmentallstaff']);
            //         $departmentlist['departmentallstaff'][$key] = $value['staff_name'];
            //     }
            // }

            if ($user->type == 'Admin') {
                $department = Department::with('departmentAssignStaff')->where('department_id', '=', $dept_id)->where('year', $year)->first();

            } else {
                $department = Department::with('departmentAssignStaff')->where('department_id', '=', $dept_id)->first();
            }

            // dd($data);

            return view('admin.department.viewlistuser', compact('user', 'department', 'data'));
        } else {
            return redirect()->route('department')->with('error', __('Please Assign Staffs First!!'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dept_id = decrypt($id);
        if (session()->has('year2')) {
            $year = session('year2');
            //dd($year);
        } else {
            $year = date('Y');
        }
        // print_r($dept_id);die('++++++');
        $user = Auth::user();
        $departmentlist = array();
        $departmentlist['activedepartmentstaff'] = array();
        $departmentlist['departmentallstaff'] = array();
        $data = array();
        $dept_user_organization = '';
        $departmentstafflist = DepartmentAssignStaff::select('*')->where('department_id', $dept_id)->where('year', $year)->get()->toArray();
        // $departmentlist = $departmentstafflist;
        if (!empty($departmentstafflist)) {

            foreach ($departmentstafflist as $key => $value) {


                $userstaff = User::where('staff_id', $value['staff_id'])->first();
                if (isset($userstaff) && !empty($userstaff)) {
                    $fname = ($userstaff['F_name'] != "") ? $userstaff['F_name'] . ' ' : '';
                    $mid_name = ($userstaff['M_name'] != "") ? $userstaff['M_name'] . ' ' : '';
                    $lname = ($userstaff['L_name'] != "") ? $userstaff['L_name'] . ' ' : '';

                    $staff_name = $fname . $mid_name . $lname;
                    $data['stafflist'][$value['staff_id']] = $fname . $mid_name . $lname;
                }


            }

            $departmentlist = [];


            foreach ($departmentstafflist as $department) {
                // dd($department);
                $user = User::with('userDetails')->where('staff_id', $department['staff_id'])->first();

                if ($user) {
                    // Directly add the entire user object to the array
                    $departmentlist[] = $user;
                }
            }

            // dd($departmentlist);


            // if(isset($departmentstafflist) && !empty($departmentstafflist)){
            //     foreach ($departmentstafflist as $key => $value) {
            //         dd( $departmentlist['departmentallstaff']);
            //         $departmentlist['departmentallstaff'][$key] = $value['staff_name'];
            //     }
            // }

            if ($user->type == 'Admin') {
                $department = Department::with('departmentAssignStaff')->where('department_id', '=', $dept_id)->where('year', $year)->first();

            } else {
                $department = Department::with('departmentAssignStaff')->where('department_id', '=', $dept_id)->first();
            }

            // dd($data);

            return view('admin.department.edit', compact('user', 'department', 'data', 'departmentlist'));
        } else {
            return redirect()->route('department')->with('error', __('Please Assign Staffs First!!'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $departmentId = decrypt($id);
        // dd($request->dept_name);
        $oldDepartmentAssignStaffs = DepartmentAssignStaff::select('staff_id')->where('department_id', $departmentId)->get();
        $departmentDetails = Department::where('department_id', $departmentId)->first();
        
         if ($departmentDetails->department_name != $request->dept_name ) {
            # code...
            $departmentDetails->department_name = $request->dept_name ;
            $departmentDetails->save();
             
         }
        $oldStaff = [];
        foreach ($oldDepartmentAssignStaffs as $key => $staff) {
            # code...
            $oldStaff[] = $staff->staff_id;
        }

        $newAssignStaff = $request->checkall;

        $staffToRemove = array_diff($oldStaff, $newAssignStaff);

        if (isset($staffToRemove) && !empty($staffToRemove)) {
            $departmentId = decrypt($id);
            $deleteStaff = DepartmentAssignStaff::where('department_id', $departmentId)->whereIn('staff_id', $staffToRemove)->delete();
            dd(123);
        }

       return to_route('admin.departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function assignUserRole(string $id){
        dd(123);
    }
}
