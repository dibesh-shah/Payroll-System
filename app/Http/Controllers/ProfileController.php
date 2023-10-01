<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
    // <!--here--!>
    public function edit()
    {
        $employeeId = session('employee_id');
        $employee = Employee::find($employeeId);
        if (!$employee) {
            return redirect()->route('login');
        }
        return view('/employee/update', compact('employee'));
    }
    public function update(Request $request)
    {
        $employeeId = session('employee_id');

        $employee = Employee::find($employeeId);
        $employee->id = $employeeId;
        $validatedData = $request->validate([
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'permanent_address' => 'required|string',
            'bank_account_number' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'tax_payer_id' => 'required|string|max:255',
            'mailing_address' => 'required|string',
            'tax_filing_status' => 'required|in:single,married'

        ]);

        $employee->update($request->all());
        $employee->save();

        return redirect()->route('employee.edit')->with('success', 'Employee information updated successfully!');
    }
    public function password(){
        return view('employee.password');
    }
    public function changePassword(Request $request)
    {
        $employeeId = session('employee_id');
        $employee = Employee::find($employeeId);

        $validatedData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|different:old_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Check if the old password matches the current password
        if (!Hash::check($validatedData['old_password'], $employee->password)) {
            return back()->withErrors(['old_password' => 'The old password is incorrect']);
        }

        // Update the password with the new one
        $employee->password = Hash::make($validatedData['new_password']);
        $employee->save();

        return back()->with('success', 'Password changed successfully!');
    }
    public function logout(Request $request)
    {
        $request->session()->forget('employee_id');
        $request->session()->regenerate();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

}
