<?php

namespace App\Http\Controllers\Hospital\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HospitalUser;
use App\Menu;
use Mail;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
	
	
	
	public function showLinkRequestForm()
    {
		$menus = Menu::all();
        return view('frontend.hospital.auth.passwords.email',compact('menus'));
    }
	
	
	public function sendResetLinkEmail(Request $req)
    {		
		//dd($req->all());
		$checkExisting = HospitalUser::where('email', $req->email); 
		if($checkExisting->count() > 0){ 
			$getUserinfos = $checkExisting->first();
				$smails = $getUserinfos->email;
				$snames = $getUserinfos->fullname;
				$curid = $getUserinfos->id;
				$data = array(
						"from"=> 'support@bd-icu.com',
						"name"=> $snames,
						"to"=> $smails,
						"currentids"=> base64_encode($curid),
						"email"=> 'wasim.html@gmail.com'
				);
							
				
				Mail::send('frontend.resetpasswords', $data, function($message) use ($data)
				{
					$message->to($data['to'],'');
					$message->cc($data['email'], $data['name']);
					$message->subject('You got a mail with reset password links');
					$message->from($data['from'],"");
				 });
			 
			 	
			 $msgs = 'Successfully sent mail with reset URL. Please check this '.$req->email.' mail and reset your password';
		}
		else{
			$msgs = 'Invalid Email, Please Check';
		}	
		  
        return redirect()->back()->with('message', $msgs);
		
				/*$data = array(
						"from"=> 'support@eishops.com',
						"name"=> 'Wasim',
						"to"=> $req->email,
						//"currentids"=> base64_encode($curid),
						"email"=> 'wasim.html@gmail.com'
				);
							
				Mail::send('frontend.mail.resetpasswords', $data, function($message) use ($data)
				{
					$message->to($data['to'],'Eishops');
					$message->cc($data['email'], $data['name']);
					$message->subject('Hi '.$data['name'].', You got a mail with reset password links');
					$message->from($data['from'],"Eishops");
				 });*/
    }
}
