<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['date','clock_in','clock_out', 'employee_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
