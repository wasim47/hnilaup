<?php

namespace App\Http\Controllers\Secretary\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

use App\Category;
use App\Menu;
use Auth;
use App\Secretary;
use App\Content;
use Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/secretary/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:secretary', ['except' => 'logout']);
    }

   public function showLoginForm()
    {
		$menus = Menu::all();
		$contactus = Content::where('menu_id',1)->first();		
        return view('frontend.secretary.auth.login',compact('menus','contactus'));
    }
	
	public function login(Request $request)
    {		
        $this->validate($request, [
            'username'=>'required|string',
            'password'=>'required|min:4'
        ]);
		
		
        if(Auth::guard('secretary')->attempt(['email'=>$request->username, 'password'=>$request->password, 'status'=> 1], $request->remember)) {
            return redirect(route('secretary.profile'));
        }		
		else{
        	return redirect()->back()->withInput($request->only('username','remember'))->with('message','Login Failed');
		}
    }
	
	
	
    public function logout(Request $request)
    {		
        Auth::guard('secretary')->logout();
        return redirect('/secretary/login');
    }
	
}
