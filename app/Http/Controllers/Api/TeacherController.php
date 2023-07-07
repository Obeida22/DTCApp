<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department_Teacher;
use App\Models\Departments;
use App\Models\Teachers;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teachers::with('user', 'department', 'departmentTeacher')->get();

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $departments = Departments::all();

        return view('teachers.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Certificate_Name' => 'required',
            'Department_ID' => 'required',
            'User_ID' => 'required',
        ]);

        $teacher = new Teachers([
            'Certificate_Name' => $request->input('Certificate_Name'),
            'Department_ID' => $request->input('Department_ID'),
            'User_ID' => $request->input('User_ID'),
        ]);
        $teacher->save();

        $departmentTeacher = new Department_Teacher([
            'Department_ID' => $request->input('Department_ID'),
            'Teacher_ID' => $teacher->Teacher_ID,
        ]);
        if ($request->input('is_manager') == true) {
            $departmentTeacher->Manager_ID = $teacher->Teacher_ID;
        }
        $departmentTeacher->save();

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function show($id)
    {
        $teacher = Teachers::with('user', 'department', 'departmentTeacher')->findOrFail($id);

        return view('teachers.show', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = Teachers::findOrFail($id);
        $departments = Departments::all();

        return view('teachers.edit', compact('teacher', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Certificate_Name' => 'required',
            'Department_ID' => 'required',
            'User_ID' => 'required',
        ]);

        $teacher = Teachers::findOrFail($id);
        $teacher->update([
            'Certificate_Name' => $request->input('Certificate_Name'),
            'Department_ID' => $request->input('Department_ID'),
            'User_ID' => $request->input('User_ID'),
        ]);

        $departmentTeacher = Department_Teacher::where('Teacher_ID', $id)->firstOrFail();
        if ($request->input('is_manager') == true) {
            $departmentTeacher->Manager_ID = $id;
        } else {
            $departmentTeacher->Manager_ID = null;
        }
        $departmentTeacher->save();

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy($id)
    {
        $teacher = Teachers::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
