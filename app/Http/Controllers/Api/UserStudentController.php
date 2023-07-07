<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Students;
use App\Models\Rolls;

class UserStudentController extends Controller
{
    public function index()
    {
        $users = User::with('rolls', 'students')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Roll_ID' => 'required',
            'Name' => 'required|max:255',
            'Nickname' => 'nullable|max:255',
            'Birth_date' => 'nullable|date',
            'Nationality' => 'nullable|max:255',
            'gender' => 'nullable|max:255',
            'Phone_Number' => 'nullable|integer',
            'Agency_Card_Number' => 'nullable|max:255',
            'Father_name' => 'nullable|max:255',
            'Mother_name' => 'nullable|max:255',
            'Birth_place' => 'nullable|max:255',
            'Recruitment_Division' => 'nullable|max:255',
            'English_Name' => 'nullable|max:255',
            'Address_Current' => 'nullable|max:255',
            'Address_Permanent' => 'nullable|max:255',
            'Admissions' => 'nullable|boolean',
            'Graduate' => 'nullable|boolean',
            'Total_MarkUser' => 'nullable|integer',
        ]);

        try {
            $user = User::create([
                'Roll_ID' => $request->Roll_ID,
                'Name' => $request->Name,
                'Nickname' => $request->Nickname,
                'Birth_date' => $request->Birth_date,
                'Nationality' => $request->Nationality,
                'gender' => $request->gender,
                'Phone_Number' => $request->Phone_Number,
                'Agency_Card_Number' => $request->Agency_Card_Number,
            ]);

            $student = Students::create([
                'user_ID' => $user->user_ID,
                'Father_name' => $request->Father_name,
                'Mother_name' => $request->Mother_name,
                'Birth_place' => $request->Birth_place,
                'Recruitment_Division' => $request->Recruitment_Division,
                'English_Name' => $request->English_Name,
                'Address_Current' => $request->Address_Current,
                'Address_Permanent' => $request->Address_Permanent,
                'Admissions' => $request->Admissions,
                'Graduate' => $request->Graduate,
                'Total_MarkUser' => $request->Total_MarkUser,
            ]);

            return redirect()->route('users.index')
                ->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Unable to create user: ' . $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }



public function update(Request $request, User $user)
{
    $request->validate([
        'Roll_ID' => 'required',
        'Name' => 'required|max:255',
        'Nickname' => 'nullable|max:255',
        'Birth_date' => 'nullable|date',
        'Nationality' => 'nullable|max:255',
        'gender' => 'nullable|max:255',
        'Phone_Number' => 'nullable|integer',
        'Agency_Card_Number' => 'nullable|max:255',
        'Father_name' => 'nullable|max:255',
        'Mother_name' => 'nullable|max:255',
        'Birth_place' => 'nullable|max:255',
        'Recruitment_Division' => 'nullable|max:255',
        'English_Name' => 'nullable|max:255',
        'Address_Current' => 'nullable|max:255',
        'Address_Permanent' => 'nullable|max:255',
        'Admissions' => 'nullable|boolean',
        'Graduate' => 'nullable|boolean',
        'Total_MarkUser' => 'nullable|integer',
    ]);

    try {
        $user->update([
            'Roll_ID' => $request->Roll_ID,
            'Name' => $request->Name,
            'Nickname' => $request->Nickname,
            'Birth_date' => $request->Birth_date,
            'Nationality' => $request->Nationality,
            'gender' => $request->gender,
            'Phone_Number' => $request->Phone_Number,
            'Agency_Card_Number' => $request->Agency_Card_Number,
        ]);

        $user->student()->update([
            'Father_name' => $request->Father_name,
            'Mother_name' => $request->Mother_name,
            'Birth_place' => $request->Birth_place,
            'Recruitment_Division' => $request->Recruitment_Division,
            'English_Name' => $request->English_Name,
            'Address_Current' => $request->Address_Current,
            'Address_Permanent' => $request->Address_Permanent,
            'Admissions' => $request->Admissions,
            'Graduate' => $request->Graduate,
            'Total_MarkUser' => $request->Total_MarkUser,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Unable to update user: ' . $e->getMessage());
    }

}
public function destroy(User $user)
{
    try {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Unable to delete user: ' . $e->getMessage());
    }
}
}
