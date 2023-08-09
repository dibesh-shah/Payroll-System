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
        'address',
        'bank_account_number',
        'bank_name',
        'gender',
        'tax_payer_id',
        'password',



        'status'
    ];

    protected $dates = [
        'date_of_birth',
    ];

    // public function department()
    // {
    //     return $this->belongsTo(Department::class,'department_id');
    // }
}

