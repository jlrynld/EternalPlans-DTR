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
        DB::beginTransaction();
          try {

            switch ($request->civil_status) {
                case 'single':
                    Profile::updateOrCreate([
                        'firstname' => $request->firstname,
                        'lastname' => $request->lastname,
                        'address' => $request->address,
                        'birthday' => $request->birthday,
                        'contact_num' => $request->contact_num,
                        'position' => $request->position,
                        'civil_status' => 'single',
                    ]);
                    break;
                
                case 'married':
                    Profile::updateOrCreate([
                        'firstname' => $request->firstname,
                        'lastname' => $request->lastname,
                        'address' => $request->address,
                        'birthday' => $request->birthday,
                        'contact_num' => $request->contact_num,
                        'position' => $request->position,
                        'civil_status' => 'married',
                    ]);
                    break;

                case 'widowed':
                    Profile::updateOrCreate([
                        'firstname' => $request->firstname,
                        'lastname' => $request->lastname,
                        'address' => $request->address,
                        'birthday' => $request->birthday,
                        'contact_num' => $request->contact_num,
                        'position' => $request->position,
                        'civil_status' => 'widowed',
                    ]);
                    break;

                case 'divorced':
                    Profile::updateOrCreate([
                        'firstname' => $request->firstname,
                        'lastname' => $request->lastname,
                        'address' => $request->address,
                        'birthday' => $request->birthday,
                        'contact_num' => $request->contact_num,
                        'position' => $request->position,
                        'civil_status' => 'divorced',
                    ]);
                    break;
                
            }
               
                DB::commit();
                return redirect()->route('profile.index')->with('success','Your profile has been updated!');
            } catch (\Throwable $th) {
                return back()->with('error', $th->getMessage());
            }
}



}


?>
