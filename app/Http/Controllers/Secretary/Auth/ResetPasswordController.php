<?php

namespace App\Http\Controllers\Hospital\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HospitalUser;
use App\Menu;
use Hash;

class ResetPasswordController extends Controller
{   
    public function __construct()
    {
        $this->middleware('guest');
    }
	
	public function showResetForm()
    {
		$menus = Menu::all();
		$getCurIds = base64_decode(request()->segment(4));
		$checkExisting = HospitalUser::where('id', $getCurIds); 
		if($checkExisting->count() > 0){ 
			$getUserinfos = $checkExisting->first();
			$email = $getUserinfos->email;
			return view('frontend.hospital.auth.passwords.reset',compact('email','getCurIds','menus'));
		}
		else{
			return redirect('home');
		}
        
    }
	
	
	
	 public function resetpassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);

        $user = HospitalUser::find($request->currids);

        $arrayVal = array('password' => Hash::make($request->password),'password_hints' => $request->password);
		$user->update($arrayVal);
        return redirect('hospital/login')->with('message', 'Your password has been changed.');

    }
	
	
}
