@extends('layouts.app')

@section('content')
	<section id="breadcrumbs" class="breadcrumbs">
          <div class="container">
    
            <div class="d-flex justify-content-between align-items-center">
              <h2>Reset Password</h2>
              <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Reset Password</li>
              </ol>
            </div>
    
          </div>
        </section>
        
    <section id="about" class="about">
	<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 padding_0">
          
          <div class="loginarea" id="signinarea">
            <div class="col-sm-5" style="margin:0; padding:0">
                <div class="loginLeftArea"  style="height:60%">
                  <h2 class="p-0">Reset Password</h2>
                      <p>Please enter New password</p>
                  </div>
              </div>
            <div class="col-sm-7" style="margin:0; padding:0">
                 @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif
                  <div class="loginRightArea">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('hospital.resetpassowrd') }}">
                  {{ csrf_field() }}
      <input id="currids" type="hidden" class="form-control" name="currids" value="{{ $getCurIds }}">

      <div class="form-group">
                      <div class="col-md-12">
          <div class="form-group">
                                 <label for="username" class="col-sm-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email }}" required autofocus readonly="readonly">
                                <span>Enter Valid {{ trans('app.user') }}.</span>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-md-12">
          <div class="form-group">
                                 <label for="password" class="col-sm-12">
                                 <input id="password" type="password" class="form-control" name="password" required>
                                <span>{{ trans('app.newPassword') }}</span>
                              </label>

                               @if ($errors->has('password'))
                                      <span class="help-block" style="color:#f00">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-md-12 p-0">
          <div class="form-group">
                                 <label for="password-confirm" class="col-sm-12">
                               <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <span>{{ trans('app.confirmPassword') }}</span>
                              </label>

                               @if ($errors->has('password_confirmation'))
                                  <span class="help-block" style="color:#f00">
                                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                  </div>


                  <div class="form-group">
                      <div class="col-md-8 col-md-offset-2">
                          <button type="submit" class="addToCart">
                              Reset Password
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
	</section>
@endsection
