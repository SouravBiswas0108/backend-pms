<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

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
            $user  = Auth::user();
            if($user->type == 'Admin'){
                $org_code = $user->org_code;
                $organization  = Organization::where('org_code', '=', $org_code)->get()->toArray();
                $stafflist = User::where('type', '=', 'User')->where('org_code', '=', $org_code)->get()->toArray();

            }else{
                $organization  = Organization::get();
                $stafflist = User::where('type', '=', 'User')->get()->toArray();
            }
              // print_r($stafflist);die('++++');
            return view('department.create', compact('organization','user','stafflist'));
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
