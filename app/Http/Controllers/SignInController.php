<?php

namespace App\Http\Controllers;

use App\Http\Requests\SigninRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SignIncontroller extends Controller {

    public function index() {
        return view('contents.auth.sign-in');
    }

    public function signIn(SignInRequest $request) {
        try{
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, ] , $request->remember)) {
            if(Auth::user()->type == 'Manager')
                return redirect()->route('DTRlist.index');

                return redirect()->route('dashboard.index');
            }
            return back()->with('error', 'Invalid Credentials');
              } catch (\Throwable $th) {
                     return back()->with('error', $th->getMessage());
                  }
             }
      }
