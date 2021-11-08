<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Fixbanner;
use Validator;
use Image;


class FixbannerController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allfixbanner = Fixbanner::orderBy('id','desc')->get();
    	return view('admin.fixbanner.index',compact('allfixbanner'));
     }


    public function create()
    {
        return view('admin.fixbanner.create');
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
             'image' => ['required|image']
		]);


		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'fixbanner_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/fixbanner/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 1200, 200);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


        $m = new Fixbanner;
		$m->name = $request->name;
		$m->image = $savedFileName;
		$m->status = $request->status;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/fixbanner');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $fixbanner = Fixbanner::find($id);
        return view('admin.fixbanner.edit',compact('fixbanner'));

    }

    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
       		'image' => ['required|image']
		]);


		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'fixbanner_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/fixbanner/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 1200, 200);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


        $fixbanner = Fixbanner::find($id);
        $menuUpdate = array(
			'name'=>  $request->name,
			'image'=>  $savedFileName,
			'status'=>  $request->status,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $fixbanner->update($menuUpdate);
        return redirect('administration/fixbanner');
    }

    public function destroy($id)
    {
        $menuItem = Fixbanner::find($id);
        $menuItem->delete();
        return redirect('administration/fixbanner');
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
