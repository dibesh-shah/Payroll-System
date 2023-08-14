<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        //
        $departments = Department::all();
        // dd('departments');
        return view('admin/department',  compact('departments'));
    }


    public function create()
    {
        $departments = Department::all(); // Fetch all departments
        return view('employee/register', ['departments' => $departments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|unique:departments|max:255',
            'description' => 'nullable',
        ]);

        // Create the department record
        Department::create($validatedData);

        return back()->with('success', 'Department created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Department $department)
    {
        //
        $id = $request->input('id');
        $dataToUpdate = $request->only(['name', 'description']); // Get the fields to update from the request

        // Find the user by ID and update the data
        $user = Department::findOrFail($id);
        $user->update($dataToUpdate);

        return response()->json(['message' => 'Data updated successfully']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
