<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Short_Courses;
use App\Models\User;
use Illuminate\Http\Request;

class ShortCoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortCourses = Short_Courses::all();
        return view('short-courses.index', compact('shortCourses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('short-courses.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Stu_ID' => 'required|unique:short_courses',
            'User_ID' => 'required',
            'English_Name' => 'required',
            'Certificate_Type' => 'required',
            'Certificate_Date' => 'required|date',
            'Study_Place' => 'required',
            'Graduate' => 'required|boolean',
            'graduation_year' => 'nullable|date',
            'home_address' => 'required',
            'work' => 'required|boolean',
            'Work_Type' => 'nullable',
        ]);

        $shortCourse = new Short_Courses();
        $shortCourse->fill($validatedData);
        $shortCourse->save();

        return redirect()->route('short-courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shortCourse = Short_Courses::findOrFail($id);
        return view('short-courses.show', compact('shortCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shortCourse = Short_Courses::findOrFail($id);
        $users = User::all();
        return view('short-courses.edit', compact('shortCourse', 'users'));
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
        $validatedData = $request->validate([
            'Stu_ID' => 'required|unique:short_courses,Stu_ID,'.$id,
            'User_ID' => 'required',
            'English_Name' => 'required',
            'Certificate_Type' => 'required',
            'Certificate_Date' => 'required|date',
            'Study_Place' => 'required',
            'Graduate' => 'required|boolean',
            'graduation_year' => 'nullable|date',
            'home_address' => 'required',
            'work' => 'required|boolean',
            'Work_Type' => 'nullable',
        ]);

        $shortCourse = Short_Courses::findOrFail($id);
        $shortCourse->fill($validatedData);
        $shortCourse->save();

        return redirect()->route('short-courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shortCourse = Short_Courses::findOrFail($id);
        $shortCourse->delete();

        return redirect()->route('short-courses.index');
    }
}
