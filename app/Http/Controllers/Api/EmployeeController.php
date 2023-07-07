<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('employees.create', compact('users'));
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
            'Employee_ID' => 'required|unique:employees',
            'Job_type' => 'required',
            'User_ID' => 'required|unique:employees',
        ]);

        $user = new User();
        $user->fill($validatedData);
        $user->save();

        $employee = new Employees();
        $employee->fill($validatedData);
        $employee->user_id = $user->id;
        $employee->save();

        return redirect()->route('employees.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employees::findOrFail($id);
        $users = User::all();
        return view('employees.edit', compact('employee', 'users'));
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
            'Employee_ID' => 'required|unique:employees,Employee_ID,'.$id,
            'Job_type' => 'required',
            'User_ID' => 'required|unique:employees,User_ID,'.$id,
        ]);

        $employee = Employees::findOrFail($id);
        $employee->fill($validatedData);
        $employee->save();

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employees::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index');
    }
}
