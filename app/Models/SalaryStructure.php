<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryStructure extends Model
{
    use HasFactory;
    protected $table = 'salaries';

    protected $fillable = [
        'employee_id',
        'basic_salary',
        'net_pay',
        // Add other fields
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
