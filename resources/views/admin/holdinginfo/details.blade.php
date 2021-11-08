@extends('admin.include.master') 
	@section('title') Edit - {{ $holdinginfo->name }} - HNILAUP @endsection 
@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="{{ asset('/app-assets/plugins/datatables/datatables.css') }}" rel="stylesheet" type="text/css">
    
    <div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header">
                    <h3 class="page-title">Holding Info Information Edit</h3>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">Home</a></li>
                        <li>Settings</li>
                        <li class="active">Edit - {{ $holdinginfo->name }}</li>
                         <li style="text-align:right; float:right">
                            	<a  href="{{ route('holdinginfo.index') }}" style="color:#fff;"><i class="fa fa-list"></i> View Holding Info List</a>
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
                                                    <td>সচিবের নাম<span style="color:#ff0000; font-size:20px;">*</span></td>            
                                                    <td>{{ $secretaryuser->fullname }}</td>
                                                </tr>
                                                 <tr>
                                                    <td>কর দাতার নাম<span style="color:#ff0000; font-size:20px;">*</span></td>            
                                                    <td>{{ $holdinginfo->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>পিতা/স্বামীর নাম</td>            
                                                    <td>{{ $holdinginfo->spouse_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>গ্রাম</td>            
                                                    <td>{{ $holdinginfo->village }}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>পেশা</td>            
                                                    <td>{{ $holdinginfo->profession}}</td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <td>এন আইডি নং</td>            
                                                    <td>{{ $holdinginfo->nid }}</td>
                                                </tr> 
                                                
                                                <tr>
                                                    <td>হোল্ডিং নং</td>            
                                                    <td>{{ $holdinginfo->holding_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>ওয়ার্ড নং</td>            
                                                    <td>{{ $holdinginfo->wordno }}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>জমির পরিমাণ</td>            
                                                    <td>{{ $holdinginfo->land }}</td>
                                                </tr>
                                                <tr>
                                                    <td>বসত বাড়ির ধরণ</td>            
                                                    <td>{{ $holdinginfo->house_type }}</td>
                                                </tr>
                                                <tr>
                                                    <td>বাৎসরিক কার্য কৃত কর</td>            
                                                    <td>{{ $holdinginfo->yearly_tax }}</td>
                                                </tr>
                                                <tr>
                                                    <td>অর্থ বছর</td>            
                                                    <td>{{ $holdinginfo->budget_year }}</td>
                                                </tr>
                                                <tr>
                                                    <td>মন্তব্য</td>            
                                                    <td>{{ $holdinginfo->remark }}</td>
                                                </tr>
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
