<?php
namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SignUpController extends Controller {

    public function index() {
        return view('contents.auth.sign-up');
}

    public function signUp(SignUpRequest $request){
          try {
              
                $maxEmployee = User::max('employee_code');

               
                if ($maxEmployee === null) {
                    $newEmployeeCode = 'EPI001';
                } else {
                
                    $numericPart = intval(substr($maxEmployee, 3)) + 1;

        
                    $newEmployeeCode = 'EPI' . str_pad($numericPart, 3, '0', STR_PAD_LEFT);
                }

                User::create([
                    'employee_code' => $newEmployeeCode,
                    'type' => $request->type,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'middlename' => $request->middlename,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);

                return redirect()->route('sign-in.index')->with('success','Account has been registered');
            } catch (\Throwable $th) {
                return back()->with('error', $th->getMessage());
            }
}



}


?>
