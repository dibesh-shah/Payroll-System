<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'status',
        'message',
        'admin_response'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function leave()
    {
        // return $this->belongsTo(Leave::class, 'leave_id');
        return $this->belongsTo(Leave::class, 'leave_type', 'id');
    }

}
