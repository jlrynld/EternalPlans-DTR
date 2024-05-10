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
        $user = User::select('id', 'firstname', 'email', 'employee_code')->where('id', Auth::user()->id)->get();
       
        return view('contents.profile.index')
                    ->with('user', $user);
        
    }

}


?>
