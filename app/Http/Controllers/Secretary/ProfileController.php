<?php

namespace App\Http\Controllers\Secretary;

use Illuminate\Database\Schema\Blueprint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Secretary;
use App\UnionInformation;
use App\Usefulllink;
use App\Content;
use App\Menu;
use Auth;
use Carbon;
use Schema;
use Session;
use DB;
use Image;
use Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
		 $this->middleware('auth:secretary');
    }

    public function index(Request $request)
    {		
		$userid = Auth::guard('secretary')->user()->id;		
		$custominfo = Secretary::where('id',$userid)->first();		
		$menus = Menu::all();
		$contactus = Content::where('menu_id',1)->first();	
		$links = Usefulllink::orderBy('id','DESC')->get();
		
		$query = UnionInformation::where('secretary_id',$userid);
		if($request->has('linksid')){
			$linksid = $request->linksid;
			$query->where('usefulllink_id',$linksid);
		}
		$unioninformation = $query->paginate(50);	
		//$unioninformation = UnionInformation::where('secretary_id',$userid)->paginate(50);	
		
        return view('frontend.secretary.profile',compact('contactus','custominfo','menus','userid','unioninformation','links'));
    }
	
	public function getAjaxUserData(Request $request)
    {		
		$userid = Auth::guard('secretary')->user()->id;		
		$links = Usefulllink::orderBy('id','DESC')->get();
		$wordno = $request->wordno;
		$holdingno = $request->holdingno;
		$usefulllink_id = $request->usefulllink_id;
		
		$query = UnionInformation::where('secretary_id',$userid);
		
		if($holdingno!="" && $wordno!="" && $usefulllink_id!=""){
			$query->where('holding_no',$holdingno)->where('wordno',$wordno)->where('usefulllink_id',$usefulllink_id);
		}
		elseif($holdingno!="" && $wordno!="" && $usefulllink_id==""){
			$query->where('holding_no',$holdingno)->where('wordno',$wordno);
		}
		
		elseif($holdingno!="" && $wordno=="" && $usefulllink_id!=""){
			$query->where('holding_no',$holdingno)->where('usefulllink_id',$usefulllink_id);
		}
		elseif($holdingno=="" && $wordno!="" && $usefulllink_id!=""){
			$query->where('usefulllink_id',$usefulllink_id)->where('wordno',$wordno);
		}
		
		elseif($holdingno!="" && $wordno=="" && $usefulllink_id==""){
			$query->where('holding_no',$holdingno);
		}
		elseif($holdingno=="" && $wordno!="" && $usefulllink_id==""){
			$query->where('wordno',$wordno);
		}
		elseif($holdingno=="" && $wordno=="" && $usefulllink_id!=""){
			$query->where('usefulllink_id',$usefulllink_id);
		}
		$unioninformation = $query->get();	
		
		//$arraydata = array('totalvalue'=>$query->count(),'unioninformation'=>$unioninformation);		
        
		return view('frontend.secretary.ajaxdata',compact('unioninformation','links'));
    }

    public function updateProfile(Request $request){
		
		$userid = Auth::guard('secretary')->user()->id;
		
		$this->validate($request, [
			'fullname'=>'required|max:255',
			//'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);		

		if ($request->hasFile('logo')) {
            if($request->file('logo')->isValid()) {
                try {
                    $file = $request->file('logo');
                    $savedLogoName = 'secretary_'.time() . '.' . $file->getClientOriginalExtension();        
					
					$pathLarge = 'uploads/secretary/'.$savedLogoName;
				    $this->imageResize($file,$pathLarge,$savedLogoName, 450, 450);		
				   
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {        
              }
            }
        }
        else{
            $savedLogoName = $request->stillimages;
         }
		 
		 		
		$menu = Secretary::find($userid);        
		$secretaryUser['photo'] =  $savedLogoName;
		$secretaryUser['fullname'] = $request->fullname;
		$secretaryUser['contact'] = $request->contact;
		$secretaryUser['email'] = $request->email;
		$secretaryUser['designation'] = $request->designation;
		$secretaryUser['address'] = $request->address;
		$secretaryUser['status'] = 1;
		
		Secretary::where('id',$userid)->update($secretaryUser);
		
		Session::flash('message', 'Successfully Updated');
        return redirect('secretary/profile');
    }
	
	
	
    public function updatepassword(Request $request)
    {
		$userid = Auth::guard('secretary')->user()->id;
		$custominfo = Secretary::where('id',$userid)->first();	
		
        $this->validate($request, [
            'old' => 'required',
			//'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);

        $user = Secretary::find($userid);
        $hashedPassword = $user->password;

        if (Hash::check($request->old, $hashedPassword)) {
            $user->fill(['password' => Hash::make($request->password),'passwordHints' => $request->password])->save();
            $request->session()->flash('message', 'Your password has been changed.');
        }
		else{
        	$request->session()->flash('message', 'Your password has not been changed.');
		}

        return back();

    }
	
	
	public function storeNewUser(Request $request)
    {
	  $userid = Auth::guard('secretary')->user()->id;

       $this->validate($request, [
			'name'=>'required|max:255',	
			'spouse_name'=>'required|max:255',
			'usefulllink_id'=>'required',
        ]);
		
		$secretary['secretary_id'] = $userid;
		$secretary['usefulllink_id'] = $request->usefulllink_id;
		$secretary['name'] = $request->name;
		$secretary['spouse_name'] = $request->spouse_name;
		$secretary['village'] = $request->village;
		$secretary['profession'] = $request->profession;
		$secretary['nid'] = $request->nid;
		$secretary['holding_no'] = $request->holding_no;
		$secretary['wordno'] = $request->wordno;
		$secretary['land'] = $request->land;
		$secretary['house_type'] = $request->house_type;
		$secretary['yearly_tax'] = $request->yearly_tax;
		$secretary['budget_year'] = $request->budget_year;
		$secretary['remark'] = $request->remark;
		
		UnionInformation::insert($secretary);		
        return back()->with('message', 'Succeed');
    }


	public function userUpdate(Request $request)
    {		
       $this->validate($request, [
			'name'=>'required|max:255',	
			'spouse_name'=>'required|max:255',
			'usefulllink_id'=>'required',
        ]);	
		 
		 $userid = Auth::guard('secretary')->user()->id;
		 $currentuserid = $request->currentuid;
         $menu = UnionInformation::find($currentuserid);
        
		$secretary['secretary_id'] = $userid;
		$secretary['usefulllink_id'] = $request->usefulllink_id;
		$secretary['name'] = $request->name;
		$secretary['spouse_name'] = $request->spouse_name;
		$secretary['village'] = $request->village;
		$secretary['profession'] = $request->profession;
		$secretary['nid'] = $request->nid;
		$secretary['holding_no'] = $request->holding_no;
		$secretary['wordno'] = $request->wordno;
		$secretary['land'] = $request->land;
		$secretary['house_type'] = $request->house_type;
		$secretary['yearly_tax'] = $request->yearly_tax;
		$secretary['budget_year'] = $request->budget_year;
		$secretary['remark'] = $request->remark;
		
        $menu->update($secretary);
        return back()->with('message', 'Succeed');
    }
	
	
	public function printdata($id)
    {		
		$userid = Auth::guard('secretary')->user()->id;		
		$custominfo = Secretary::where('id',$userid)->first();		
		$menus = Menu::all();
		$contactus = Content::where('menu_id',1)->first();	
        $userinfo = UnionInformation::find($id);
		
        return view('frontend.secretary.print',compact('contactus','custominfo','menus','userid','userinfo'));
    }
	
	
	public function imageResize($file, $path, $filename, $width, $height)
	{	
		//$img = Image::make($file)->resize($width, $height)->save($path, $filename, 100);
		
		$img = Image::make($file);
		$img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
		$img->save($path);
	}	
}
