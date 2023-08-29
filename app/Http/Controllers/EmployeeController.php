<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeCredentialsMail;
use App\Models\Allowance;
use App\Models\Attendance;
use App\Models\Deduction;
use App\Models\Payroll;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function createWithDepartment()
    {
        $departments = Department::all(); // Fetch all departments

        return view('employee.register', ['departments' => $departments]);
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
            'permanent_address' => 'required|string',
            'bank_account_number' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'tax_payer_id' => 'required|string|max:255',
            'document' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'mailing_address' => 'required|string',
            'tax_filing_status' => 'required|in:single,married'

        ]);
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

    // Login method
    public function showLoginForm()
    {
        return view('employee.login');
    }

    public function login(Request $request)
    {
            // Check if the user is already logged in
        if (auth()->check()) {
            return redirect()->route('employees.dashboard');
        }
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $employee = Employee::where('email', $credentials['email'])->first();

        if ($employee && Hash::check($credentials['password'], $employee->password)) {
            session(['employee_id' => $employee->id]);
            return redirect()->route('employees.dashboard')->with('success', 'Logged in Successfully!');
        } else {
            return back()->withErrors(['message' => 'Invalid credentials']);
        }
    }

    public function show($id)
    {
        $employee = Employee::findOrfail($id);
        $allowances = Allowance::all();
        $deductions = Deduction::all();
        $departments = Department::all();


        return view('/admin/approvedetails', compact('employee', 'allowances', 'deductions','departments'));
    }

    public function index(Employee $employee)
    {
        $employees = Employee::where('status', 'pending')->get();
        return view('/admin/approve',  ['employees' => $employees]);
    }

    public function viewEmployee(Request $request)
    {
        $search = $request->input('search');

        $employees = Employee::where('status', 'approved')
            ->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })->paginate(10);

        return view('/admin/view_employee',  ['employees' => $employees, 'search' => $search]);
    }



    public function approveEmployee($id, Request $request)
    {
        $approveEmployee = Employee::findOrFail($id);

        if ($approveEmployee->status !== 'approved') {
            $approveEmployee->status = 'approved';
            $approveEmployee->date_of_joining = $request->input('date_of_joining');
            $approveEmployee->hiring_date = $request->input('hiring_date');
            $basicSalary = $request->input('basic_salary');
            $department_id = $request->input('department_id');
            $approveEmployee->salary = $basicSalary;
            $approveEmployee->department_id = $department_id;
            $approveEmployee->save();

            // Fetch selected allowances and store percentages
            $selectedAllowances = $request->input('allowances', []);
            $allowanceValues = $request->input('allowance_values', []);
            $allowanceTypes = $request->input('allowance_types', []);

            $allowances = [];
            foreach ($selectedAllowances as $key => $allowanceId) {
                $allowance = Allowance::findOrFail($allowanceId);

                if ($allowanceTypes[$key] === 'percentage') {
                    $allowances[$allowanceId] = ['value' => $allowanceValues[$key], 'type' => 'percentage'];
                } else {
                    $allowances[$allowanceId] = ['value' => $allowanceValues[$key], 'type' => 'amount'];
                }
            }

            $approveEmployee->allowances()->sync($allowances);

            // Fetch selected deductions and store percentages
            $selectedDeductions = $request->input('deductions', []);
            $deductionValues = $request->input('deduction_values', []);
            $deductionTypes = $request->input('deduction_types', []);

            $deductions = [];
            foreach ($selectedDeductions as $key => $deductionId) {
                $deduction = Deduction::findOrFail($deductionId);

                if ($deductionTypes[$key] === 'percentage') {
                    $deductions[$deductionId] = ['value' => $deductionValues[$key], 'type' => 'percentage'];
                } else {
                    $deductions[$deductionId] = ['value' => $deductionValues[$key], 'type' => 'amount'];
                }
            }

            $approveEmployee->deductions()->sync($deductions);

            // Create or update the payroll record
            Payroll::updateOrCreate(
                ['employee_id' => $approveEmployee->id],
                ['basic_salary' => $basicSalary]
            );

            if (empty($approveEmployee->password)) {
                $randomPassword = Str::random(10);

                $approveEmployee->password = Hash::make($randomPassword);
                $approveEmployee->save();

                Mail::to($approveEmployee->email)->send(new EmployeeCredentialsMail($randomPassword, $approveEmployee->email, $approveEmployee->first_name));
            }
        }

        return redirect('/admin/approve')->with('success', 'Employee approved successfully. Email with login credentials sent.');
    }

    public function rejectEmployee($id)
    {
        $approveEmployee = Employee::findOrFail($id);
        $approveEmployee->status = 'rejected';
        $approveEmployee->save();
        return redirect('/admin/approve')->with('success', 'Employee rejected successfully');
    }

    public function adminDashboard()
    {
        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();
        $checkedInToday = Attendance::whereDate('clock_in', Carbon::today())->count();

        return view('admin.dashboard', compact('totalEmployees', 'totalDepartments', 'checkedInToday'));
    }
}
