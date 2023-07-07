<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students_Mode;
use App\Models\Students;

class StudentModeController extends Controller
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
            'Agency_Card_Number' => 'required|numeric',
            'Existence_Hard_Case' => 'required|boolean',
            'hard_case' => 'nullable|string',
            'Disability_Status' => 'nullable|string',
        ]);

        // Find the student by ID
        $student = Students::findOrFail($studentId);

        // Create a new student mode instance and fill it with the validated data
        $Students_Mode = new Students_Mode($validatedData);

        // Associate the student mode with the student
        $student->studentMode()->save($Students_Mode);

        // Return a success response
        return response()->json(['message' => 'Student mode created'], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $studentId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $studentId)
    {
        // Find the student by ID
        $student = Students::findOrFail($studentId);

        // Get the student mode associated with the student
        $Students_Mode = $student->Students_Mode;

        // If the student mode doesn't exist, return an error response
        if (!$Students_Mode) {
            return response()->json(['message' => 'Student mode not found'], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'Agency_Card_Number' => 'required|numeric',
            'Existence_Hard_Case' => 'required|boolean',
            'hard_case' => 'nullable|string',
            'Disability_Status' => 'nullable|string',
        ]);

        // Update the student mode with the validated data
        $Students_Mode->fill($validatedData)->save();

        // Return a success response
        return response()->json(['message' => 'Student mode updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $studentId
     * @return \Illuminate\Http\Response
     */
    public function destroy($studentId)
    {
        // Find the student by ID
        $student = Students::findOrFail($studentId);

        // Get the student mode associated with the student
        $Students_Mode = $student->Students_Mode;

        // If the student mode doesn't exist, return an error response
        if (!$Students_Mode) {
            return response()->json(['message' => 'Student mode not found'], 404);
        }

        // Delete the student mode
        $Students_Mode->delete();

        // Return a success response
        return response()->json(['message' => 'Student mode deleted'], 200);
    }
}
