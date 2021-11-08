@extends('admin.include.master') 
	@section('title') Edit - {{ $receipt->name }} - HNILAUP @endsection 
@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="{{ asset('/app-assets/plugins/datatables/datatables.css') }}" rel="stylesheet" type="text/css">
    
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
                        
                        
                       <table width="100%" border="0" class="table-bordered table">
                	
                                <tr>
                                    <td>দাতার নাম<span style="color:#ff0000; font-size:20px;">*</span></td>            
                                    <td>{{ $receipt->sender_name }}</td>
                                </tr>
                                <tr>
                                    <td>গ্রহীতার নাম</td>            
                                    <td>{{ $receipt->receiver_name }}</td>
                                </tr>
                                <tr>
                                    <td>গ্রহীতার মোবাইল নং</td>            
                                    <td>{{ $receipt->receiver_contact }}</td>
                                </tr>
                                <tr>
                                    <td>উদ্দেশ্য</td>            
                                    <td>{{ $receipt->purpose }}</td>
                                </tr>
                               
                               <tr>
                                    <td>টাকার পরিমাণ</td>            
                                    <td>{{ $receipt->amount }} </td>
                                </tr>
                                
                                
                                <tr>
                                    <td>পাঠানোর তারিখ</td>            
                                    <td>{{ $receipt->date }}</td>
                                </tr>
                                
                                <tr>
                                    <td>মতামত</td>            
                                    <td>{{ $receipt->remark }}</td>
                                </tr> 
                               
                               <tr><td><button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button></td></tr>
                           </table>
                    	</div>
                      </div>
              	
          </div>
        </div>  
      </div>
	</div>
  </div>
@endsection

  <script src="{{ asset('/app-assets/plugins/datatables/dataTables.min.js') }}"></script>
  <script src="{{ asset('/app-assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
  <script src="{{ asset('/app-assets/pages/datatables.js') }}"></script>
