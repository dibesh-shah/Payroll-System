<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ApproveEmployee;
use App\Models\Employee;
use Illuminate\Http\Request;

class ApproveEmployeeController extends Controller
{
    public function index(){
        $employees = Employee::all();
        return view('/admin/approveEmployees', compact('employees'));
    }
    public function approveEmployee($id)
    {
        $approveEmployee = ApproveEmployee::findOrFail($id);
        $approveEmployee->is_approved = true;
        $approveEmployee->save();

        // Redirect or show success message
        // ...
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
