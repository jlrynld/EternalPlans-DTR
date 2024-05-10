<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\OvertimeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Overtimeform;

class OvertimeController extends Controller
{
    public function index()
    {
        $user = User::select('id', 'firstname', 'email')->where('id', Auth::user()->id)->get();
        return view('contents.request.overtime')->with('user', $user);

    }

    public function store(OvertimeRequest $request){
        DB::beginTransaction();
        try {
            Overtimeform::create([
                'employee_code'=> Auth::user()->id,
                'date' => $request->date,
                'from_time' => $request->from_time,
                'to_time' => $request->to_time,
                'nature_of_work' => $request->nature_of_work,
                'status' => 'Pending',
            ]);

            DB::commit();
            return redirect()->route('dashboard.index')->with('success', 'Overtime request submitted.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

}

