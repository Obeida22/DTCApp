<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Departments;
use App\Models\Editing_Marks_Request;
use App\Models\Material;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;

class EditingMarksRequestController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editingMarksRequests = Editing_Marks_Request::all();
        return view('editing_marks_requests.index', compact('editingMarksRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Departments::all();
        $classes = Classes::all();
        $students = Students::all();
        $teachers = Teachers::all();
        $materials = Material::all();
        return view('editing_marks_requests.create', compact('departments', 'classes', 'students', 'teachers', 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $editingMarksRequest = new Editing_Marks_Request([
            'Department_ID' => $request->get('Department_ID'),
            'Student_ID' => $request->get('Student_ID'),
            'Class_ID' => $request->get('Class_ID'),
            'Teacher_ID' => $request->get('Teacher_ID'),
            'Material_ID' => $request->get('Material_ID'),
            'Earned_Mark' => $request->get('Earned_Mark'),
            'Text_Editing_Mark' => $request->get('Text_Editing_Mark')
        ]);
        $editingMarksRequest->save();
        return redirect('/editing_marks_requests')->with('success', 'Editing Marks Request has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $editingMarksRequest = Editing_Marks_Request::find($id);
        return view('editing_marks_requests.show', compact('editingMarksRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editingMarksRequest = Editing_Marks_Request::find($id);
        $departments = Departments::all();
        $classes = Classes::all();
        $students = Students::all();
        $teachers = Teachers::all();
        $materials = Material::all();
        return view('editing_marks_requests.edit', compact('editingMarksRequest', 'departments', 'classes', 'students', 'teachers', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $editingMarksRequest = Editing_Marks_Request::find($id);
        $editingMarksRequest->Department_ID = $request->get('Department_ID');
        $editingMarksRequest->Student_ID = $request->get('Student_ID');
        $editingMarksRequest->Class_ID = $request->get('Class_ID');
        $editingMarksRequest->Teacher_ID = $request->get('Teacher_ID');
        $editingMarksRequest->Material_ID = $request->get('Material_ID');
        $editingMarksRequest->Earned_Mark = $request->get('Earned_Mark');
        $editingMarksRequest->Text_Editing_Mark = $request->get('Text_Editing_Mark');
        $editingMarksRequest->save();
        return redirect('/editing_marks_requests')->with('success', 'Editing Marks Request has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $editingMarksRequest = Editing_Marks_Request::find($id);
        $editingMarksRequest->delete();
        return redirect('/editing_marks_requests')->with('success', 'Editing MarksRequest has been deleted');
    }
}
