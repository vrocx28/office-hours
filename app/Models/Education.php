<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_id',
        'degree_type',
        'degreename',
        'passing_year',
        'college_name',
        'state',
        'city',
    ];
}
