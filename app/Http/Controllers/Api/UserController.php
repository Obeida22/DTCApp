<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Retrieve a list of all users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Create a new user
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'nickname' => 'required|unique:users',
            'birth_date' => 'required|date',
            'nationality' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'agency_card_number' => 'required',
            'roll_id' => 'required|exists:rolls,id'
        ]);

        $user = User::create($validatedData);

        return response()->json($user, 201);
    }

    // Retrieve a specific user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Update a user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'nickname' => 'required|unique:users,nickname,' . $user->id,
            'birth_date' => 'required|date',
            'nationality' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'agency_card_number' => 'required',
            'roll_id' => 'required|exists:rolls,id'
        ]);

        $user->update($validatedData);

        return response()->json($user, 200);
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
