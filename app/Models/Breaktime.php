<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breaktime extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'emp_id',
        'break_start',
        'start_hour',
        'break_end',
        'end_hour',
    ];
}
