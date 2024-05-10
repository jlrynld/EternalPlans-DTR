<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtr extends Model
{
    use HasFactory;


    protected $fillable = [
        'employee_code',
        'time_in',
        'lunch_out',
        'lunch_in',
        'time_out',
        'date',
        'status',
        'total_hours',
    ];

    protected $table = 'dtr';
}
