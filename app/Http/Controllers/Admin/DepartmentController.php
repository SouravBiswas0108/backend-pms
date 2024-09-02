<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentAssignStaff;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
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


        $validator = Validator::make(
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

        if ($departmentDetails->department_name != $request->dept_name) {
            # code...
            $departmentDetails->department_name = $request->dept_name;
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
            // dd(123);
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


    public function assignUserRole(string $id)
    {

        $departmentId = decrypt($id);
        if (session()->has('year2')) {
            $year = session('year2');
            //dd($year);
        } else {
            $year = date('Y');
        }
        $department = Department::where('department_id', $departmentId)->first();
        // dd($department);
        $departmentstafflists = DepartmentAssignStaff::where('department_id', $departmentId)->where('year', $year)->get()->toArray();


        $collectionStaff = collect($departmentstafflists);
        $officer = $collectionStaff->firstWhere('assign_role_name', 'Officer');
        $officer_id = $officer['staff_id'] ?? null;

        $supervisor_id = [];

        $data = [];
        // $departmentstafflist = [];
        $objUser = Auth::user();
        // dd($officer_id);

        if (isset($departmentstafflists) && !empty($departmentstafflists)) {
            // $org_code = $objUser->org_code;

            if (($departmentstafflists != '') || ($departmentstafflists != null)) {

                foreach ($departmentstafflists as $key => $value) {

                    $userstaff = User::with('userDetails')->where('staff_id', $value['staff_id'])->first();
                    if (isset($userstaff) && !empty($userstaff)) {
                        $fname = ($userstaff['F_name'] != "") ? $userstaff['F_name'] . ' ' : '';
                        $mid_name = ($userstaff['M_name'] != "") ? $userstaff['M_name'] . ' ' : '';
                        $lname = ($userstaff['L_name'] != "") ? $userstaff['L_name'] . ' ' : '';

                        $staff_name = $fname . $mid_name . $lname;
                        $data['stafflist'][$value['staff_id']] = $fname . $mid_name . $lname;
                    }
                    if ($value['assign_role_name'] == 'Supervisor') {
                        # code...
                        $supervisor_id[] = $value['staff_id'];
                    }
                }
            }


        }

        return view('admin.department.assignUserRole', compact('department', 'data', 'supervisor_id', 'officer_id'));

        // dd($departmentstafflists);
    }

    public function assignUserstore(Request $request)
    {
        if (session()->has('year2')) {
            $year = session('year2');
            //dd($year);
        } else {
            $year = date('Y');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'supervisor_name' => 'required',
                'officer_name' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return to_route('admin.departments.index')->with('error', $messages->first());
        }

        $oldSupervisorIds = [];
        $newSupervisorIds = $request->supervisor_name;

        $departmentId = $request->dept_id;
        $oldSupervisorLists = DepartmentAssignStaff::where('department_id', $departmentId)->where('assign_role_name', 'Supervisor')->where('year', '2024')->get()->toArray();

        foreach ($oldSupervisorLists as $key => $supervisorList) {
            # code...
            $oldSupervisorIds[] = $supervisorList['staff_id'];
        }

        $demotedSupervisors = array_diff($oldSupervisorIds, $newSupervisorIds);
        $promotedSupervisors = array_diff($newSupervisorIds, $oldSupervisorIds);

        if ($demotedSupervisors) {
            # code...
            $oldSupervisor = DepartmentAssignStaff::whereIn('staff_id', $demotedSupervisors)->where('year', '2024')->update(['assign_role_name' => 'Staff']);
        }

        if ($promotedSupervisors) {
            # code...
            $newSupervisor = DepartmentAssignStaff::whereIn('staff_id', $promotedSupervisors)->where('year', '2024')->update(['assign_role_name' => 'Supervisor']);

        }

        return to_route('admin.departments.index')->with('success', __('Department Updated Successfully!'));

    }

    public function assignStaff(string $id)
    {

        $departmentId = decrypt($id);
        // dd($departmentId);
        if (session()->has('year2')) {
            $year = session('year2');
            //dd($year);
        } else {
            $year = date('Y');
        }
        $department = Department::where('department_id', $departmentId)->first();
        // dd($department);
        $departmentstafflists = DepartmentAssignStaff::where('department_id', $departmentId)->where('year', $year)->get()->toArray();


        $collectionStaff = collect($departmentstafflists);
        $officer = $collectionStaff->firstWhere('assign_role_name', 'Officer');
        $officer_id = $officer['staff_id'] ?? null;

        $supervisor_id = [];

        $data = [];
        // $departmentstafflist = [];
        $objUser = Auth::user();
        // dd($officer_id);

        if (isset($departmentstafflists) && !empty($departmentstafflists)) {
            // $org_code = $objUser->org_code;

            if (($departmentstafflists != '') || ($departmentstafflists != null)) {

                foreach ($departmentstafflists as $key => $value) {

                    $userstaff = User::with('userDetails')->where('staff_id', $value['staff_id'])->first();
                    if (isset($userstaff) && !empty($userstaff)) {
                        $fname = ($userstaff['F_name'] != "") ? $userstaff['F_name'] . ' ' : '';
                        $mid_name = ($userstaff['M_name'] != "") ? $userstaff['M_name'] . ' ' : '';
                        $lname = ($userstaff['L_name'] != "") ? $userstaff['L_name'] . ' ' : '';

                        $staff_name = $fname . $mid_name . $lname;
                        $data['stafflist'][$value['staff_id']] = $fname . $mid_name . $lname;
                    }
                    if ($value['assign_role_name'] == 'Supervisor') {
                        # code...
                        $supervisor_id[] = $value['staff_id'];
                    }
                }
            }


        }

        return view('admin.department.assignStaff', compact('department', 'data', 'supervisor_id', 'officer_id'));

        // dd($departmentstafflists);
    }

    public function assignstaffstore()
    {
        dd(123);
    }
}
