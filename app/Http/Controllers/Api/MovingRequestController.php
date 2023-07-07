<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Moving_Request;
use App\Models\Classes;
use App\Models\Departments;
use App\Models\Students;
use Illuminate\Http\Request;
class MovingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movingRequests = Moving_Request::all();
        return view('moving_requests.index', compact('movingRequests'));
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
        return view('moving_requests.create', compact('departments', 'classes', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movingRequest = new Moving_Request([
            'Department_ID' => $request->get('Department_ID'),
            'Student_ID' => $request->get('Student_ID'),
            'Class_ID' => $request->get('Class_ID'),
            'request_text' => $request->get('request_text'),
            'total_marks' => $request->get('total_marks'),
            'Department_ID_New' => $request->get('Department_ID_New'),
            'Class_ID_New' => $request->get('Class_ID_New')
        ]);
        $movingRequest->save();
        return redirect('/moving_requests')->with('success', 'Moving Request has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movingRequest = Moving_Request::find($id);
        return view('moving_requests.show', compact('movingRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movingRequest = Moving_Request::find($id);
        $departments = Departments::all();
        $classes = Classes::all();
        $students = Students::all();
        return view('moving_requests.edit', compact('movingRequest', 'departments', 'classes', 'students'));
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
        $movingRequest = Moving_Request::find($id);
        $movingRequest->Department_ID = $request->get('Department_ID');
        $movingRequest->Student_ID = $request->get('Student_ID');
        $movingRequest->Class_ID = $request->get('Class_ID');
        $movingRequest->request_text = $request->get('request_text');
        $movingRequest->total_marks = $request->get('total_marks');
        $movingRequest->Department_ID_New = $request->get('Department_ID_New');
        $movingRequest->Class_ID_New = $request->get('Class_ID_New');
        $movingRequest->save();
        return redirect('/moving_requests')->with('success', 'Moving Request has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movingRequest = Moving_Request::find($id);
        $movingRequest->delete();
        return redirect('/moving_requests')->with('success', 'Moving Request has been deleted');
    }

}
