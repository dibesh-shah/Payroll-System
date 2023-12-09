<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Salary;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function calculatePayroll()
    {
        // Retrieve all employees
        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Calculate allowances and deductions for the employee
            $totalAllowances = $employee->allowances->sum(function ($allowance) use ($employee) {
                return $allowance->pivot->type === 'amount' ? $allowance->pivot->value : ($employee->salary * $allowance->pivot->value / 100);
            });

            $totalDeductions = $employee->deductions->sum(function ($deduction) use ($employee) {
                return $deduction->pivot->type === 'amount' ? $deduction->pivot->value : ($employee->salary * $deduction->pivot->value / 100);
            });

            // Calculate net pay
            $basicSalary = $employee->salary;
            $netPay = $basicSalary + $totalAllowances - $totalDeductions;

            // Store the calculated salary
            Payroll::create([
                'employee_id' => $employee->id,
                'basicSalary' => $basicSalary,
                'totalAllowances' => $totalAllowances,
                'totalDeductions' => $totalDeductions,
                'netPay' => $netPay,
                'status' => "pending",
            ]);
        }

        return redirect()->route('payroll.index')->with('success', 'Payroll calculated successfully.');
    }

    // ... other methods ...

    public function show(){
        $employees = Employee::all();
        return view('/admin/generate',compact('employees'));
    }

    public function payroll($id){

        $employee = Employee::findOrfail($id);
        $allowances = $employee->allowances;
        $deductions = $employee->deductions;
        return view('/admin/payroll',compact('employee','allowances','deductions'));
    }
    public function approve($employeeId, Request $request)
    {
        $employee = Employee::findOrFail($employeeId);
        $payroll = $employee->latestPayroll();
        if ($payroll->status !== 'approved') {
        $payroll->status = 'approved';
        $payroll->save();
        }
        return redirect('/admin/generate')->with('success', 'Payroll approved successfully.');
    }

    public function reject($id, Request $request){
        $payroll = Payroll::findOrFail($id);
        if ($payroll->status !== 'rejected') {
        $payroll->status = 'rejected';
        $payroll->save();
        }
        return redirect('/admin/generate')->with('success', 'Payroll rejected successfully.');
    }
}
