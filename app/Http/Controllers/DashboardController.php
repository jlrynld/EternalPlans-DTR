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

            switch ($request->type) {
                case 'time_out': 
                case 'lunch_out':
                case 'lunch_in':       
                    $time_in = Dtr::where('user_id', auth()->user()->id)
                        ->where('date', now()->format('Y-m-d'))
                        ->where('type', 'time_in')
                        ->count();

                    if($time_in == 0) {
                        DB::rollback();
                        return redirect()->back()->with('timelunchoutChecker', ' ');                 
                    }

                    if ($request->type == 'lunch_in') {
                      
                        $lunch_out = Dtr::where('user_id', auth()->user()->id)
                            ->where('date', now()->format('Y-m-d'))
                            ->where('type', 'lunch_out')
                            ->count();
    
                        if ($lunch_out == 0) {
                            DB::rollback();
                            return redirect()->back()->with('lunchoutChecker', ' ');
                        }
                    }

                    if ($request->type == 'time_out') {
                      
                        $lunch_in = Dtr::where('user_id', auth()->user()->id)
                            ->where('date', now()->format('Y-m-d'))
                            ->where('type', 'lunch_in')
                            ->count();
    
                        if ($lunch_in == 0) {
                            DB::rollback();
                            return redirect()->back()->with('halfdayChecker', 'Half day ka lang mamsh?');
                        }
                    } 

                break;

                case 'time_in':
                    $time_in = Dtr::where('user_id', auth()->user()->id)
                    ->where('date', now()->format('Y-m-d'))
                    ->where('type', 'time_in')
                    ->count();

                    if($time_in == 1) {
                        DB::rollBack();
                        return redirect()->back()->with('timeinChecker', ' ');
                    }
                break;
                
            }
            
            Dtr::create([
                'type' => $request->type,
                'time' => now()->format('H:i:s'),
                'status' => "on_time",
                'date' => now()->format('Y-m-d'), 
                'user_id' => auth()->user()->id,
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Time recorded successfully');
        }

        catch (\Throwable $th) {
            DB::rollBack();
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