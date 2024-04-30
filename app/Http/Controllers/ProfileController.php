<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller {

    public function index()
    {
        $user = User::select('id', 'firstname', 'email')->where('id', Auth::user()->id)->get();
        return view('contents.profile.index')->with('user', $user);
    }

    public function signUp(ProfileRequest $request){
          try {
                Profile::updateOrCreate([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'address' => $request->address,
                    'birthday' => $request->birthday,
                    'position' => $request->position,
                    'civil_status' => $request->civil_status,
                ]);

                return redirect()->route('profile.index')->with('success','Your profile has been updated!');
            } catch (\Throwable $th) {
                return back()->with('error', $th->getMessage());
            }
}



}


?>
