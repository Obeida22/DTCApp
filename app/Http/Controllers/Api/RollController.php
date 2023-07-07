<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rolls;
use Illuminate\Http\Request;

class RollController extends Controller
{
    public function index()
    {
        $rolls = Rolls::withCount('users')->get();

        return response()->json($rolls);
    }

    public function show($id)
    {
        $roll = Rolls::with('users')->find($id);

        if (!$roll) {
            return response()->json(['message' => 'Roll not found'], 404);
        }

        return response()->json($roll);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Roll_Name' => 'required|string',
        ]);

        $roll = new Rolls();
        $roll->Roll_Name = $request->input('Roll_Name');
        $roll->save();

        return response()->json($roll, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Roll_Name' => 'required|string',
        ]);

        $roll = Rolls::find($id);

        if (!$roll) {
            return response()->json(['message' => 'Roll not found'], 404);
        }

        $roll->Roll_Name = $request->input('Roll_Name');
        $roll->save();

        return response()->json($roll);
    }

    public function destroy($id)
    {
        $roll = Rolls::find($id);

        if (!$roll) {
            return response()->json(['message' => 'Roll not found'], 404);
        }

        $roll->delete();

        return response()->json(['message' => 'Roll deleted']);
    }
}
