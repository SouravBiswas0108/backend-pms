<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stafflist = User::with('userDetails')->get()->toArray();
// dd($stafflist);
        $data  = collect($stafflist)->map(function($item){
          return [
               "id" => $item['id'],
               "staff_id" => $item['staff_id'],
               "ippis_no" => $item['ippis_no'],
               "name" => $item['F_name']." ".$item['M_name']." ".$item['L_name'],
               "email" => $item['email'],
               "is_active" => $item['user_details']['is_active'],
               "type" => "user",
               "grade_level" => $item['user_details']['grade_level'],
          ];
        });

        if($data->isEmpty()){
            return response()->json(['message' => 'No staff found'], 404);
        }   
        else {
            return response()->json(['data' => $data], 200);
        }
        // dd($data); 
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
