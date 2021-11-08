<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Receipt;
use App\Administration;
use Auth;
use Validator;
use Image;


class ReceiptController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allreceipt = Receipt::orderBy('id','desc')->get();
    	return view('admin.receipt.index',compact('allreceipt'));
     }


    public function create()
    {
        return view('admin.receipt.create');
    }

    public function store(Request $request)
    {
		$this->validate($request, [
			'sender_name'=>'required|max:255',	
			'receiver_name'=>'required|max:255',
        ]);
		
		$latestOrderNumber = Receipt::select('memo')->orderBy('id','DESC')->first();
		if($latestOrderNumber!=""){
			$exstOrders = $latestOrderNumber->memo;
		}
		else{
			$exstOrders = "000000";
		}

		$ordernumber = str_pad($exstOrders + 1, 6, "0", STR_PAD_LEFT);
					
		
		$userid = Auth::guard('administration')->user()->id;	
		$secretary['userid'] = $userid;
		$secretary['sender_name'] = $request->sender_name;
		$secretary['receiver_name'] = $request->receiver_name;
		$secretary['receiver_contact'] = $request->receiver_contact;
		$secretary['purpose'] = $request->purpose;
		$secretary['amount'] = $request->amount;
		$secretary['amount_in_word'] = $request->amount_in_word;
		$secretary['paymenttype'] = $request->paymenttype;
		$secretary['memo'] = $ordernumber;
		$secretary['date'] = $request->date;
		$secretary['remark'] = $request->remark;
		
		Receipt::create($secretary);

        return redirect('administration/receipt');
    }

    public function show($id)
    {
       $receipt = Receipt::find($id);
	   $secretaryuser = Administration::find($receipt->userid_id);
	   return view('admin.receipt.details',compact('receipt','secretaryuser'));
    }
	
	 public function prints($id)
    {
       $receipt = Receipt::find($id);
	   return view('admin.receipt.print',compact('receipt'));
    }
    public function edit($id)
    {
        $receipt = Receipt::find($id);
		$selecteduser = Administration::find($receipt->userid_id);
		
        return view('admin.receipt.edit',compact('receipt','selecteduser'));

    }

    public function update(Request $request, $id)
    {
		$this->validate($request, [
			'sender_name'=>'required|max:255',	
			'receiver_name'=>'required|max:255',
        ]);
		 
		$latestOrderNumber = Receipt::select('memo')->orderBy('id','DESC')->first();
		if($latestOrderNumber!=""){
			$exstOrders = $latestOrderNumber->memo;
		}
		else{
			$exstOrders = "000000";
		}

		$ordernumber = str_pad($exstOrders + 1, 6, "0", STR_PAD_LEFT);
		
        $menu = Receipt::find($id);        
		$userid = Auth::guard('administration')->user()->id;	
		$secretary['userid'] = $userid;
		$secretary['sender_name'] = $request->sender_name;
		$secretary['receiver_name'] = $request->receiver_name;
		$secretary['receiver_contact'] = $request->receiver_contact;
		$secretary['purpose'] = $request->purpose;
		$secretary['amount'] = $request->amount;
		$secretary['amount_in_word'] = $request->amount_in_word;
		$secretary['paymenttype'] = $request->paymenttype;
		$secretary['memo'] = $ordernumber;
		$secretary['date'] = $request->date;
		$secretary['remark'] = $request->remark;
		
        $menu->update($secretary);
        return redirect('administration/receipt');
    }

    public function destroy($id)
    {
        $menuItem = Receipt::find($id);
        $menuItem->delete();
        return redirect('administration/receipt');
    }

}
