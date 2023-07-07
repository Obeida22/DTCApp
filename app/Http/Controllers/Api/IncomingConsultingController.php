<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incoming_Consulting;

class IncomingConsultingController extends Controller
{
    public function index()
    {
        $incomingConsultings = Incoming_Consulting::all();
        return response()->json(['data' => $incomingConsultings]);
    }

    public function show($id)
    {
        $incomingConsulting = Incoming_Consulting::findOrFail($id);
        return response()->json(['data' => $incomingConsulting]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Consulting_ID' => 'required|exists:consultings_schedules,id',
            'Student_ID' => 'required|exists:users,id',
        ]);

        $incomingConsulting = Incoming_Consulting::create($validatedData);

        return response()->json(['message' => 'Incoming consulting created successfully', 'data' => $incomingConsulting]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Consulting_ID' => 'required|exists:consultings_schedules,id',
            'Student_ID' => 'required|exists:users,id',
        ]);

        $incomingConsulting = Incoming_Consulting::findOrFail($id);
        $incomingConsulting->update($validatedData);

        return response()->json(['message' => 'Incoming consulting updated successfully', 'data' => $incomingConsulting]);
    }

    public function destroy($id)
    {
        $incomingConsulting = Incoming_Consulting::findOrFail($id);
        $incomingConsulting->delete();

        return response()->json(['message' => 'Incoming consulting deleted successfully']);
    }
}
