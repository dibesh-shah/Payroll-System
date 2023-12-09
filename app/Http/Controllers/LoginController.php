<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use Carbon\Carbon;

class LoginController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth.employee')->except('showLoginForm', 'welcome', 'createWithDepartment', 'store', 'login', 'login.submit', 'admin.login','employees.approve','employees.reject');
    // }
    // Method to validate employee data
    protected function validateEmployee(Request $request)
    {
        return $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'permanent_address' => 'required|string',
            'bank_account_number' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'tax_payer_id' => 'required|string|max:255',
            'document' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'mailing_address' => 'required|string',
            'tax_filing_status' => 'required|in:single,married',
        ]);
    }

    // Show the form for creating a new resource with department selection
    public function createWithDepartment()
    {
        // if (session()->has('employee_id')) {
        //     return redirect()->route('employees.dashboard');
        // }
        $departments = Department::all(); // Fetch all departments

        return view('employee.register', ['departments' => $departments]);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validatedData = $this->validateEmployee($request);

        $validatedData['status'] = 'pending';
        $validatedData['date_of_joining'] = now();
        $validatedData['hiring_date'] = now();

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents');
            $validatedData['document'] = $documentPath;
        }

        // Create the employee record
        $employee = Employee::create($validatedData);
        $employee->department()->associate($request->input('department_id'));
        $employee->save();

        return redirect()->route('employees.register')->with('success', 'Employee registered successfully! Wait for admins approval. Your credentials will be emailed after inspection');
    }

    // Show login form

    public function showLoginForm()
    {
        // if (session()->has('employee_id')) {
        //     $employee = Employee::find(session('employee_id'));

        //     // Check if the employee has the 'admin' role
        //     if ($employee && $employee->role === 'employee') {
        //         return redirect()->route('employees.dashboard');
        //     }
        // }

        return view('employee.login');
    }
    public function showAdminLoginForm()
    {
        // if (session()->has('employee_id')) {
        //     $employee = Employee::find(session('employee_id'));
        //     if ($employee && $employee->role === 'admin') {
        //         return redirect()->route('admin.dashboard');
        //     }
        // }
        return view('/admin/login');
    }

    public function login(Request $request)
    {
        // Check if the user is already logged in
        // if (session()->has('employee_id')) {
        //     $employee = Employee::find(session('employee_id'));

        //     // Check if the employee has the 'admin' role
        //     if ($employee && $employee->role === 'employee') {
        //         // If not an admin, redirect to the employee dashboard
        //         return redirect()->route('employees.dashboard');
        //     }
        // }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $employee = Employee::where('email', $credentials['email'])->first();

        if ($employee && Hash::check($credentials['password'], $employee->password)) {
            if ($employee->role === 'employee') {
                // If the employee has an employee role, redirect to the employee dashboard
                session(['employee_id' => $employee->id]);
                return redirect()->route('employees.dashboard')->with('success', 'Logged in Successfully!');
            } else {
                // Handle other roles or unexpected situations
                return back()->withErrors(['message' => 'Invalid credentials']);
            }
        } else {
            return back()->withErrors(['message' => 'Invalid credentials']);
        }
    }

    public function adminLogin(Request $request)
    {
        if (session()->has('employee_id')) {
            $employee = Employee::find(session('employee_id'));

            // Check if the employee has the 'admin' role
            if ($employee && $employee->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $employee = Employee::where('email', $credentials['email'])->first();

        if ($employee && Hash::check($credentials['password'], $employee->password)) {
            if ($employee->role === 'admin') {
                // If the employee has an admin role, redirect to the admin dashboard
                session(['admin_id' => $employee->id]);
                return redirect()->route('admin.dashboard')->with('success', 'Logged in Successfully!');
            }
        }
    }
    public function adminDashboard()
    {

        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();
        $checkedInToday = Attendance::whereDate('date', Carbon::today())->count();

        return view('admin.dashboard', compact('totalEmployees', 'totalDepartments', 'checkedInToday'));
    }
}
