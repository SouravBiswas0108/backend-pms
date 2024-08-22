<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSubTask;
use App\Http\Requests\StoreEmployeeSubTaskRequest;
use App\Http\Requests\UpdateEmployeeSubTaskRequest;

class EmployeeSubTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(456);
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
    public function store(StoreEmployeeSubTaskRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeSubTask $employeeSubTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeSubTask $employeeSubTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeSubTaskRequest $request, EmployeeSubTask $employeeSubTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeSubTask $employeeSubTask)
    {
        //
    }
}
