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
    public function emplogin()
    {
        return $this->belongsTo(Employee::class,'emp_id','id');
    }

    // public function Lunch(){
    //     return $this->belongsTo(Lunch::class,'emp_id','emp_id');
    // }
}
