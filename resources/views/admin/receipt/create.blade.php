@extends('admin.include.master') 
	@section('title') New Money Receipt - HNILAUPs @endsection 
@section('content')
<script type="text/javascript">
	function totalamount(){
		alert("In");
		var amount = document.getElementById('investamount').value;
		//alert(amount);
		if(amount!=""){
		document.getElementById('number').value=amount;
		}
		else{
			amount=0;	
		}
		
		var bigNumArry = new Array('', ' thousand', ' million', ' billion', ' trillion', ' quadrillion', ' quintillion');

    var output = '';
    var numString =   document.getElementById('number').value;
    var finlOutPut = new Array();

    if (numString == '0') {
        document.getElementById('container').value = 'Zero';
        return;
    }

    if (numString == 0) {
        document.getElementById('container').value = 'messeg tell to enter numbers';
        return;
    }

    var i = numString.length;
    i = i - 1;

    //cut the number to grups of three digits and add them to the Arry
    while (numString.length > 3) {
        var triDig = new Array(3);
        triDig[2] = numString.charAt(numString.length - 1);
        triDig[1] = numString.charAt(numString.length - 2);
        triDig[0] = numString.charAt(numString.length - 3);

        var varToAdd = triDig[0] + triDig[1] + triDig[2];
        finlOutPut.push(varToAdd);
        i--;
        numString = numString.substring(0, numString.length - 3);
    }
    finlOutPut.push(numString);
    finlOutPut.reverse();
    for (j = 0; j < finlOutPut.length; j++) {
        finlOutPut[j] = triConvert(parseInt(finlOutPut[j]));
    }

    var bigScalCntr = 0; //this int mark the million billion trillion... Arry

    for (b = finlOutPut.length - 1; b >= 0; b--) {
        if (finlOutPut[b] != "dontAddBigSufix") {
            finlOutPut[b] = finlOutPut[b] + bigNumArry[bigScalCntr] + ' ';
            bigScalCntr++;
        }
        else {
            //replace the string at finlOP[b] from "dontAddBigSufix" to empty String.
            finlOutPut[b] = ' ';
            bigScalCntr++; //advance the counter  
        }
    }
        for(n = 0; n<finlOutPut.length; n++){
            output +=finlOutPut[n];
        }
    document.getElementById('container').value = output;//print the output
	}
	
	function triConvert(num){
    var ones = new Array('', ' one', ' two', ' three', ' four', ' five', ' six', ' seven', ' eight', ' nine', ' ten', ' eleven', ' twelve', ' thirteen', ' fourteen', ' fifteen', ' sixteen', ' seventeen', ' eighteen', ' nineteen');
    var tens = new Array('', '', ' twenty', ' thirty', ' forty', ' fifty', ' sixty', ' seventy', ' eighty', ' ninety');
    var hundred = ' hundred';
    var output = '';
    var numString = num.toString();

    if (num == 0) {
        return 'dontAddBigSufix';
    }
    //the case of 10, 11, 12 ,13, .... 19 
    if (num < 20) {
        output = ones[num];
        return output;
    }

    //100 and more
    if (numString.length == 3) {
        output = ones[parseInt(numString.charAt(0))] + hundred;
        output += tens[parseInt(numString.charAt(1))];
        output += ones[parseInt(numString.charAt(2))];
        return output;
    }

    output += tens[parseInt(numString.charAt(0))];
    output += ones[parseInt(numString.charAt(1))];

    return output;
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header">
                    <h3 class="page-title">Create New Money Receipt</h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>Settings</li>
                            <li class="active">New Money Receipt</li>
                            <li style="text-align:right; float:right">
                            	<a  href="{{ route('receipt.index') }}" style="color:#fff;"><i class="fa fa-list"></i> View Money Receipt List</a>
                            </li>
                        </ol>
                </div>
            
              @if (session()->has('messageType'))
                  <div class="alert alert-{{ session()->get('messageType') }}" role="alert">
                      <strong>STATUS: </strong> {{ session()->get('message') }}
                  </div>
              @endif
			</div>
              <div class="row-fluid">
                <div class="col-sm-12">
                  <div class="card">
                      
                      <div class="row" style="margin:10px">
                      	<div class="col-sm-12">
                            <form method="POST" action="{{ route('receipt.store') }}" enctype="multipart/form-data" id="tabs" style="width:100%;">
                                @csrf					
                              
                            <table width="100%" border="0" class="table-bordered table">
                                
                                <tr>
                                    <td>দাতার নাম<span style="color:#ff0000; font-size:20px;">*</span></td>            
                                    <td>
                                        <input id="sender_name" type="text" class="form-control" name="sender_name" value="{{ old('sender_name') }}" required>
                                        @if ($errors->has('sender_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('sender_name') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>গ্রহীতার নাম</td>            
                                    <td>
                                        <input id="receiver_name" type="text" class="form-control" name="receiver_name" value="{{ old('receiver_name') }}"> 
                                         @if ($errors->has('receiver_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('receiver_name') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>গ্রহীতার মোবাইল নং</td>            
                                    <td>
                                        <input id="receiver_contact" type="text" class="form-control" name="receiver_contact" value="{{ old('receiver_contact') }}"> 
                                         @if ($errors->has('receiver_contact'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('receiver_contact') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>উদ্দেশ্য</td>            
                                    <td>
                                        <input type="text" class="form-control" name="purpose" value="{{ old('purpose') }}"> 
                                    </td>
                                </tr>
                               
                               <tr>
                                    <td>টাকার পরিমাণ</td>            
                                    <td>
                                        <input type="text" class="form-control" name="amount" value="{{ old('amount') }}" id="investamount" onchange="totalamount()" onkeyup="totalamount()" > 
                                    </td>
                                </tr>
                                
                                
                                 <tr>
                                    <td>টাকার পরিমাণ (কথায়)</td>            
                                    <td>
                                        <input type="hidden" id="number" size="15" onkeyup="totalamount();"
                                        onkeydown="return (event.ctrlKey || event.altKey 
                                                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                                                        || (95<event.keyCode && event.keyCode<106)
                                                        || (event.keyCode==8) || (event.keyCode==9) 
                                                        || (event.keyCode>34 && event.keyCode<40) 
                                                        || (event.keyCode==46) )"/>
                                                <input type="text" name="amount_in_word" class="form-control col-md-7 col-xs-12" 
                                                id="container" style="text-transform:capitalize" value="{{ old('amount') }}">
                                    </td>
                                </tr>
                                
                                
                               
                                
                                <tr>
                                    <td>পাঠানোর তারিখ</td>            
                                    <td>
                                        <input type="date" class="form-control" name="date"> 
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>মতামত</td>            
                                    <td>
                                        <textarea class="form-control" name="remark" required> </textarea>
                                    </td>
                                </tr> 
                               
                               <tr><td><button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button></td></tr>
                           </table>
                        </form> 
                    	</div>
                      </div>
                  </div>
                </div>  
              </div>
			</div>
        </div>


@endsection

