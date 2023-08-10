<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('/user/register');
        // return route('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'bank_account_number' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'tax_payer_id' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id', // Validate department_id
            'document' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);
        $validatedData['status'] = 'pending';

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents');
            $validatedData['document'] = $documentPath;
        }

        // Create the employee record
       $employee = Employee::create($validatedData);
        $employee->department()->associate($request->input('department_id'));
        $employee->save();

        return redirect()->route('employees.create')->with('success', 'Employee registered successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
