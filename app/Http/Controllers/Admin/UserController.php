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
                        '<a href="' . url('/users/show/' . strtr(base64_encode($user->id), '+/=', '-_A')) . '.". class="edit-icon bg-warning"> <i class="fas fa-eye"></i></a>   <a href="' . url('/users/show/' . strtr(base64_encode($user->id), '+/=', '-_A')) . '.". class="edit-icon bg-warning"> 
                              <i class="fas fa-eye"></i></a>
                            <a href="' . url('/users/show/' . strtr(base64_encode($user->id), '+/=', '-_A')) . '.". class="edit-icon bg-warning"> 
                              <i class="fas fa-eye"></i></a>  ',
                        $action
                    ];
                }
            }

            $json_data = array(
                "draw" => intval($postdata['draw']),
                "recordsTotal" => intval($total),
                "recordsFiltered" => intval($filtered),
                "data" => $result_set,
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
    public function create()
    {
    }

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
    public function show($user_id)
    {
        $user_id = strtr(base64_decode($user_id), '+/=', '-_A');
        $usr = Auth::user();
        $user = User::find($user_id);
        return view('admin.users.show', compact('user'));
        // dd($user->userDetails->gender);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userId = base64_decode(strtr($id, '-_A', '+/='));
        $user = User::findOrFail($userId);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($id);
        $user = User::with('userDetails')->where('id', $id)->first();

        $changesMade = false;

        if ($user->ippis_no !== $request->ippis_no) {
            $user->ippis_no = $request->ippis_no;
            $changesMade = true;
        }

        if ($user->F_name !== $request->fname) {
            $user->F_name = $request->fname;
            $changesMade = true;
        }

        if ($user->M_name !== $request->mid_name) {
            $user->M_name = $request->mid_name;
            $changesMade = true;
        }
        if ($user->L_name !== $request->lname) {
            $user->L_name = $request->lname;
            $changesMade = true;
        }
        if ($user->email !== $request->email) {
            $user->email = $request->email;
            $changesMade = true;
        }
        if ($user->phone !== $request->phone) {
            $user->phone = $request->phone;
            $changesMade = true;
        }
        if ($user->userDetails->job_title !== $request->job_title) {
            $user->userDetails->job_title = $request->job_title;
            $changesMade = true;
        }
        if ($user->userDetails->designation !== $request->designation) {
            $user->userDetails->designation = $request->designation;
            $changesMade = true;
        }
        if ($user->userDetails->cadre !== $request->cadre) {
            $user->userDetails->cadre = $request->cadre;
            $changesMade = true;
        }
        if ($user->userDetails->date_of_current_posting !== $request->date_of_current_posting) {
            $user->userDetails->date_of_current_posting = $request->date_of_current_posting;
            $changesMade = true;
        }
        if ($user->userDetails->date_of_MDA_posting !== $request->date_of_MDA_posting) {
            $user->userDetails->date_of_MDA_posting = $request->date_of_MDA_posting;
            $changesMade = true;
        }
        if ($user->userDetails->date_of_last_promotion !== $request->date_of_last_promotion) {
            $user->userDetails->date_of_last_promotion = $request->date_of_last_promotion;
            $changesMade = true;
        }
        if ($user->userDetails->gender !== $request->gender) {
            $user->userDetails->gender = $request->gender;
            $changesMade = true;
        }
        if ($user->userDetails->grade_level !== $request->grade_level) {
            $user->userDetails->grade_level = $request->grade_level;
            $changesMade = true;
        }
        if ($user->userDetails->org_name !== $request->organization) {
            $user->userDetails->org_name = $request->organization;
            $changesMade = true;
        }
        if ($user->userDetails->type !== $request->role) {
            $user->userDetails->type = $request->role;
            $changesMade = true;
        }
        if ($user->userDetails->recovery_email !== $request->recovery_email) {
            $user->userDetails->recovery_email = $request->recovery_email;
            $changesMade = true;
        }


        
        if ($changesMade) {
            $user->save(); // Save the User model
        
            // Check if userDetails exists before trying to save
            if ($user->userDetails) {
                $user->userDetails->save(); // Save the UserDetails model
            }
        
            return redirect()->back()->with('success', 'User details updated successfully.');
        } else {
            return redirect()->back()->with('info', 'No changes were made.');
        }




        


      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();

        if ($user) {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', __('User Deleted Successfully!'));
        } else {
            return redirect()->back()->with('error', __('Invalid User.'));
        }
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


    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $objUser = Auth::user();
        $validation = [];
        $validation['F_name'] = 'required';
        $validation['L_name'] = 'required';
        // $validation['email'] = 'required|email|unique:users,email,' . Auth::user()->id;
        $validation['email'] = 'required|email';
        if ($request->avatar) {
            $validation['avatar'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $request->validate($validation);

        if ($request->avatar) {
            // dd($request->all());
            \File::delete(storage_path('avatars/' . $objUser->avatar));
            $avatarName = $objUser->id . '_avatar' . time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars', $avatarName);
            // print_r($request->avatar->storeAs('avatars', $avatarName));die('++++');
            $post['avatar'] = $avatarName;
        }
        $post['F_name'] = $request['F_name'];
        $post['M_name'] = ($request['M_name']) ? $request['M_name'] : '';
        $post['L_name'] = $request['L_name'];
        $post['email'] = $request['email'];
        $post['updated_at'] = date('Y-m-d H:i:s');

        $objUser->where('id', $request['user_ai_id'])->update($post);
        return redirect()->back()->with('success', __('Profile Updated Successfully!'));
        // dd($request->all());


    }

    public function userpassword(Request $request)
    {
        $randomString = '';
        $staff_name = '';
        $uArr = [];
        if (Auth::Check()) {
            $request_data = $request->All();
            $randomString = chr(rand(65, 90));
            for ($i = 0; $i < 6; $i++) {
                if ($i < 6) {
                    $randomString .= rand(0, 9);
                }
                if ($i == 8) {
                    //$randomString.=chr(rand(65,90));
                }
            }
            $obj_user = User::find($request_data['user_tbl_id']);
            $message = 'Please Copy this New Password : ' . $randomString . ' For Staff Id : ' . $request_data['user_staff_id'];
            session([
                'pwd_reset_msg' => [
                    $request_data['user_staff_id'] => $message
                ]
            ]);

            $data = [
                'email' => $obj_user->email,
                'password' => $randomString,
            ];
            $obj_user->password = Hash::make($randomString);
            $obj_user->save();
            $encode_id = strtr(base64_encode($request_data['user_tbl_id']), '+/=', '-_A');

            return redirect()->route('admin.users.show', $encode_id)->with('success', __('Your password is updated now and send to your registered email! Please check your mail'));

        } else {
            return redirect()->route('users.show', $encode_id)->with('error', __('Something is wrong!'));
        }
    }
}
