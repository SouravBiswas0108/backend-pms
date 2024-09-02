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
        if (session()->has('year2')) {
            $year = session('year2');
            //dd($year);
        } else {
            $year = date('Y');
        }
        $department = Department::get()->toArray();
        // dd($department);
        return view('admin.department.listview', compact('department', 'year'));
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
                $department = Department::with('departmentAssignStaffs')->where('department_id', '=', $dept_id)->where('year', $year)->first();

            } else {
                $department = Department::with('departmentAssignStaffs')->where('department_id', '=', $dept_id)->first();
            }

            // dd($data);

            return view('admin.department.viewlistuser', compact('user', 'department', 'data'));
        } else {
            return redirect()->route('admin.departments.index')->with('error', __('Please Assign Staffs First!!'));
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
                $department = Department::with('departmentAssignStaffs')->where('department_id', '=', $dept_id)->where('year', $year)->first();

            } else {
                $department = Department::with('departmentAssignStaffs')->where('department_id', '=', $dept_id)->first();
            }

            // dd($data);

            return view('admin.department.edit', compact('user', 'department', 'data', 'departmentlist'));
        } else {
            return redirect()->route('admin.departments.index')->with('error', __('Please Assign Staffs First!!'));
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
        // dd($request->all());
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return to_route('admin.departments.index')->with('error', $messages->first());
        }

        $oldSupervisorIds = [];
        $newSupervisorIds = $request->supervisor_name;

        $departmentId = $request->dept_id;

        $oldOfficer = DepartmentAssignStaff::where('department_id', $departmentId)->where('assign_role_name', 'Officer')->where('year', $year)->first();

        if (!$oldOfficer) {
            # code...

            $officer = DepartmentAssignStaff::where('department_id', $departmentId)->where('staff_id', $request->officer_name)->where('year', $year)->update(['assign_role_name' => 'Officer']);
            $departmentOfficerUpdate = DepartmentAssignStaff::where('department_id', $departmentId)->where('year', $year)->update(['officer_id' => $request->officer_name]);
        } elseif ($oldOfficer->staff_id != $request->officer_name) {

            $assignationChange = DepartmentAssignStaff::where('department_id', $departmentId)->where('staff_id', $request->officer_name)->where('year', $year)->update(['supervisor_id' => null]);
            $promotedOfficer = DepartmentAssignStaff::where('department_id', $departmentId)->where('staff_id', $request->officer_name)->where('year', $year)->update(['assign_role_name' => 'Officer']);
            $demotedOfficer = DepartmentAssignStaff::where('department_id', $departmentId)->where('staff_id', $oldOfficer->staff_id)->where('year', $year)->update(['assign_role_name' => 'Staff']);
            $departmentOfficerUpdate = DepartmentAssignStaff::where('department_id', $departmentId)->where('year', $year)->update(['officer_id' => $request->officer_name]);

        }
        // dd($oldOfficer);


        $oldSupervisorLists = DepartmentAssignStaff::where('department_id', $departmentId)->where('assign_role_name', 'Supervisor')->where('year', $year)->get()->toArray();

        foreach ($oldSupervisorLists as $key => $supervisorList) {
            # code...
            $oldSupervisorIds[] = $supervisorList['staff_id'];
        }

        $demotedSupervisors = array_diff($oldSupervisorIds, $newSupervisorIds);
        $promotedSupervisors = array_diff($newSupervisorIds, $oldSupervisorIds);

        if ($demotedSupervisors) {
            # code...
            $demotedSupervisorUpdate = DepartmentAssignStaff::where('department_id', $departmentId)->whereIn('supervisor_id', $demotedSupervisors)->where('year', $year)->update(['supervisor_id' => null]);
            $oldSupervisor = DepartmentAssignStaff::where('department_id', $departmentId)->whereIn('staff_id', $demotedSupervisors)->where('year', $year)->update(['assign_role_name' => 'Staff']);
        }

        if ($promotedSupervisors) {
            # code...
            $newSupervisor = DepartmentAssignStaff::where('department_id', $departmentId)->whereIn('staff_id', $promotedSupervisors)->where('year', $year)->update(['assign_role_name' => 'Supervisor']);

        }

        // dd($request->all());

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
        // dd($data);

        return view('admin.department.assignStaff', compact('department', 'data', 'supervisor_id', 'officer_id'));

        // dd($departmentstafflists);
    }

    public function assignstaffstore(Request $request)
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
                'Staffs' => 'required',
            ]
        );
        if ($request->Staffs == null) {
            # code...
            $request->merge([
                'Staffs' => $request->input('Staffs', []), // Ensure Staffs is an array
            ]);
        }


        $officer_id = DepartmentAssignStaff::where('department_id', $request->dept_id)->where('supervisor_id', $request->supervisor_name)->where('year', $year)->first();
        // dd($officer_id);
        $oldStaffList = DepartmentAssignStaff::where('department_id', $request->dept_id)->where('supervisor_id', $request->supervisor_name)->where('year', $year)->get()->toArray();
        $oldStaffs = [];
        foreach ($oldStaffList as $key => $staff) {
            # code...
            $oldStaffs[] = $staff['staff_id'];
        }

        $newStaffs = $request->Staffs;

        // dd($newStaffs);

        $demotedStaff = array_diff($oldStaffs, $newStaffs);
        $promotedStaff = array_diff($newStaffs, $oldStaffs);

        if ($demotedStaff) {
            # code...
            $demoted = DepartmentAssignStaff::where('department_id', $request->dept_id)->where('supervisor_id', $request->supervisor_name)->where('year', $year)->whereIn('staff_id', $demotedStaff)->update(['supervisor_id' => null]);
        }

        if ($promotedStaff) {
            # code...
            $promoted = DepartmentAssignStaff::where('department_id', $request->dept_id)->where('year', $year)->whereIn('staff_id', $promotedStaff)->update(['supervisor_id' => $request->supervisor_name]);
        }

        return to_route('admin.departments.index')->with('success', __('Department Updated Successfully!'));
    }

    public function staffSelect($supervisor_id, $dept_id)
    {
        if (session()->has('year2')) {
            $year = session('year2');
            //dd($year);
        } else {
            $year = date('Y');
        }
        // $supervisorDetails = User::with('userDetails')->where('staff_id', $supervisor_id)->first();

        $Staffs_info = DepartmentAssignStaff::with('user')->where('supervisor_id', $supervisor_id)->orWhere('supervisor_id', null)->where('year', $year)->where('department_id', $dept_id)->where('staff_id', '!=', $supervisor_id)->where('assign_role_name', '!=', 'Officer')->get();
       
        return response()->json($Staffs_info);
    }
}
