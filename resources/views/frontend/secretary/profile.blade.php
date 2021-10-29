@extends('layouts.app')
@section('title', $custominfo->fullname)

@section('sidebar')
    @parent
@endsection

@section('content')
<style>
.dashboards{
	width:100%;
	height:140px;
	float:left;
	background:#05458B;
	padding:20px 10px;
	text-align:center;
	color:#fff !important;
	font-weight:bold;
	font-size:25px;
	margin:10px;
	border-radius:10px;
	text-shadow:none !important;
	vertical-align:middle;
}
.dashboards:hover{	
	background:#022348;	
	transition: 0.3s;
	cursor:pointer;
	text-shadow:none !important;
}
.table td, th{
	padding:5px !important;
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
     <section id="features" class="features">
      <div class="container">

        <div class="section-title" style="margin-top:20px; float:left; width:100%;">
          <h2>{{ $custominfo->fullname }}</h2>
          <div style="width:100%;">
          	@if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
          </div>
        </div>

        <div class="row">        	 
          <div class="col-lg-2" style="margin:0; padding:0">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#tab-1" style="color:#333">{{ trans('app.profile') }}</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-2" style="color:#333">User List</a></li>  
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-5" style="color:#333">{{ trans('app.update').' '.trans('app.profile') }}</a></li>              
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-6" style="color:#333">{{ trans('app.change').' '.trans('app.Password') }}</a></li>
              
              <li class="nav-item"><a href="{{ route('secretary.logout') }}" class="nav-link"  style="color:#333"
                  onClick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ trans('app.logout') }}</a>
                  <form id="logout-form" action="{{ route('secretary.logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
               </li>
            </ul>
          </div>
          
          
          <div class="col-lg-10 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <div class="row">
                  <div class="col-lg-12 details order-2 order-lg-1">
                    	<table width="100%" border="1" class="table table-bordered">
                        	
                             <tr>
                                <td width="35%">{{ trans('app.user').' '.trans('app.name') }}</td>            
                                <td width="65%">{{ $custominfo->fullname }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('app.contact') }}</td>            
                                <td>{{ $custominfo->contact }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('app.email').' ('.trans('app.user').' '.trans('app.name').')' }}</td>            
                                <td>{{ $custominfo->email }}</td>
                            </tr>
                             <tr>
                                <td>{{ trans('app.designation') }}</td>            
                                <td>{{ $custominfo->designation }}</td>
                            </tr> <tr>
                                <td>{{ trans('app.address') }}</td>            
                                <td>{{ $custominfo->address }}</td>
                            </tr>
                            
                            <tr>
                                <td>{{ trans('app.photo') }}</td>            
                                <td>
                                    @if($custominfo->photo!="") <img src="{{ asset('uploads/secretary/'.$custominfo->photo) }}" style="width:100px; height:auto" /> @endif
                                </td>
                            </tr>
                            </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-2">
                <div class="row">
                  <div class="col-lg-12 details order-2 order-lg-1">
                  		<div class="col-sm-12 breadcrumb pull-right" style="float:right; text-align:right">
                          <a  href="javascript:void()" onclick="permissions('union_informations','1','status');" style="color:#000; margin-right:5px;" 
                          class="btn btn-success btn-sm"><i class="fa fa-check"></i> {{ trans('app.approve') }}</a>
                          <a  href="javascript:void()" onclick="permissions('union_informations','0','status');" style="color:#000; margin-right:5px;" 
                          class="btn btn-warning btn-sm"><i class="fa fa-times"></i> {{ trans('app.disapprove') }}</a>
                          
                          <a href="javascript:void(0)" class="btn btn-primary btn-sm" style="font-size: 12px; float:left; margin-right:5px;" title="New User" 
                            data-toggle="modal" data-target="#newUsers">{{ trans('app.addnewuser') }}</a>
                            
                             <form action="#">
                                <div style="width:90%; float:left"><input type="text" name="keywords" id="keywords" class="form-control" 
                                style="height:30px; padding:5px; margin-right:5px; float:left; font-size:13px;" placeholder="Search with name, contact, email..." /></div>
                                <div style="width:10%; float:left"><button type="button" class="btn btn-primary btn-sm" onclick="filterData();">{{ trans('app.search') }}</button></div>
                                </form>
                          </div>
                        	<table width="100%" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                        <th width="2%">#</th>
                                      <th width="5%" height="22">{{ trans('app.serial') }}</th>
                                      <th width="17%">কর দাতার নাম</th>
                                      <th width="16%">পিতা/স্বামীর নাম</th>
                                      <th width="13%">গ্রাম</th>
                                      <th width="15%">পেশা</th>
                                      <th width="5%">হোল্ডিং নং</th>
                                      <th width="5%">Action</th>
                                   </tr>
                                </thead>
                                <tbody>
                                 <?php $i=0; ?>
                                @foreach($unioninformation as $k=>$menu)
                                <?php $i++; 
                                ?>
                                <tr id="tablerow<?php echo $menu->id;?>" class="tablerow">	
                                    <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $menu->id }}" /></td>
                                    <td>{{ $i }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->spouse_name }}</td>
                                    <td>{{ $menu->village }}</td>
                                    <td>{{ $menu->profession }}</td>
                                    <td>{{ $menu->holding_no }}</td>
                                    <td  align="center">                                   
                                    
                                    <a href="javascript:void(0)" class="btn btn-info btn-xs" style="font-size: 12px; float:left; margin-right:5px;" title="{{ trans('app.details') }}" 
                                    data-toggle="modal" data-target="#exampleModal{{ $menu->id }}"><i class="fa fa-file"></i></a>                        
                                     <div class="modal fade" id="exampleModal{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document" style="max-width:800px!important">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <div style="width:100%; height:auto; float:left; ">
                                                <div style="width:100%; height:auto; float:left;">
                                                    <div style="width:50%; height:auto; float:left">
                                                        <h2 class="modal-title" id="exampleModalLabel" style="padding:0; margin:0; text-align:left; font-weight:bold">{{ trans('app.details') }}</h2>
                                                    </div>
                                                    <div style="width:50%; height:auto; float:left">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                <div style="width:100%; height:auto; float:left; text-align:left; margin-top:15px; font-size:25px;">
                                                    {{ $menu->name }}
                                                </div>
                                            </div>                                          
                                          </div>
                                          <div class="modal-body" style="padding:2rem">
                                            <div style="width:100%; height:auto; float:left; box-shadow:#eaeaea 0 0 8px 8px; padding:40px;">
                                              <table width="100%" border="0" class="customtable">
                                                <tr>
                                                    <td align="right">{{ trans('app.address') }}</td>        
                                                    <td>&nbsp;</td>             
                                                  <td>{{ $menu->address }}</td>
                                                </tr>
                                               
                                              <tr>
                                                    <td width="29%" align="right">{{ trans('app.contact') }}</td>   
                                                    <td width="5%">&nbsp;</td>         
                                                  <td width="66%">{{ $menu->contact }}</td>
            </tr>
                                                <tr>
                                                    <td align="right">{{ trans('app.email') }}</td>         
                                                    <td>&nbsp;</td>            
                                                  <td>{{ $menu->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right">{{ trans('app.userinfo') }}</td> 
                                                    <td>&nbsp;</td>                   
                                                  <td>{{ $menu->designation }}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right">{{ trans('app.Password') }}</td>  
                                                    <td>&nbsp;</td>                   
                                                  <td>{{ $menu->password_hints }}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right">{{ trans('app.usertype') }}</td>  
                                                    <td>&nbsp;</td>                   
                                                  <td>{{ $menu->usertype }}</td>
                                                </tr>                                                
                                                
                                                <tr>
                                                    <td align="right">{{ trans('app.photo') }}</td>   
                                                    <td>&nbsp;</td>                  
                                              <td>
                                                        @if($menu->photo!="") <img src="{{ asset('uploads/secretary/user/'.$menu->photo) }}" style="width:100px; height:auto" /> @endif
                                                    </td>
                                                </tr>
                                                </table>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                                                    
                                    <a href="javascript:void(0)" class="btn btn-warning btn-xs" style="font-size: 12px; float:left; margin-right:5px;" title="{{ trans('app.edit') }}"
                                    data-toggle="modal" data-target="#useredit{{ $menu->id }}">
                                    <i class="fa fa-edit"></i></a>
                                    
                                    <div class="modal fade" id="useredit{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document" style="max-width:800px!important">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <div style="width:100%; height:auto; float:left; ">
                                                <div style="width:100%; height:auto; float:left;">
                                                    <div style="width:50%; height:auto; float:left">
                                                        <h2 class="modal-title" id="exampleModalLabel" style="padding:0; margin:0; text-align:left; font-weight:bold">{{ trans('app.details') }}</h2>
                                                    </div>
                                                    <div style="width:50%; height:auto; float:left">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                <div style="width:100%; height:auto; float:left; text-align:left; margin-top:15px; font-size:25px;">
                                                    {{ $menu->fullname }}
                                                </div>
                                            </div>                                          
                                          </div>
                                          <div class="modal-body" style="padding:2rem">
                                            <div style="width:100%; height:auto; float:left; box-shadow:#eaeaea 0 0 8px 8px; padding:40px;">
                                                <form method="POST" action="{{ route('secretary.useredit') }}" enctype="multipart/form-data" id="tabs" style="width:100%;">
                                                @csrf	
                                                     <table width="100%" border="0" class="table-bordered table">
                                                    <tr>
                                                        <td>{{ trans('app.user').' '.trans('app.name') }}<span style="color:#ff0000; font-size:20px;">*</span></td>            
                                                        <td>
                                                            <input id="name" type="text" class="form-control" name="fullname" value="{{ $menu->fullname }}" required>
                                                            @if ($errors->has('fullname'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('fullname') }}</strong>
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ trans('app.contact') }}</td>            
                                                        <td>
                                                            <input id="contact" type="text" class="form-control" name="contact" value="{{ $menu->contact }}"> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ trans('app.email') }}</td>            
                                                        <td>
                                                            <input id="email" type="text" class="form-control" name="email" value="{{ $menu->email }}">
                                                        </td>
                                                    </tr>
                                                   
                                                   <tr>
                                                        <td>{{ trans('app.userinfo') }}</td>            
                                                        <td>
                                                            <input id="designation" type="text" class="form-control" name="designation" value="{{ $menu->designation }}"> 
                                                        </td>
                                                    </tr>
                                                    
                                                    
                                                   <tr>
                                                        <td>{{ trans('app.Password') }}</td>            
                                                        <td>
                                                            <input type="password" class="form-control" name="password" value="{{ $menu->password_hints }}"> 
                                                        </td>
                                                    </tr> 
                                                    
                                                    <tr>
                                                        <td>{{ trans('app.address') }}</td>            
                                                        <td>
                                                            <input id="address" type="text" class="form-control" name="address" placeholder="Ex: Mirpur-11, Dhaka" value="{{ $menu->address }}"> 
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>{{ trans('app.photo') }}</td>            
                                                        <td>
                                                            <input type="file" class="form-control" name="photo"> 
                                                            <input type="hidden" name="stillimages" value="{{ $menu->photo }}" />
                                                            <input type="hidden" name="currentuid" value="{{ $menu->id }}" />
                                                        </td>
                                                    </tr>
                                          
                                                    
                                           <tr><td><button type="submit" class="btn btn-primary">{{ trans('app.edit') }}</button></td></tr>
                                       </table>
                                                </form>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                                    
                                    
                                    <button type="button" class="btn btn-danger btn-xs" style="font-size: 12px; float:left;"
                                                onclick="deleteSingle('<?php echo $menu->id;?>','masterdelete','union_informations')" title="{{ trans('app.delete') }}"><i class="fa fa-trash"></i></button>
                                                
                                                
                                   </td>
                                </tr>
                                 
                                @endforeach
                                 <tr><td colspan="10">{{ $unioninformation->links() }}</td></tr>
                                </tbody>   
                             </table>
                              </div>                  
                            </div>
                          </div>
              
              <div class="tab-pane" id="tab-5">
                <div class="row">
                    <div class="col-sm-12" id="firststep">
                    	<form action="{{ route('secretary.updateprofile') }}" method="POST" enctype="multipart/form-data">
                       {{ csrf_field() }}                       	  
                            <div class="col-sm-12">
                               <table width="100%" border="1" class="table table-bordered">
                                
                                 <tr>
                                    <td width="35%" colspan="2"><h2>{{ trans('app.userinfo') }}</h2></td>     
                                </tr>
                                
                                 <tr>
                                    <td width="35%">{{ trans('app.user').' '.trans('app.name') }}</td>            
                                    <td width="65%"><input type="text" class="form-control" name="fullname" value="{{ $custominfo->fullname }}" /></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('app.contact') }}</label>            
                                    <td><input type="text" class="form-control" name="contact" value="{{ $custominfo->contact }}" /></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('app.email') }}</label>            
                                    <td><input type="email" class="form-control" name="email" value="{{ $custominfo->email }}" /></td>
                                </tr>
                                
                                <tr>
                                    <td>{{ trans('app.userinfo') }}</label>            
                                    <td><input type="text" class="form-control" name="designation" value="{{ $custominfo->designation }}" /></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('app.address') }}</label>            
                                    <td><textarea class="form-control" name="address">{{ $custominfo->address }}</textarea></td>
                                </tr>
                                
                                <tr>
                                    <td>{{ trans('app.photo') }}</label>            
                                    <td>
                                        <input type="file" class="form-control" name="logo"> 
                                        <input type="hidden" class="form-control" name="stillimages" value="{{ $custominfo->photo }}"> 
                                    </td>
                                </tr>
                                </table>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-md-6 pull-right">
                                    <input type="submit" value="Update" class="btn btn-success"/>        
                                </div>
                            </div>   
                        </form>                    
                        
                    </div>
                </div>
              </div>              
              <div class="tab-pane" id="tab-6">
                <div class="row">
                 <div class="col-md-12">
                    <div class="boardTitle">
                        <h2 style="margin:20px 0;">{{ trans('app.changePassword') }}</h2>
                    </div>                   
                    <form action="{{ route('secretary.passwordupdate') }}" method="post" role="form">
                    {{csrf_field()}}
                        <div class="row">
                           
                            <div class="col-md-4">
                                <div class="accountInput">
                                    <div class="h5">{{ trans('app.currentPassword') }}:</div>
                                    <input type="password" class="form-control" placeholder="*********" name="old">
                                     @if ($errors->has('old'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="accountInput">
                                    <div class="h5">{{ trans('app.newPassword') }}:</div>
                                    <input type="password"  class="form-control" placeholder="*********" name="password" >
                                     @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="accountInput">
                                    <div class="h5">{{ trans('app.confirmPassword') }}:</div>
                                    <input type="password" class="form-control" placeholder="*********" name="password_confirmation" >
                                     @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-5">
                                <div class="submitBtn" style="margin:10px;">
                                    <input type="submit" value="{{ trans('app.edit') }}" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>

      </div>
    </section>
    
    
    <div class="modal fade" id="newUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width:800px!important">
        <div class="modal-content">
          <div class="modal-header">
            <div style="width:100%; height:auto; float:left; ">
                <div style="width:100%; height:auto; float:left;">
                    <div style="width:50%; height:auto; float:left">
                        <h2 class="modal-title" id="exampleModalLabel" style="padding:0; margin:0; text-align:left; font-weight:bold">{{ trans('app.addnewuser') }}</h2>
                    </div>
                    <div style="width:50%; height:auto; float:left">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>                                          
          </div>
          <div class="modal-body" style="padding:0">
            <div style="width:100%; height:auto; float:left; padding:0px;">
              <div class="row" style="margin:10px">
                    <form method="POST" action="{{ route('secretary.newuser') }}" enctype="multipart/form-data" id="tabs" style="width:100%;">
                	@csrf					
                  
                <table width="100%" border="0" class="table-bordered table">
                    <tr>
                        <td>কর দাতার নাম<span style="color:#ff0000; font-size:20px;">*</span></td>            
                        <td>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
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
                            <input id="spouse_name" type="text" class="form-control" name="spouse_name" value="{{ old('spouse_name') }}"> 
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
                            <input id="village" type="text" class="form-control" name="village" value="{{ old('village') }}"> 
                        </td>
                    </tr>
                   
                   <tr>
                        <td>পেশা</td>            
                        <td>
                            <input id="profession" type="text" class="form-control" name="profession" value="{{ old('profession') }}"> 
                        </td>
                    </tr>
                    
                    
                   <tr>
                        <td>এন আইডি নং</td>            
                        <td>
                            <input type="nid" class="form-control" name="nid" required> 
                        </td>
                    </tr> 
                    
                    <tr>
                        <td>হোল্ডিং নং</td>            
                        <td>
                            <input id="holding_no" type="text" class="form-control" name="holding_no"> 
                        </td>
                    </tr>
                    
                    <tr>
                        <td>জমির পরিমাণ</td>            
                        <td>
                            <input type="text" class="form-control" name="land"> 
                        </td>
                    </tr>
                    <tr>
                        <td>বসত বাড়ির ধরণ</td>            
                        <td>
                            <input type="text" class="form-control" name="house_type"> 
                        </td>
                    </tr>
                    <tr>
                        <td>বাৎসরিক কার্য কৃত কর</td>            
                        <td>
                            <input type="text" class="form-control" name="yearly_tax"> 
                        </td>
                    </tr>
                    <tr>
                        <td>অর্থ বছর</td>            
                        <td>
                            <input type="text" class="form-control" name="budget_year"> 
                        </td>
                    </tr>
                    <tr>
                        <td>মন্তব্য</td>            
                        <td>
                            <input type="text" class="form-control" name="remark"> 
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
@endsection

@section('footer')
    @parent
@endsection
