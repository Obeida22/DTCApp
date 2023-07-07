<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guardians;
use App\Models\Students;
use Illuminate\Http\Request;

class GuardianController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $studentId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'Guardian_Name' => 'required|string',
            'Guardian_Job' => 'nullable|string',
            'Guardian_Phone' => 'nullable|string',
        ]);

        // Find the student by ID
        $student = Students::findOrFail($studentId);

        // Create a new guardian instance and fill it with the validated data
        $guardian = new Guardians($validatedData);

        // Associate the guardian with the student
        $student->guardians()->save($guardian);

        // Return a success response
        return response()->json(['message' => 'Guardian created'], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $studentId
     * @param  int  $guardianId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $studentId, $guardianId)
    {
        // Find the student by ID
        $student = Students::findOrFail($studentId);

        // Get the guardian associated with the student by ID
        $guardian = $student->guardians()->findOrFail($guardianId);

        // Validate the request data
        $validatedData = $request->validate([
            'Guardian_Name' => 'required|string',
            'Guardian_Job' => 'nullable|string',
            'Guardian_Phone' => 'nullable|string',
        ]);

        // Update the guardian with the validated data
        $guardian->fill($validatedData)->save();

        // Return a success response
        return response()->json(['message' => 'Guardian updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $studentId
     * @param  int  $guardianId
     * @return \Illuminate\Http\Response
     */
    public function destroy($studentId, $guardianId)
    {
        // Find the student by ID
        $student = Students::findOrFail($studentId);

        // Get the guardian associated with the student by ID
        $guardian = $student->guardians()->findOrFail($guardianId);

        // Delete the guardian
        $guardian->delete();

        // Return a success response
        return response()->json(['message' => 'Guardian deleted'], 200);
    }
}
