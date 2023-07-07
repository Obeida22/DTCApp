<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = Classes::all();

        return response()->json($classes);
    }

    public function show($id)
    {
        $class = Classes::find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        return response()->json($class);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Class_Name' => 'required|string',
            'Specialty_ID' => 'required|integer',
            'Department_ID' => 'required|integer',
        ]);

        $class = new Classes();
        $class->Class_Name = $request->input('Class_Name');
        $class->specialty_id = $request->input('specialty_id');
        $class->Department_ID = $request->input('Department_ID');
        $class->save();

        return response()->json($class, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Class_Name' => 'required|string',
            'Specialty_ID' => 'required|integer',
            'Department_ID' => 'required|integer',
        ]);

        $class = Classes::find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $class->Class_Name = $request->input('Class_Name');
        $class->Specialty_ID = $request->input('Specialty_ID');
        $class->Department_ID = $request->input('Department_ID');
        $class->save();

        return response()->json($class);
    }

    public function destroy($id)
    {
        $class = Classes::find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $class->delete();

        return response()->json(['message' => 'Class deleted']);
    }
}
