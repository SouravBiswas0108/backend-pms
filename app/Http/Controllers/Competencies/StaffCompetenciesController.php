<?php

namespace App\Http\Controllers\Competencies;

use App\Http\Controllers\Controller;
use App\Models\Competencies;
use Illuminate\Http\Request;

class StaffCompetenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->all();
        // return response()->json($request->all());   

        $competencies = [];
        if (isset($data['Competencies']) && is_array($data['Competencies'])) {
            foreach ($data['Competencies'] as $competencyGroup) {
                $competencies = array_merge($competencies, array_keys($competencyGroup));
            }
        }
        if (empty($competencies)) {
            # code...
            return response()->json([
                "response" => "enter Competencies to run the api"
            ], 404);
        }
        foreach ($competencies as $competenciey) {
            $answer = Competencies::updateOrCreate(
                [
                    'competencies' => $competenciey,
                    'staff_id' => $request->staff_id,
                    'dept_id' => $request->dept_id,
                    'year' => $request->year,
                    'quarter' => $request->quarter,
                ],
                []
            );
        }

        //need to do the second part 
        

        return response()->json([
            "response" => "data updated succesfully"
        ]);
        // dd($competencies);
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
