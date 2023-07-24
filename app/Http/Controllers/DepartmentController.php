<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('/admin/departments', compact('departments'));
    }

    public function create()
    {
        return view('/admin/departments');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments|max:255',
            'description' => 'nullable',
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return view('edit_department', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|max:255|unique:departments,name,' . $department->id,
            'description' => 'nullable',
        ]);

        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
