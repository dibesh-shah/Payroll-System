<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(){
        $employeeId = session('employee_id');
        $employee = Employee::find($employeeId);
        if (!$employee) {
            return redirect()->route('login');
        }
        $allowances = $employee->allowances;
        $deductions = $employee->deductions;

        return view('employee.profile', compact('employee', 'allowances', 'deductions'));
    }
    public function edit()
    {
        $employeeId = session('employee_id');
        $employee = Employee::find($employeeId);
        if (!$employee) {
            return redirect()->route('login');
        }

        $departments = Department::all(); // Assuming you have a Department model

        return view('employees.edit', compact('employee', 'departments'));
    }
    public function update(Request $request, $id)
    {
        $employeeId = session('employee_id');
        $employee = Employee::findOrFail($employeeId);
        // if ($employee->id != auth()->user()->id) {
        //     return redirect()->route('employees.dashboard')
        //     ->with('error', 'You are not authorized to update this profile.');
        // }


        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
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

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents');
            $validatedData['document'] = $documentPath;
        }

        $employee->update($validatedData);
        $employee->department()->associate($request->input('department_id'));
        $employee->save();

        return redirect()->route('employee.edit', $employee->id)->with('success', 'Employee information updated successfully!');
    }

}
