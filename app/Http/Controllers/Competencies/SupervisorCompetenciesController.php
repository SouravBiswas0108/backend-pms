<?php

namespace App\Http\Controllers\Competencies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competencies;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class SupervisorCompetenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'supervisor_id' => 'required|string|max:20',
                'staff_id' => 'required|string|max:20',
                'dept_id' => 'required|string',
                'year' => 'required|numeric',
                'quarter' => 'required|numeric'
            ]);

            $superviorId = JWTAuth::user()->staff_id;

            if ($superviorId != $validatedData['supervisor_id']) {
                # code...
                return response()->json(["messege" => 'correct the supervisor credentials'],401);
            }

            $data = Competencies::with('competenciesDetails')
            ->allCheck($validatedData['staff_id'],$validatedData['dept_id'],$validatedData['year'],$validatedData['quarter']);

            if (count($data) === 0) {
                return response()->json([
                    "message" => "There is no data"
                ], 404);
            }
            
            return response()->json([
                "competenciesDetails"=>$data
            ]);

        } catch (ValidationException $e) {
            // Return a JSON response if validation fails
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
     
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
