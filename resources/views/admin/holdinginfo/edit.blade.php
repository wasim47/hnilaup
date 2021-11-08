@extends('admin.include.master') 
	@section('title') Edit - {{ $holdinginfo->name }} - HNILAUP @endsection 
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
                            {!! Form::model($holdinginfo, ['route'=>['holdinginfo.update', $holdinginfo->id], 'files' => true, 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                            <table width="100%" border="0" class="table-bordered table">
                                <tr>
                        <td>সেবা সমূহ<span style="color:#ff0000; font-size:20px;">*</span></td>            
                        <td>
                            <select name="usefulllink_id" class="form-control">
                                <option value="">Select</option>
                                @foreach($links as $link)
                                 <option value="{{ $link->id }}">{{  $link->name  }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('usefulllink_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('usefulllink_id') }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                                <tr>
                                    <td>সচিবের নাম<span style="color:#ff0000; font-size:20px;">*</span></td>            
                                    <td>
                                        <select name="secretary_id" class="form-control">
                                        	<option value="{{ $selecteduser->id }}">{{ $selecteduser->fullname }}</option>
                                            @foreach($secretaryuser as $users)
                                           	 <option value="{{ $users->id }}">{{  $users->fullname  }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>কর দাতার নাম<span style="color:#ff0000; font-size:20px;">*</span></td>            
                                    <td>
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $holdinginfo->name }}" required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>পিতা/স্বামীর নাম</td>            
                                    <td>
                                        <input id="spouse_name" type="text" class="form-control" name="spouse_name" value="{{ $holdinginfo->spouse_name }}"> 
                                         @if ($errors->has('spouse_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('spouse_name') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>গ্রাম</td>            
                                    <td>
                                        <input id="village" type="text" class="form-control" name="village" value="{{ $holdinginfo->village }}"> 
                                    </td>
                                </tr>
                               
                               <tr>
                                    <td>পেশা</td>            
                                    <td>
                                        <input id="profession" type="text" class="form-control" name="profession" value="{{ $holdinginfo->profession }}"> 
                                    </td>
                                </tr>
                                
                                
                               <tr>
                                    <td>এন আইডি নং</td>            
                                    <td>
                                        <input type="nid" class="form-control" name="nid" required value="{{ $holdinginfo->nid }}"> 
                                    </td>
                                </tr> 
                                
                                <tr>
                                    <td>হোল্ডিং নং</td>            
                                    <td>
                                        <input id="holding_no" type="text" class="form-control" name="holding_no" value="{{ $holdinginfo->holding_no }}"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>ওয়ার্ড নং</td>            
                                    <td>
                                        <input id="wordno" type="text" class="form-control" name="wordno" value="{{ $holdinginfo->wordno }}"> 
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>জমির পরিমাণ</td>            
                                    <td>
                                        <input type="text" class="form-control" name="land" value="{{ $holdinginfo->land }}"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>বসত বাড়ির ধরণ</td>            
                                    <td>
                                        <input type="text" class="form-control" name="house_type" value="{{ $holdinginfo->house_type }}"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>বাৎসরিক কার্য কৃত কর</td>            
                                    <td>
                                        <input type="text" class="form-control" name="yearly_tax" value="{{ $holdinginfo->yearly_tax }}"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>অর্থ বছর</td>            
                                    <td>
                                        <input type="text" class="form-control" name="budget_year" value="{{ $holdinginfo->budget_year }}"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>মন্তব্য</td>            
                                    <td>
                                        <input type="text" class="form-control" name="remark" value="{{ $holdinginfo->remark }}"> 
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
