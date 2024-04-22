<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dtr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DashboardRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller{

public function index()
    {
        $user = User::select('id', 'firstname', 'email')->where('id', Auth::user()->id)->get();
        return view('contents.dashboard.index')->with('user', $user);
    }

    public function getCurrentTime(){
        $dayname = now()->format('l');
        $month = now()->format('M');
        $daynum = now()->format('d');
        $year = now()->format('Y');

        $hour = now()->format('h');
        $minutes = now()->format('i');
        $seconds = now()->format('s');
        $period = now()->format('A');

        return response()->json([
            "dayname" => $dayname,
            "month" => $month,
            "daynum" => $daynum,
            "year" => $year,

            "hour" => $hour,
            "minutes" => $minutes,
            "seconds" => $seconds,
            "period" => $period
        ]);
    }

    public function recordTime(DashboardRequest $request)
    {
        DB::beginTransaction();
        try {
            $user_id = auth()->user()->id;
            $date = now()->format('Y-m-d');
    
            switch ($request->type) {
                case 'time_out':
                case 'lunch_out':
                case 'lunch_in':
                    $time_in_exists = Dtr::where('user_id', $user_id)
                        ->where('date', $date)
                        ->whereNotNull('time_in')
                        ->first();
    
                    if (!$time_in_exists) {
                        DB::rollback();
                        return redirect()->back()->with('timelunchoutChecker', ' ');
                    }
                    break;
    
                case 'time_in':
                    $time_in_count = Dtr::where('user_id', $user_id)
                        ->where('date', $date)
                        ->whereNotNull('time_in')
                        ->count();
    
                    if ($time_in_count > 0) {
                        DB::rollback();
                        return redirect()->back()->with('timeinChecker', ' ');
                    }
                    if ($time_in_count == 0) {
                        Dtr::create([
                            'time_in' => now()->format('H:i:s'),                           
                            'status' => "on_time",
                            'date' => now()->format('Y-m-d'), 
                            'user_id' => auth()->user()->id,
                        ]);
            
                     }
                    break;
            }

            DB::commit();
            return redirect()->back()->with('success', 'Time recorded successfully');
    
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
}
    public function sampleFormat() {
        DB::beginTransaction();

        try {
            //code...
            DB::commit();
            return redirect()->back()->with('success', 'Time recorded successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}