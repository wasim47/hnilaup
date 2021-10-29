<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Secretary;
use DB;
use Image;
use Hash;

class SecretaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administration');
    }
    public function index()
    {
        $secretaryuser = Secretary::orderBy('id','DESC')->paginate(50);
        return view('admin.secretary.index', compact('secretaryuser'));
    }



    public function create()
    {
        return view('admin.secretary.create');
    }

    public function store(Request $request)
    {
       $this->validate($request, [
            'fullname' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255', 'unique:secretaries'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:secretaries'],
			'password' => ['required', 'string', 'min:6'],
        ]);
		
		if ($request->hasFile('photo')) {
            if($request->file('photo')->isValid()) {
                try {
                    $file = $request->file('photo');
                    $savedImageName = 'secretary_'.time() . '.' . $file->getClientOriginalExtension();        
					
					$pathLarge = 'uploads/secretary/'.$savedImageName;
				    $this->imageResize($file,$pathLarge,$savedImageName, 450, 450);		
				   
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {        
              }
            }
        }
        else{
            $savedImageName = '';
         }
		 
		
		$secretary['photo'] = $savedImageName;
		$secretary['fullname'] = $request->fullname;
		$secretary['designation'] = $request->designation;
		$secretary['contact'] = $request->contact;
		$secretary['email'] = $request->email;
		$secretary['address'] = $request->address;
		$secretary['password'] = Hash::make($request->password);
		$secretary['password_hints'] = $request->password;
		$secretary['status'] = 1;
		
		Secretary::insert($secretary);		
        return redirect('administration/secretary');
    }

   
   
    public function show($id)
    {
        $secretaryinfo = Secretary::find($id);
		return view('admin.secretary.details',compact('secretaryinfo'));
    }

   
    public function edit($id)
    {
        $secretaryinfo = Secretary::find($id);
		return view('admin.secretary.edit',compact('secretaryinfo'));
    }

   
    public function update(Request $request, $id)
    {
		 $this->validate($request, [
            'fullname' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255', 'unique:secretaries,contact,'.$id.',id'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:secretaries,email,'.$id.',id'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);	

		if ($request->hasFile('photo')) {
            if($request->file('photo')->isValid()) {
                try {
                    $file = $request->file('photo');
                    $savedImageName = 'secretary_'.time() . '.' . $file->getClientOriginalExtension();        
					
					$pathLarge = 'uploads/secretary/'.$savedImageName;
				    $this->imageResize($file,$pathLarge,$savedImageName, 450, 450);		
				   
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {        
              }
            }
        }
        else{
            $savedImageName = $request->stillimages;
         }
		 
        $menu = Secretary::find($id);
        
		$secretary['photo'] = $savedImageName;
		$secretary['fullname'] = $request->fullname;
		$secretary['designation'] = $request->designation;
		$secretary['contact'] = $request->contact;
		$secretary['email'] = $request->email;
		$secretary['address'] = $request->address;
		$secretary['password'] = Hash::make($request->password);
		$secretary['password_hints'] = $request->password;
		$secretary['status'] = 1;
		
        $menu->update($secretary);
        return redirect('administration/secretary');
    }

    public function destroy($id)
    {
        $menuItem = Secretary::find($id);
        $menuItem->delete();
        return redirect('administration/secretary');
    }
	
	
	public function imageResize($file, $path, $filename, $width, $height)
	{	
		$img = Image::make($file);
		$img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
		$img->save($path);
	}	
}
