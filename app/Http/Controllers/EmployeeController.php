<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'bank_account_number' => 'required|string|max:255',
            'tax_identification_number' => 'required|string|max:255',
        ]);

        Employee::create($validatedData);

        return redirect()->route('employees.create')->with('success', 'Employee registered successfully!');
    }
    // Login method
    public function showLoginForm()
    {
        return view('employees.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['message' => 'Invalid credentials']);
        }
    }
    public function showDashboard()
    {
        return view('admin/dashboard');
    }
    public function showApprove(){
        return view('admin/approve');
    }
}
