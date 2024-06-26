<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_code',
        'department_code',
        'address',
        'firstname',
        'middlename',
        'lastname',
        'birthday',
        'contact_num',
        'position',
        'civil_status',
        'position_code',
        'position_rank'
    ];

    protected $table = 'employee';

}
