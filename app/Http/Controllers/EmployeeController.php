<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ApproveEmployee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeCredentialsMail;
use Illuminate\Support\Str;


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
            'bank_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            // 'department_id' =>'string',
            'documents' => 'string',
            'tax_payer_id' => 'required|string|max:255',
            'status' => 'required|string',
        ]);
        // dd($validatedData);
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

        // if (Auth::attempt($credentials)) {
        //     // Authentication passed...
        //     // return redirect()->route('dashboard');
        //     return back()->with('success', 'Logged in Successfully!');
        // } else {
        //     return back()->withErrors(['message' => 'Invalid credentials']);
        // }
         // Find the user by email
    $employee = Employee::where('email', $credentials['email'])->first();

    // Check if the user exists and the password matches
    if ($employee && Hash::check($credentials['password'], $employee->password)) {
        // Authentication passed...
        // You can manually log in the user here using session or any other method

        // For example, you can store the user ID in the session
        session(['employee_id' => $employee->id]);

        return back()->with('success', 'Logged in Successfully!');
    } else {
        return back()->withErrors(['message' => 'Invalid credentials']);
    }
    }
    public function show($id){
        $employee = Employee::findOrfail($id);

        return view('/admin/showApproveEmployee', compact('employee'));
    }

    public function index(Employee $employee){
        $employees = Employee::where('status', 'pending')->get();
        return view('/admin/approveEmployees',  ['employees' => $employees]);
    }

    public function viewEmployee(Request $request){
        $search = $request->input('search');

        $employees = Employee::where('status', 'approved')
            ->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
                // Add more columns if you want to search on additional fields
            })->paginate(10);

        return view('/admin/view_employee',  ['employees' => $employees, 'search' => $search]);
    }


    public function approveEmployee($id)
{
    // Find the employee record by ID
    $approveEmployee = Employee::findOrFail($id);

    // Check if the employee is not already approved
    if ($approveEmployee->status !== 'approved') {
        // Update the employee status to approved
        $approveEmployee->status = 'approved';
        $approveEmployee->save();

        // Generate a random password if the employee doesn't already have one
        if (empty($approveEmployee->password)) {
            $randomPassword = Str::random(10); // You can adjust the length of the password

            // Update the employee's password in the database
            $approveEmployee->password = Hash::make($randomPassword);
            $approveEmployee->save();

            // Send the email to the employee with the randomly generated password
            Mail::to($approveEmployee->email)->send(new EmployeeCredentialsMail($randomPassword));
        }
    }

    return redirect('/admin/approveEmployees')->with('success', 'Employee approved successfully. Email with login credentials sent.');
}

    public function rejectEmployee($id)
    {
        $approveEmployee = Employee::findOrFail($id);
        $approveEmployee->status = 'rejected';
        $approveEmployee->save();
        return redirect('/admin/approveEmployees');

        // Redirect or show success message
        // ...
    }
    public function showDashboard()
    {
        return view('admin/dashboard');
    }

}
