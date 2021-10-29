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
		$menus = Menu::where('parent_id',NULL)->get();	
		$banners = Banner::where('status',1)->get();
		$contactus = Content::where('menu_id',1)->first();		
		$charmanmessage = Management::where('sequence',1)->orderBy('id','DESC')->first();	
		$ministrymessage = Management::where('sequence',2)->orderBy('id','DESC')->first();	
		
		$members = Employee::where('status',1)->orderBy('id', 'DESC')->take(10)->get();
		$noticetype = NoticeType::with('items')->orderBy('id', 'DESC')->get();	
		
		$generalnotices = Notice::where('status',1)->orderBy('id', 'DESC')->take(20)->get();	
		
		$galleries = Gallery::where('status',1)->orderBy('sequence', 'ASC')->get();
		$videogalleries = VideoGallery::where('status',1)->orderBy('id', 'DESC')->get();
		$usefulllinks = Usefulllink::orderBy('id', 'DESC')->get();
		 
		return view('frontend.home',compact('menus','banners','charmanmessage','ministrymessage','members','contactus','generalnotices','noticetype','galleries','videogalleries','usefulllinks'));
    }
	
	public function contents()
    {      
		$slug = request()->segment(2);
		$sslug = request()->segment(3);
		$ssslug = request()->segment(4);
		$contactus = Content::where('menu_id',1)->first();	
		$menus = Menu::where('parent_id',NULL)->get();
		
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
		return view('frontend.article',compact('articles','menus','menuslug','allsubmenus','contactus'));
    }
	
	public function service_details($id)
    {      
		$menus = Menu::where('parent_id',NULL)->get();		
		$services = Notice::where('id',$id)->first();	
		$contactus = Content::where('menu_id',1)->first();				
		return view('frontend.service',compact('menus','services','contactus'));
    }
			
	public function management(Request $req)
    {      
		$menus = Menu::where('parent_id',NULL)->get();
		$managements = Management::all();					
		$contactus = Content::where('menu_id',1)->first();	
		return view('frontend.management',compact('managements','menus','contactus'));
    }
	
	public function employee(Request $req)
    {      
		$menus = Menu::where('parent_id',NULL)->get();		
		$allemployee = Employee::orderBy('id','desc')->get();
		$contactus = Content::where('menu_id',1)->first();	
		return view('frontend.employee',compact('menus','allemployee','contactus'));
    }
	
	
	public function getDownload($name,$files)
	{
		$file= "uploads/report/".$files;
	
		$headers = array('Content-Type: application/pdf');
	
		return Response::download($file, $files, $headers);
	}
	
	
	public function photos(Request $req)
    {      
		$menus = Menu::where('parent_id',NULL)->get();	
		$contactus = Content::where('menu_id',1)->first();		
		$photos = Gallery::all();				
		return view('frontend.photos',compact('menus','photos','contactus'));
    }
	
	
	
	public function videos(Request $req)
    {      
		$menus = Menu::where('parent_id',NULL)->get();	
		$contactus = Content::where('menu_id',1)->first();		
		$videos = VideoGallery::all();				
		return view('frontend.videos',compact('menus','videos','contactus'));
    }
	

}
