<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller {

    public function index() {
        return view('contents.profile.record');
}

    public function signUp(ProfileRequest $request){
          try {
                Employee::create([
                    'address' => $request->address,
                    // 'firstname' => $request->firstname,
                    // 'lastname' => $request->lastname,
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
