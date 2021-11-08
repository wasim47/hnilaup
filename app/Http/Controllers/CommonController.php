<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Auth;
use DB;
use App\Administration;
use App\UnionInformation;
use App\Usefulllink;
use App\Secretary;
use Redirect;
use Rap2hpoutre\FastExcel\FastExcel;
use Validator;

class CommonController extends Controller
{
   public function deletedata(Request $req)
    {
	    $id = $req->id;
		$deletetype = $req->deletetype;
		$deleteimage = $req->deleteimage;
		$tablename = $req->tablename;

		if($deletetype=='single'){
			//$menuItem = Administration::find($id)->delete();
			DB::table($tablename)->where('id', $id)->delete();
		}
		elseif($deletetype=='multiple'){
			//$menuItem = Administration::whereIn('id', $id)->delete();
			DB::table($tablename)->whereIn('id', $id)->delete();
		}
		 return $id;
    }


	public function permissionsHospital(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		
		$status = $req->status;

		 $arrayuval =  array(
			'status'=>$status
		);
		$updval = DB::table('hospitals')->whereIn('id', $valuearray)->update($arrayuval);
		$updval1 = DB::table('hospital_users')->whereIn('hospital_id', $valuearray)->update($arrayuval);

         return Redirect::back();
    }
	
	
	public function permissions(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		//dd($valuearray);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'status'=>$status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

         return Redirect::back();
    }
	public function adminPermissions(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		//dd($valuearray);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'active'=>$status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

         return Redirect::back();
    }



	public function changestatus(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'member_type'=>$status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

         return Redirect::back();
    }


	public function codeGeneration()
    {
		$token = $this->getToken(5);
        $codes = 'HNILAUP'.$token;
		return $codes;
    }
	
	private function getToken($length){    
        $token = "";
        $codeAlphabet = "abcdefghijklmnopqrstuvwxyx";
        $codeAlphabet.= "0123456789";

	   mt_srand(time());
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;
    }
	
	
	
	public function updateSlug(Request $req)
    {
		//////////////// Update Slug /////////////////
		
		/*$allDatas = DB::table('hospitals')->whereNull('email')->get();
		$i=0;
		foreach($allDatas as $datas){
			$i++;
			$makeemail = 'bd-icu'.$i.'@bd-icu.com';
			//echo $makeemail;
			//$arrayvals = array('email'=>$makeemail);
			$arrayvals = array('email'=>$makeemail);
			DB::table('hospitals')->where('id', $datas->id)->update($arrayvals);
			DB::table('hospital_users')->where('hospital_id', $datas->id)->update($arrayvals);
		}*/		
		
		/*$allDatas = DB::table('icutypes')->get();
		$i=0;
		foreach($allDatas as $datas){
			$i++;
			$icuvals = array('icutype_val'=>$datas->name);
			$bedyvals = array('bedtype_val'=>$datas->name);
			
			DB::table('icu_reports')->where('icutype', $datas->id)->update($icuvals);
			DB::table('bed_reports')->where('bedtype', $datas->id)->update($bedyvals);
		}*/
		
		$getDatas = DB::table('news_events')->get();		
		foreach($getDatas as $gData){
			$expval=explode(' ',$gData->name);
			$impval=implode('-',$expval);
			$slug   = str_replace([',', "'",'"', '/','|','.','`'],'' , $impval);
			
			 $menuUpdate = array(
				'url'=> strtolower($slug),
				'updated_at'=> date('Y-m-d H:i:s')
			 );
	
			DB::table('news_events')->where('id',$gData->id)->update($menuUpdate);		
		}
		
		/*$allDatas = DB::table('divisions')->get();
		$i=0;
		foreach($allDatas as $datas){
			$i++;
			$icuvals = array('division_id'=>$datas->name);
			
			DB::table('icu_reports')->where('division_id', $datas->id)->update($icuvals);
			DB::table('bed_reports')->where('division_id', $datas->id)->update($icuvals);
		}*/
	}
	
