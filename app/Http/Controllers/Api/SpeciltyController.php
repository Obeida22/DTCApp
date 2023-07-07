<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specilties;

class SpeciltyController extends Controller
{
    public function index()
    {
        $specialties = Specilties::with('classSchedules', 'wishStudents')->get();

        return response()->json($specialties);
    }

    public function show($id)
    {
        $specialty = Specilties::with('classSchedules', 'wishStudents')->find($id);

        if (!$specialty) {
            return response()->json(['message' => 'Specialty not found'], 404);
        }

        return response()->json($specialty);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Specialty_Name' => 'required|string',
            'Mark' => 'required|integer',
        ]);

        $specialty = new Specilties();
        $specialty->Specialty_Name = $request->input('Specialty_Name');
        $specialty->Mark = $request->input('Mark');
        $specialty->save();

        return response()->json($specialty, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Specialty_Name' => 'required|string',
            'Mark' => 'required|integer',
        ]);

        $specialty = Specilties::find($id);

        if (!$specialty) {
            return response()->json(['message' => 'Specialty not found'], 404);
        }

        $specialty->Specialty_Name = $request->input('Specialty_Name');
        $specialty->Mark = $request->input('Mark');
        $specialty->save();

        return response()->json($specialty);
    }

    public function destroy($id)
    {
        $specialty = Specilties::find($id);

        if (!$specialty) {
            return response()->json(['message' => 'Specialty not found'], 404);
        }

        $specialty->delete();

        return response()->json(['message' => 'Specialty deleted']);
    }
}
