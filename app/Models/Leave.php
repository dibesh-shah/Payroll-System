<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'days', 'type'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_leave')->withTimestamps();
    }

}
