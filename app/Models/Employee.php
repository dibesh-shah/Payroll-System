<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'bank_account_number',
        'bank_name',
        'gender',
        'tax_payer_id',
        'department_id', // Assuming you have a department_id column in the employees table
        'document',
        'status', // You can set the default value for this field in the controller
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
