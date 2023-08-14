<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];


    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_deduction')
            ->withPivot(['value', 'type'])
            ->withTimestamps();
    }
}
