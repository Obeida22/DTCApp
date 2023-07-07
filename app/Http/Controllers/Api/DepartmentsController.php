<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments = Departments::all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Department_Name' => 'required|unique:departments|max:255',
        ]);

        try {
            Departments::create([
                'Department_Name' => $request->Department_Name,
            ]);

            return redirect()->route('departments.index')
                ->with('success', 'Department created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Unable to create department: ' . $e->getMessage());
        }
    }

    public function edit(Departments $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Departments $department)
    {
        $request->validate([
            'Department_Name' => 'required|unique:departments|max:255',
        ]);

        try {
            $department->update([
                'Department_Name' => $request->Department_Name,
            ]);

            return redirect()->route('departments.index')
                ->with('success', 'Department updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Unable to update department: ' . $e->getMessage());
        }
    }

    public function destroy(Departments $department)
    {
        try {
            $department->delete();

            return redirect()->route('departments.index')
                ->with('success', 'Department deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Unable to delete department: ' . $e->getMessage());
        }
    }
}
