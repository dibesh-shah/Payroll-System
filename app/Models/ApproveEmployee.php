<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApproveEmployee extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'is_approved', 'comments'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
