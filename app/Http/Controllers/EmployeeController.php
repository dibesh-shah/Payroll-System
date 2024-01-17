<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Models\Leave;
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



class EmployeeController extends Controller
{
    // Show pending employees for approval
    public function index(Employee $employee)
    {
        $employees = Employee::whereIn('status', ['pending', 'rejected'])->get();

        return view('/admin/approve', ['employees' => $employees]);
    }
    // Show employee details
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        $allowances = Allowance::all();
        $deductions = Deduction::all();
        $departments = Department::all();
        $leaves = Leave::all();

        return view('/admin/approvedetails', compact('employee', 'allowances', 'deductions', 'departments','leaves'));
    }
    public function showDocument($filename)
    {
        $path = storage_path('app/documents/' . $filename);

        if (file_exists($path)) {
            return response()->file($path);
        } else {
            abort(404, 'File not found');
        }
    }

    // View and search approved employees
    public function viewEmployee(Request $request)
    {
        $search = $request->input('search');
        $id = $request->input('id');
        $employees = [];
        $count = 0;

        if($search){
            if ($id != 0) {

                $employee = Employee::find($id);
                
                
                 return view('/admin/view_employee', ['employee' => $employee, 'search' => $search,'count' => 1]);
                // dd($employee->all());
    
    
            }else{
                $employees = Employee::where('status', 'approved')
                    ->where(function ($query) use ($search) {
                        $query->where('first_name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    })
                    ->paginate(2);
                
                    $count = $employees->count();
                return view('/admin/view_employee', ['employees' => $employees, 'search' => $search,'count' => $count]);
    
            }
        }else{
        return view('/admin/view_employee');
        }

        

    }



    public function approveEmployee($id, Request $request)
    {
        $approveEmployee = Employee::findOrFail($id);

        if ($approveEmployee->status !== 'approved') {
            $dateOfHiring = $request->input('hiring_date');
            $dateOfHiring = new \DateTime($dateOfHiring);
            $today = new \DateTime();


            if ($request->input('date_of_joining') <  $request->input('hiring_date')) {
                return back()->with('errorjoin', 'Date of Joining cannot be before Hiring Date.');
            } else if ($dateOfHiring >= $today) {
                return back()->with('errorhire', 'Date of Hiring must not be a future date.');
            } else {
                $approveEmployee->status = 'approved';
                $approveEmployee->chatKey = Str::random(32);
                $approveEmployee->date_of_joining = $request->input('date_of_joining');
                $approveEmployee->hiring_date = $request->input('hiring_date');

                $designation = $request->input('designation');
                $basicSalary = $request->input('basic_salary');
                $department_id = $request->input('department_id');
                $approveEmployee->salary = $basicSalary;
                $approveEmployee->department_id = $department_id;
                $approveEmployee->designation = $designation;

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

                $selectedLeaves = $request->input('leaves', []);
                $leaves = Leave::find($selectedLeaves);
                $approveEmployee->leaves()->sync($leaves);

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



                if (empty($approveEmployee->password)) {
                    $randomPassword = Str::random(10);

                    $approveEmployee->password = Hash::make($randomPassword);
                    $approveEmployee->save();

                    Mail::to($approveEmployee->email)->send(new EmployeeCredentialsMail($randomPassword, $approveEmployee->email, $approveEmployee->first_name));
                }

                // dd($approveEmployee->password, $randomPassword);

            }

            return redirect('/admin/approve')->with('success', 'Employee approved successfully. Email with login credentials sent.');
        }
        // dd($request->all());
    }

    public function rejectEmployee($id)
    {
        $approveEmployee = Employee::findOrFail($id);
        $approveEmployee->status = 'rejected';
        $approveEmployee->save();
        return redirect('/admin/approve')->with('success', 'Employee rejected successfully');
    }

    // app/Http/Controllers/EmployeeController.php

    // public function suggestions(Request $request)
    // {
    //     $search = $request->input('search');

    //     // Fetch matching employee names from the database
    //     $employees = Employee::where('name', 'LIKE', '%' . $search . '%')
    //         ->limit(5)
    //         ->get(['name']);

    //     return response()->json($employees);
    // }


}
