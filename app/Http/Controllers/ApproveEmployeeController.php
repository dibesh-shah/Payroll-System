<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ApproveEmployee;
use App\Models\Employee;
use Illuminate\Http\Request;

class ApproveEmployeeController extends Controller
{
    public function index(){
        $employees = Employee::with('approval')->get();
        return view('/admin/approveEmployees',  ['employees' => $employees]);
    }
    public function show($id){
        $employee = Employee::findOrfail($id);

        return view('/admin/showApproveEmployee', compact('employee'));
    }
    public function approveEmployee($id)
    {
        $approveEmployee = ApproveEmployee::findOrFail($id);
        $approveEmployee->is_approved = true;
        $approveEmployee->save();

        // Redirect or show success message
        // ...
        return redirect('/admin/approveEmployees')->with('success', 'Employee Approved');
    }

    public function rejectEmployee($id)
    {
        $approveEmployee = ApproveEmployee::findOrFail($id);
        $approveEmployee->is_approved = false;
        $approveEmployee->save();

        // Redirect or show success message
        // ...
    }
}
