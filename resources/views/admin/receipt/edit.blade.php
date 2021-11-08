@extends('admin.include.master') 
	@section('title') Edit - {{ $receipt->name }} - HNILAUP @endsection 
@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="{{ asset('/app-assets/plugins/datatables/datatables.css') }}" rel="stylesheet" type="text/css">
    <style>
    .form-control{
		border:1px solid #999 !important;
	}
    </style>
    <div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header">
                    <h3 class="page-title">Money Receipt Information Edit</h3>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">Home</a></li>
                        <li>Settings</li>
                        <li class="active">Edit - {{ $receipt->name }}</li>
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
                      	<div class="col-sm-offset-2">  
                            {!! Form::model($receipt, ['route'=>['receipt.update', $receipt->id], 'files' => true, 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                             <table width="100%" border="0" class="table-bordered table">
                	
                                <tr>
                                    <td>দাতার নাম<span style="color:#ff0000; font-size:20px;">*</span></td>            
                                    <td>
                                        <input id="sender_name" type="text" class="form-control" name="sender_name" value="{{ $receipt->sender_name }}" required>
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
                                        <input id="receiver_name" type="text" class="form-control" name="receiver_name" value="{{ $receipt->receiver_name }}"> 
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
                                        <input id="receiver_contact" type="text" class="form-control" name="receiver_contact" value="{{ $receipt->receiver_contact }}"> 
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
                                        <input type="text" class="form-control" name="purpose" value="{{ $receipt->purpose }}"> 
                                    </td>
                                </tr>
                               
                               <tr>
                                    <td>টাকার পরিমাণ</td>            
                                    <td>
                                        <input type="text" class="form-control" name="amount" value="{{ $receipt->amount }}"> 
                                    </td>
                                </tr>
                                
                                
                               
                                
                                <tr>
                                    <td>পাঠানোর তারিখ</td>            
                                    <td>
                                        <input type="date" class="form-control" name="date" value="{{ $receipt->date }}"> 
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>মতামত</td>            
                                    <td>
                                        <textarea class="form-control" name="remark" required>{{ $receipt->remark }}</textarea>
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
