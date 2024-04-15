<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtr extends Model
{
    use HasFactory;


    protected $fillable = [
        'type',
        'date',
        'time',
        'status',
        'user_id'
    ];

    protected $table = 'dtr';
}
