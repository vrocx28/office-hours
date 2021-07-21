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
        'personal_email', 
        'email', 
        'password',
        'designation', 
        'employee_id',
        'department',
        'joining_date', 
        'status', 
        'profile_pic',
    ];
}
