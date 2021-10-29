 @extends('admin.include.master') 
	@section('title') Edit [{{ $secretaryinfo->fullname }}] | Officer - BD-ICU @endsection 
@section('content')

 
	<div class="layout-content">
        <div class="layout-content-body">
          <!-- top tiles -->
          
          <div class="x_title">
                  <h2>Edit secretary</h2>
                 
                  <div class="clearfix"></div>
                </div>
          <div class="x_content">
          	{!! Form::model($secretaryinfo, ['route'=>['secretary.update', $secretaryinfo->id],'files' => true, 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                    {{ csrf_field() }}
                    
                    <div class="col-sm-12" id="firststep">
                          
                        <div class="col-sm-12">
                        			<div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('User Name') }}
                                        <span style="color:#ff0000; font-size:20px;">*</span></label>            
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="fullname" value="{{ $secretaryinfo->fullname }}" required placeholder="Ex: Mohammad Wasim">
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
                                            <input id="contact" type="text" class="form-control" name="contact" value="{{ $secretaryinfo->contact }}" placeholder="Ex: 017XXXXXXXX"> 
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
                                            <input id="email" type="text" class="form-control" name="email" value="{{ $secretaryinfo->email }}" placeholder="Enter Email" >
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
                                            <input id="designation" type="text" class="form-control" name="designation" value="{{ $secretaryinfo->designation }}"> 
                                        </div>
                                    </div>
                                    
                                    
                                   <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>            
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password" value="{{ $secretaryinfo->password_hints }}"> 
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
                                            <textarea class="form-control" name="address" placeholder="Ex: Mirpur-11, Dhaka">{{ $secretaryinfo->address }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Photo') }}</label>            
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" name="photo"> 
                                        </div>
                                    </div>
                            </div>
                        
                        <div class="col-sm-12">
                            <div class="col-md-6 pull-right">
                                <input type="submit" value="Update"  
                                style="background:#0071bb; padding:10px 30px; border:none; color:#fff; font-size:20px; box-shadow:#005995 0 0 2px 2px" />        
                            </div>
                        </div>                        
                        
                    </div>
                </form>
			</div>

    
    </div>
</div>
@endsection