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
                'basic_salary' => $basicSalary,
                'total_allowances' => $totalAllowances,
                'total_deductions' => $totalDeductions,
                'net_pay' => $netPay,
            ]);
        }

        return redirect()->route('payroll.index')->with('success', 'Payroll calculated successfully.');
    }

    // ... other methods ...
}
