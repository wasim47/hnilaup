 @extends('admin.include.master') 
	@section('title') New Secretary User Entry - BD-ICU @endsection 
@section('content')

 
	<div class="layout-content" ng-app="appTable" ng-controller='ItemsController'>
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header" style="border:none">
                    <h3 class="page-title">Create New Secretary</h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>Settings</li>
                            <li class="active">New Secretary</li>
                            <li style="text-align:right; float:right">
                            	<a  href="{{ route('secretary.index') }}" style="color:#fff;"><i class="fa fa-list"></i> View Secretary List</a>
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
                            <form method="POST" action="{{ route('secretary.store') }}" enctype="multipart/form-data" id="tabs">
                        @csrf
						
                        <div class="col-sm-12">
                        			<div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('User Name') }}
                                        <span style="color:#ff0000; font-size:20px;">*</span></label>            
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="fullname" value="{{ old('fullname') }}" required placeholder="Ex: Mohammad Wasim">
                                            @if ($errors->has('fullname'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('fullname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Contact') }}</label>            
                                        <div class="col-md-6">
                                            <input id="contact" type="text" class="form-control" name="contact" value="{{ old('contact') }}" placeholder="Ex: 017XXXXXXXX"> 
                                            @if ($errors->has('contact'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('contact') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Email') }}</label>            
                                        <div class="col-md-6">
                                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                   
                                   <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Designation') }}</label>            
                                        <div class="col-md-6">
                                            <input id="designation" type="text" class="form-control" name="designation" value="{{ old('designation') }}"> 
                                        </div>
                                    </div>
                                    
                                    
                                   <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>            
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password"> 
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Address') }}</label>            
                                        <div class="col-md-6">
                                            <input id="address" type="text" class="form-control" name="address" placeholder="Ex: Mirpur-11, Dhaka"> 
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Photo') }}</label>            
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" name="photo"> 
                                        </div>
                                    </div>
                            </div>   
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form> 
                      </div>
                  </div>
                </div>  
              </div>
			</div>
        </div>
@endsection