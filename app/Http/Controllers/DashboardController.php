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
            $current_time = now()->format('H:i:s');
            $status = now()->format('H:i:s') >= '09:00:00' ? 'Half day' : 
                     (now()->format('H:i:s') <= '07:00:59' ? 'On time' : 'Late');
                   
    
            switch ($request->type) {
                // ===== time in condition =====
                case 'time_in':
                    $time_in_count = Dtr::where('user_id', $user_id)
                        ->where('date', $date)
                        ->whereNotNull('time_in')
                        ->count();
    
                    if ($time_in_count > 0) {
                        DB::rollback();
                        return redirect()->route('dashboard.index')->with('timeinChecker', ' ');
                    }
                    if ($time_in_count == 0) {
                        Dtr::updateOrCreate([
                            'time_in' => now()->format('H:i:s'),                           
                            'status' => $status,
                            'date' => now()->format('Y-m-d'), 
                            'user_id' => auth()->user()->id,
                        ]);
                     }
                    break;

                case 'time_out':
                case 'lunch_out':
                case 'lunch_in':
                    $time_in_exists = Dtr::where('user_id', $user_id)
                        ->where('date', $date)
                        ->whereNotNull('time_in')
                        ->first();
    
                    if (!$time_in_exists) {
                        DB::rollback();
                        return redirect()->back()->with('notimeinChecker', ' ');
                    }

                    // ====== lunch out condition ======
                    if($request->type == 'lunch_out') {
                        $lunch_out_exists = Dtr::where('user_id', $user_id)
                            ->where('date', $date)
                            ->whereNotNull('lunch_out')
                            ->count();

                        if($lunch_out_exists > 0) {
                            DB::rollback();
                            return redirect()->back()->with('lunchoutChecker', ' ');
                        }

                        if($current_time >= '12:00' && $current_time < '13:00') { 
                            if($lunch_out_exists == 0) {
                                Dtr::where('user_id', $user_id)
                                    ->where('date', $date)
                                    ->whereNull('lunch_out')
                                    ->update([
                                    'lunch_out' => now()->format('H:i:s'),
                                    'user_id' => auth()->user()->id,
                                ]);
                            }                
                        } else {
                            return redirect()->back()->with('noontimeChecker', ' ');
                        }  
                    }

                    // ===== lunch in condition =====
                    if($request->type == 'lunch_in') {
                        $lunch_in_exists = Dtr::where('user_id', $user_id)
                            ->where('date', $date)
                            ->whereNotNull('lunch_in')
                            ->count();
                        
                        if($lunch_in_exists > 0) {
                            DB::rollback();
                            return redirect()->back()->with('lunchinChecker', ' ');
                        }

                        $lunch_out_exists = Dtr::where('user_id', $user_id)
                            ->where('date', $date)
                            ->whereNotNull('lunch_out')
                            ->count();

                        if($lunch_out_exists == 0) {
                            DB::rollback();
                            return redirect()->back()->with('nolunchoutChecker', ' ');
                        }

                        if($lunch_in_exists == 0) {
                            Dtr::where('user_id', $user_id)
                                ->where('date', $date)
                                ->whereNull('lunch_in')
                                ->update([
                                'lunch_in' => now()->format('H:i:s'),
                                'user_id' => auth()->user()->id,
                            ]);
                        }       
                    }

                    // ===== time out condition =====
                    if($request->type == 'time_out') {
                        $time_out_exists = Dtr::where('user_id', $user_id)
                            ->where('date', $date)
                            ->whereNotNull('time_out')
                            ->count();
                        
                        $status_checker = Dtr::where('user_id', $user_id)
                            ->where('date', $date)
                            ->pluck('status')
                            ->first();

                        $lunch_out_exists = Dtr::where('user_id', $user_id)
                            ->where('date', $date)
                            ->whereNotNull('lunch_out')
                            ->count();

                        if($time_out_exists > 0) {
                            DB::rollback();
                            return redirect()->back()->with('timeoutChecker', ' ');
                        }

                        if($lunch_out_exists == 0 && $status_checker == 'Late'){
                            return redirect()->back()->with('undertimeChecker', ' ');
                        }
               
                        if($current_time < '17:00' && $status_checker == 'Late') {
                                if($time_out_exists == 0) {
                                    Dtr::where('user_id', $user_id)
                                        ->where('date', $date)
                                        ->whereNull('time_out')
                                        ->update([
                                        'time_out' => now()->format('H:i:s'),
                                        'user_id' => auth()->user()->id,
                                        'status' => 'Late - Undertime',
                                        ]);  
                                } 
                        }  
                         
                        elseif($current_time < '17:00' && $status_checker == 'On time') {
                                if($time_out_exists == 0) {
                                    Dtr::where('user_id', $user_id)
                                        ->where('date', $date)
                                        ->whereNull('time_out')
                                        ->update([
                                        'time_out' => now()->format('H:i:s'),
                                        'user_id' => auth()->user()->id,
                                        'status' => 'Undertime',
                                        ]);  
                                }
                        }

                        elseif($current_time < '17:00' && $status_checker == 'Half day') {
                            if($time_out_exists == 0) {
                                Dtr::where('user_id', $user_id)
                                    ->where('date', $date)
                                    ->whereNull('time_out')
                                    ->update([
                                    'time_out' => now()->format('H:i:s'),
                                    'user_id' => auth()->user()->id,
                                    'status' => 'Half day',
                                    ]);  
                            }
                        }
                        else{                             
                            Dtr::where('user_id', $user_id)
                                ->where('date', $date)
                                ->whereNull('time_out')
                                ->update([
                                'time_out' => now()->format('H:i:s'),
                                'user_id' => auth()->user()->id,
                                ]);
                            }
                        break;
                    }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Time recorded successfully');
    
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
}

    public function undertimeRecord(DashboardRequest $request) {
        DB::beginTransaction();

        try {

        $user_id = auth()->user()->id;
        $date = now()->format('Y-m-d');
        $current_time = now()->format('H:i:s');
        $status = now()->format('H:i:s') >= '09:00:00' ? 'Half day' : 
                 (now()->format('H:i:s') <= '07:00:59' ? 'On time' : 'Late');

                 $status_checker = Dtr::where('user_id', $user_id)
                 ->where('date', $date)
                 ->pluck('status')
                 ->first();

        if($current_time < '17:00' && $status_checker == 'Half day') {
            $user_id = auth()->user()->id;
            $date = now()->format('Y-m-d');
        
            Dtr::where('user_id', $user_id)
                ->where('date', $date)
                ->whereNull('time_out')
                ->update([
                    'time_out' => now()->format('H:i:s'),
                    'user_id' => auth()->user()->id,
                    'status' => 'Half day',
                ]);

                DB::commit();
                return redirect()->back()->with('success', 'Time recorded successfully');
        }
      
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