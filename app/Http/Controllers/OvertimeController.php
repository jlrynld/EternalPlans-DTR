<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\OvertimeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeController extends Controller
{
    public function index()
    {
        $user = User::select('id', 'firstname', 'email')->where('id', Auth::user()->id)->get();
        return view('contents.request.overtime')->with('user', $user);

    }



}

