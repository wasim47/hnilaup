<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\UnionInformation;
use App\Usefulllink;
use App\Secretary;
use Validator;
use Image;


class HoldinginfoController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allholdinginfo = UnionInformation::orderBy('id','desc')->get();
    	return view('admin.holdinginfo.index',compact('allholdinginfo'));
     }


    public function create()
    {
		$secretaryuser = Secretary::orderBy('id','DESC')->get();
		$links = Usefulllink::orderBy('id','DESC')->get();
        return view('admin.holdinginfo.create',compact('secretaryuser','links'));
    }

    public function store(Request $request)
    {
		$this->validate($request, [
			'name'=>'required|max:255',	
			'spouse_name'=>'required|max:255',
			'usefulllink_id'=>'required',
        ]);
		
		$secretary['secretary_id'] = $request->secretary_id;
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

        return redirect('administration/holdinginfo');
    }

    public function show($id)
    {
       $holdinginfo = UnionInformation::find($id);
	   $secretaryuser = Secretary::find($holdinginfo->secretary_id);
	   return view('admin.holdinginfo.details',compact('holdinginfo','secretaryuser'));
    }

    public function edit($id)
    {
        $holdinginfo = UnionInformation::find($id);
		$secretaryuser = Secretary::orderBy('id','DESC')->get();
		$selecteduser = Secretary::find($holdinginfo->secretary_id);
		$links = Usefulllink::orderBy('id','DESC')->get();
		
        return view('admin.holdinginfo.edit',compact('holdinginfo','secretaryuser','selecteduser','links'));

    }

    public function update(Request $request, $id)
    {
		$this->validate($request, [
			'name'=>'required|max:255',	
			'spouse_name'=>'required|max:255',
			'usefulllink_id'=>'required',
        ]);	
		 
         $menu = UnionInformation::find($id);
        
		$secretary['secretary_id'] = $request->secretary_id;
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
        return redirect('administration/holdinginfo');
    }

    public function destroy($id)
    {
        $menuItem = UnionInformation::find($id);
        $menuItem->delete();
        return redirect('administration/holdinginfo');
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
