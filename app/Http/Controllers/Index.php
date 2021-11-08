<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Menu;
use App\Content;
use App\Banner;
use App\Gallery;
use App\NoticeType;
use App\Notice;
use App\Management;
use App\UnionInformation;
use App\Employee;
use App\VideoGallery;
use App\Usefulllink;

class Index extends Controller
{
    public function __construct()
    {	
        
    }
	
    public function index()
    {      
		$banners = Banner::where('status',1)->get();
		$charmanmessage = Management::where('sequence',1)->orderBy('id','DESC')->first();	
		$ministrymessage = Management::where('sequence',2)->orderBy('id','DESC')->first();	
		
		$members = Employee::where('status',1)->orderBy('id', 'DESC')->take(10)->get();
		$noticetype = NoticeType::with('items')->orderBy('id', 'DESC')->get();	
		
		$generalnotices = Notice::where('status',1)->orderBy('id', 'DESC')->take(20)->get();	
		
		$galleries = Gallery::where('status',1)->orderBy('sequence', 'ASC')->get();
		$videogalleries = VideoGallery::where('status',1)->orderBy('id', 'DESC')->get();
		$usefulllinks = Usefulllink::orderBy('id', 'DESC')->get();
		 
		return view('frontend.home',compact('banners','charmanmessage','ministrymessage','members','generalnotices',
		'noticetype','galleries','videogalleries','usefulllinks'));
    }
	
	public function contents()
    {      
		$slug = request()->segment(2);
		$sslug = request()->segment(3);
		$ssslug = request()->segment(4);
		
		
		if($slug!='' && $sslug!='' && $ssslug!=""){
			$getParentID = Menu::where('uri', $ssslug)->select('parent_id','sparent_id')->first();
			$menuslug = Menu::where([['parent_id', $slug],['sparent_id', $sslug],['uri', $ssslug]])->first();
		}
		elseif($slug!='' && $sslug!='' && $ssslug==""){
			$getParentID = Menu::where('uri', $sslug)->select('parent_id')->first();
			$menuslug = Menu::where([['parent_id', $slug],['uri', $sslug]])->first();
		}
		elseif($slug!='' && $sslug=='' && $ssslug==""){
			$menuslug = Menu::where('uri', $slug)->first();
		}	
		else{
			return redirect(route('home'));
		}				
		
		
		$articles = Content::where('menu_id',$menuslug->id)->first();			
		$allsubmenus = Menu::where('parent_id', $menuslug->id);			
		return view('frontend.article',compact('articles','menuslug','allsubmenus'));
    }
	
	
	public function messages($id)
    {      
		$messages = Management::where('id',$id)->first();
		return view('frontend.message_details',compact('messages'));
    }
	
	public function holdinginfo(Request $request)
    {      
	
		$query = UnionInformation::query();
		if($request->has('linksid')){
			$linksid = $request->linksid;
			$query->where('usefulllink_id',$linksid);
		}
		$unioninformation = $query->paginate(50);
		
		//$unioninformation = UnionInformation::paginate(50);		
		$links = Usefulllink::orderBy('id','DESC')->get();
		return view('frontend.holdinginfo',compact('unioninformation','links'));
    }
	
	public function notice()
    {      
		$notices = Notice::paginate(50);	
		return view('frontend.notice',compact('notices'));
    }
	public function notice_details($id)
    {      
		$notices = Notice::where('id',$id)->first();	
		$relnotices = Notice::all();
		return view('frontend.notice_details',compact('notices','relnotices'));
    }
			
	public function management(Request $req)
    {      
		$managements = Management::all();					
		return view('frontend.management',compact('managements'));
    }
	
	public function employee(Request $req)
    {      
		$allemployee = Employee::orderBy('id','desc')->get();
		return view('frontend.employee',compact('allemployee'));
    }
	public function employee_details($id)
    {      
		$employee = Employee::where('id',$id)->first();
		return view('frontend.employee_details',compact('employee'));
    }
	
	
	public function getDownload($name,$files)
	{
		$file= "uploads/report/".$files;	
		$headers = array('Content-Type: application/pdf');	
		return Response::download($file, $files, $headers);
	}
	
	
	public function photos(Request $req)
    {      
		$photos = Gallery::all();				
		return view('frontend.photos',compact('photos'));
    }
	
	
	
	public function videos(Request $req)
    {      
		$videos = VideoGallery::all();				
		return view('frontend.videos',compact('videos'));
    }
	
	
	public function getAjaxUserData(Request $request)
    {		
		$holdingno = $request->holdingno;
		$wordno = $request->wordno;
		$usefulllink_id = $request->usefulllink_id;
		
		$query = UnionInformation::query();
		
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
        
		return view('frontend.ajaxdata',compact('unioninformation'));
    }
	

}
