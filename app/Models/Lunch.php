<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lunch extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'emp_id',
        'lunch_start',
        'start_hour',
        'lunch_end',
        'end_hour',
    ];
    public function emplunch()
    {
        return $this->belongsTo(Employee::class,'emp_id','id');
    }
}
