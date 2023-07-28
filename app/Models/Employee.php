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
        'tax_identification_number',
    ];

    protected $dates = [
        'date_of_birth',
    ];
    public function approval()
    {
        return $this->hasOne(ApproveEmployee::class);
    }
}