	/*public function updateSlug()
	{
		$getDatas = DB::table('gift_card_groups')->get();		
		foreach($getDatas as $gData){
			$expval=explode(' ',$gData->name);
			$impval=implode('-',$expval);
			$slug   = str_replace([',', "'",'"', '/','|','.','`'],'' , $impval);
			
			 $menuUpdate = array(
				'slug'=> $slug
				'updated_at'=> date('Y-m-d H:i:s')
			 );
	
			DB::table('gift_card_groups')->where('id',$gData->id)->update($menuUpdate);		
		}
	}*/
	
	
	
	
	
	
	 public function sampleFileDownload()
    {
		$getFile = 'demo_excel_file.csv';		
    	$filePath = public_path("samplefiles/".$getFile);		
		//dd($filePath);
    	$headers = ['Content-Type: application/csv'];
    	return response()->download($filePath, $getFile, $headers);
    }
	
	
	public function import(Request $req)
    {
		if ($req->hasFile('importfile')) {
			$validator = Validator::make(
			  [
				  'file'      => $req->importfile,
				  'extension' => strtolower($req->importfile->getClientOriginalExtension()),
			  ],
			  [
				  'file'          => 'required',
				  'extension'      => 'required|in:csv,xlsx,xls',
			  ]
			);
	
			$file = $req->file('importfile');
			
			$file->move(public_path('import-directory'), $file->getClientOriginalName());
			
	
			$files = $file->getClientOriginalName();
			
			$filename = pathinfo($files, PATHINFO_FILENAME);
			$extension = pathinfo($files, PATHINFO_EXTENSION);
			$importfiles = $filename.'.'.$extension;
			if($extension=='csv' || $extension=='xlsx' || $extension=='xls'){
			
				$path = public_path('import-directory').'/'.$importfiles;	
					$users = (new FastExcel)->import($path, function ($line) {
						$checkservice = Usefulllink::where('name',$line['Service Name'])->first();
						if($checkservice!=""){
							$serviceid = $checkservice->id;
						}
						else{
							$serviceid = 0;
						}
						
						$checkuser = Secretary::where('fullname',$line['Secretary Name'])->first();
						if($checkuser!=""){
							$secreteryid = $checkuser->id;
						}
						else{
							$secreteryid = 0;
						}
						
						
						UnionInformation::create([
							'secretary_id' => $secreteryid,
							'usefulllink_id' => $serviceid,
							'name' => $line['Name'],
							'spouse_name' => $line['Father_Husband Name'],
							'village' => $line['Village'],
							'profession' => $line['Profession'],
							'nid' => $line['NID'],
							'holding_no' => $line['Holding No'],
							'wordno' => $line['Word No'],
							'land' => $line['Amount of land'],
							'house_type' => $line['House Type'],
							'yearly_tax' => $line['Yearly tax'],
							'budget_year' => $line['Budget Year'],
							'remark' => $line['Remart'],
						]);
					});		
		
				return redirect()->back();		
			}
			else{
				return redirect()->back()->with('error','Please select excel or csv file only');
			}
		}
		else{
			return redirect()->back()->with('error','Please select excel file');
		}
    }
	
	
	public function export(Request $req)
    {
				function usersGenerator() {
					foreach (UnionInformation::cursor() as $user) {
						$checkservice = Usefulllink::where('id',$user->usefulllink_id )->first();
						if($checkservice!=""){
							$serviceid = $checkservice->name;
						}
						else{
							$serviceid = '';
						}
						
						$checkuser = Secretary::where('id',$user->secretary_id )->first();
						if($checkuser!=""){
							$secreteryid = $checkuser->fullname;
						}
						else{
							$secreteryid = '';
						}
					
						$arrayval = array(					
							'Secretary Name' => $secreteryid,
							'Service Name' => $serviceid,
							'Name' => $user->name,
							'Father/Husband Name' => $user->spouse_name,
							'Village' => $user->village,
							'Profession' => $user->profession,
							'NID' => $user->nid,
							'Holding No' => $user->holding_no,
							'Word No' => $user->wordno,
							'Amount of land' => $user->land,
							'House Type' => $user->house_type,
							'Yearly tax' => $user->yearly_tax,
							'Budget Year' => $user->budget_year,
							'Remart' => $user->remark,
						);	
		
						yield $arrayval;
					}
				}	
				return (new FastExcel(usersGenerator()))->download('Holding_Information_'.date('Y-m-d H-m-i').'.csv');			
    }

}
