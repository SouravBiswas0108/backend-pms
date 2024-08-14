<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(auth::user()->F_name);
        if ($request->ajax()) {
            // dd($request->all());
            $postdata = $request->all();
            $total = $filtered = 0;
            // if (\Auth::user()->can('Manage Users')) {
            $user = Auth::user();
            $filtered = 4;
            $users = User::with('userDetails')->get();
            if ($user->type == 'Admin') {

                $org_code = $user->org_code;
                $users = User::where('type', '!=', 'Admin')->where('org_code', '=', $org_code)->where('is_active', '=', 1)->orderBy('id', 'desc');
                $total = $users->count();
                if (isset($postdata['search']['value']) && $postdata['search']['value']) {
                    $search_value = $postdata['search']['value'];
                    $users->where(function ($query) use ($search_value) {
                        $query->orWhere('id', '=', $search_value);
                        $query->orWhere('ippis_no', 'like', '%' . $search_value . '%');
                        $query->orWhere('email', 'like', '%' . $search_value . '%');
                        $query->orWhere('staff_id', 'like', '%' . $search_value . '%');
                        $query->orWhere('fname', 'like', '%' . $search_value . '%');
                        $query->orWhere('mid_name', 'like', '%' . $search_value . '%');
                        $query->orWhere('lname', 'like', '%' . $search_value . '%');
                        $query->orWhere(DB::raw("CONCAT(fname,' ',mid_name,' ',lname)"), 'like', '%' . $search_value . '%');
                        $query->orWhere('type', 'like', '%' . $search_value . '%');
                    });
                    $filtered = $users->count();
                } else {
                    $filtered = $total;
                }

                $users->limit($postdata['length']);
                $users->offset($postdata['start']);
                $users = $users->get();
            }
            if ($user->type == 'Owner') {
                $users = User::where('type', '!=', 'Owner')->where('type', '!=', 'Client')->where('is_active', '=', 1)->orderBy('id', 'desc');
                $total = $users->count();
                if (isset($postdata['search']['value']) && $postdata['search']['value']) {
                    $search_value = $postdata['search']['value'];
                    $users->where(function ($query) use ($search_value) {
                        $query->orWhere('id', '=', $search_value);
                        $query->orWhere('ippis_no', 'like', '%' . $search_value . '%');
                        $query->orWhere('email', 'like', '%' . $search_value . '%');
                        $query->orWhere('staff_id', 'like', '%' . $search_value . '%');
                        $query->orWhere('fname', 'like', '%' . $search_value . '%');
                        $query->orWhere('mid_name', 'like', '%' . $search_value . '%');
                        $query->orWhere('lname', 'like', '%' . $search_value . '%');
                        $query->orWhere(DB::raw("CONCAT(fname,' ',mid_name,' ',lname)"), 'like', '%' . $search_value . '%');
                        $query->orWhere('type', 'like', '%' . $search_value . '%');
                    });
                    $filtered = $users->count();
                } else {
                    $filtered = $total;
                }

                $users->limit($postdata['length']);
                $users->offset($postdata['start']);
                $users = $users->get();
            }
            $result_set = [];
            // // dd($users);
            // foreach ($users as $user) {
            //     // Access user details for the current user
            //     $userDetail = $user->userDetails;

            //     // Check if userDetail is not null before accessing properties
            //     if ($userDetail) {
            //         dd($userDetail); // Replace 'some_property' with actual property name
            //     } else {
            //         echo "No user details available for user with ID: {$user->id}";
            //     }
            // }
            if (isset($users) && !empty($users)) {
                foreach ($users as $user) {
                    // dd($user);
                    $userDetail = $user->userDetails;
                    //  dd($userDetail->type);
                    $action = '';
                    if (\Auth::user()->designation != 'admin') {
                        $action .= '<span><a href="' . url('/users/show/' . strtr(base64_encode($user->id), '+/=', '-_A')) . '" class="edit-icon bg-warning"><i class="fas fa-eye"></i></a></span>';
                    }

                    if (\Auth::user()->can('Edit User')) {
                        $action .= '<span><a href="javascript:void(0)" class="edit-icon" data-url="' . url('/users/edit/' . strtr(base64_encode($user->staff_id), '+/=', '-_A')) . '" data-ajax-popup="true" data-title="' . __('Edit User') . '">
                            <i class="fas fa-pencil-alt"></i></a></span>';
                    }

                    if (\Auth::user()->can('Delete User')) {
                        $action .= '<span><a class="delete-icon" data-confirm="' . __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') . '" data-formid="delete-form-' . $user->id . '" data-confirm-yes="document.getElementById(\'delete-form-' . $user->id . '\').submit();">
                                <i class="fas fa-trash"></i></a><form method="POST" action="' . route('users.destroy', $user->id) . '" id="delete-form-' . $user->id . '">' . csrf_field() . method_field('DELETE') . '</form></span>';
                    }

                    $user_status = isset($user->status) && !empty($user->status) ? 'checked' : '';
                    $result_set[] = [
                        $user->id ?? '',
                        $user->ippis_no ?? '',
                        $user->staff_id ?? '',
                        '<a href="' . url('/users/show/' . strtr(base64_encode($user->id), '+/=', '-_A')) . '"> ' . (($user->F_name != '') ? $user->F_name : '') . ' ' . (($user->M_name != '') ? $user->M_name : '') . ' ' . (($user->L_name != '') ? $user->L_name : '') . '</a>',
                        $user->email ?? '',
                        '<label class="switch">
                            <input type="checkbox" ' . $user_status . ' class="toggle_activity" value="' . (($user->id != '') ? base64_encode($user->id) : '') . '" data-toggle="' . (($user->status != '') ? $user->status : '') . '">

                            <span class="slider round"></span>
                            </label>',
                        $userDetail->type ?? '',
                        '<a href="' . url('/users/show/' . strtr(base64_encode($user->id), '+/=', '-_A')) . '.". class="edit-icon bg-warning"> <i class="fas fa-eye"></i></a><a href="' . url('/users/show/' . strtr(base64_encode($user->id), '+/=', '-_A')) . '.". class="edit-icon bg-warning"> 
                              <i class="fas fa-eye"></i></a>',
                        $action
                    ];
                }
            }

            $json_data = array(
                "draw"            => intval($postdata['draw']),
                "recordsTotal"    => intval($total),
                "recordsFiltered" => intval($filtered),
                "data"            => $result_set,
            );
            // echo json_encode($json_data);
            return $json_data;
            // echo "<pre>";
            // print_r($result_set);
            // die('+');
            // }
        }
        $settings = Utility::settings();
        $users = User::paginate(10); // Paginate with 10 items per page;
        return view('admin.users.index', compact('settings', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
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
                'recovery_email' => 'nullable|max:255',
                'role' => 'nullable|max:255'
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

            // dd(auth::user()->id);

            UserDetail::create([
                'staff_id' => 'STAFF352162',
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
                'created_by' => auth::user()->id,
                'type' => $validatedData['role'],
            ]);


            return redirect()->back();
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage(), 'line' => $th->getLine()];
        }


        // print_r($organization);die('++++');


        // else
        // {
        //     return response()->json(['error' => __('Permission Denied.')], 401);
        // }
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

    public function sessionYearSave()
    {
        if (isset($_POST['year'])) {

            if (session()->has('year2')) {
                session()->forget('year2');
            }
            $year = $_POST['year'];
            session()->put('year2', $year);
        }
        return response()->json(['success' => 'sucess']);
    }
}
