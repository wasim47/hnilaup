<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usefulllink;
use DB;
use Image;
use Hash;

class UsefulllinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administration');
    }
    public function index()
    {
        $usefulllink = Usefulllink::orderBy('id','DESC')->paginate(50);
        return view('admin.usefulllink.index', compact('usefulllink'));
    }



    public function create()
    {
        return view('admin.usefulllink.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
			'name'=>'required|max:255',
			'type'=>'required|max:255',
        ]);
		
		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'links_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/links/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 450, 450);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }
		 
		$usefulllink['type'] = $request->type;
		$usefulllink['image'] = $savedFileName;		
		$usefulllink['name'] = $request->name;
		$usefulllink['links'] = $request->links;
        $insertdata = Usefulllink::create($usefulllink);		
        return redirect('administration/usefulllink');
    }

   
   
    public function show($id)
    {
        $usefulllinkinfo = Usefulllink::find($id);
		return view('admin.usefulllink.details',compact('usefulllinkinfo'));
    }

   
    public function edit($id)
    {
        $usefulllinkinfo = Usefulllink::find($id);
		return view('admin.usefulllink.edit',compact('usefulllinkinfo'));
    }

   
    public function update(Request $request, $id)
    {
		 $this->validate($request, [
			'name'=>'required|max:255',
        ]);

		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'links_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/links/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 450, 450);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }
		 
		$menu = Usefulllink::find($id);
		$usefulllink['name'] = $request->name;
		$usefulllink['links'] = $request->links;
		$usefulllink['type'] = $request->type;
		$usefulllink['image'] = $savedFileName;	
		
        $menu->update($usefulllink);
        return redirect('administration/usefulllink');
    }

    public function destroy($id)
    {
        $menuItem = Usefulllink::find($id);
        $menuItem->delete();
        return redirect('administration/usefulllink');
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
