<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'personal_email', 
        'email', 
        'password',
        'designation', 
        'employee_id',
        'department',
        'joining_date', 
        'status', 
        'profile_pic',
        'grad_college_name',
        'grad_degree',
        'grad_passing_year',
        'grad_state',
        'grad_city', 
        'mas_college_name',
        'mas_degree',
        'mas_passing_year',
        'mas_state',
        'mas_city',
    ];
    public function loginemp()
    {
        return $this->hasMany(Timesheet::class, 'emp_id', 'id');
    }
    public function lunchemp()
    {
        return $this->hasMany(Lunch::class, 'emp_id', 'id');
    }
    public function breakemp()
    {
        return $this->hasMany(Breaktime::class, 'emp_id', 'id');
    }
}
