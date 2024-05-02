<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtimeform extends Model
{
    use HasFactory;

    protected $fillable = ['dateforot', 'from_time', 'to_time', 'nature_of_work'];
}
