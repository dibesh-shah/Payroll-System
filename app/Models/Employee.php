<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'permanent_address',
        'mailing_address',
        'bank_account_number',
        'bank_name',
        'gender',
        'tax_payer_id',
        'tax_filing_status',
        'department_id', // Assuming you have a department_id column in the employees table
        'document',
        'status', // You can set the default value for this field in the controller
        'password',
        'salary',
        'date_of_joining',
        'hiring_date',
    ];
    protected $dates = [
        'date_of_birth',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function allowances()
    {
        return $this->belongsToMany(Allowance::class, 'employee_allowance')
            ->withPivot(['value', 'type'])
            ->withTimestamps();
    }

    public function deductions()
    {
        return $this->belongsToMany(Deduction::class,'employee_deduction')
        ->withPivot(['value', 'type'])
        ->withTimestamps();
    }

    public function salaryStructure()
    {
        return $this->belongsTo(SalaryStructure::class);
    }
}
