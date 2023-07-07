<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultings;
use Illuminate\Http\Request;

class ConsultingController extends Controller
{
    public function index()
    {
        $consultings = Consultings::all();

        return response()->json($consultings);
    }

    public function show($id)
    {
        $consulting = Consultings::find($id);

        if (!$consulting) {
            return response()->json(['message' => 'Consulting not found'], 404);
        }

        return response()->json($consulting);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'answer_text' => 'nullable|string',
        ]);

        $consulting = new Consultings();
        $consulting->type = $request->input('type');
        $consulting->answer_text = $request->input('answer_text');
        $consulting->save();

        return response()->json($consulting, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'answer_text' => 'nullable|string',
        ]);

        $consulting = Consultings::find($id);

        if (!$consulting) {
            return response()->json(['message' => 'Consulting not found'], 404);
        }

        $consulting->type = $request->input('type');
        $consulting->answer_text = $request->input('answer_text');
        $consulting->save();

        return response()->json($consulting);
    }

    public function destroy($id)
    {
        $consulting = Consultings::find($id);

        if (!$consulting) {
            return response()->json(['message' => 'Consulting not found'], 404);
        }

        $consulting->delete();

        return response()->json(['message' => 'Consulting deleted']);
    }
}
