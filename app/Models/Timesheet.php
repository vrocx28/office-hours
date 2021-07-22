<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;
    protected $fillable = [
        'login_date',
        'emp_id',
        'login_time',
        'login_hour',
        'logout_time',
        'logout_hour',
    ];
}
