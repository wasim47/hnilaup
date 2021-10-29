<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NoticeType;
use Auth;
use DB;

class NoticetypeController extends Controller
{
    public function index()
    {
        $noticetype = NoticeType::all();
        return view('admin.noticetype.index',compact('noticetype'));
    }

    public function create()
    {
        return view('admin.noticetype.create');
    }

  
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'Required'
        ]);

        $mname = $request->name;
        $slug=strtolower(implode('-', explode(' ', $mname)));
        $m = new NoticeType;
        
        $m->slug = $slug;
        $m->name = $request->name;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/noticetype');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $menu = NoticeType::find($id);		
        return view('admin.noticetype.edit',compact('menu'));
    }

  
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'Required'
        ]);


        $menu = NoticeType::find($id);
        $slug = strtolower(implode('-', explode(' ', $request->name)));

        $menuUpdate = array(
			'name'=>$request->name,
            'slug'=>$slug
        );

        $menu->update($menuUpdate);
        return redirect('administration/noticetype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menuItem = NoticeType::find($id);
        $menuItem->delete();
        return redirect('/mne/noticetype');
    }
}
