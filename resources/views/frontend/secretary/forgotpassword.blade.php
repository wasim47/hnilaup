   @include('layouts.header')
        <!-- Page Title -->
        <div class="page-title-container">
            <div class="container">
                <div class="row">
                    <div  style="text-align: center;" class="col-sm-12 wow fadeIn">
                       
                        <h1>Request for {{ trans('app.changePassword') }}</h1>                        
                  </div>
              </div>
            </div>
        </div>

        <!-- Contact Us -->
        <div class="contact-us-container">
		<div class="container">
	       <div class="row">
			<div class="col-md-1"></div>
				  <div class="col-md-10">
						<div class="wrapper">



							
                             <form class="form-signin" method="POST" action="{{ route('home.passwordrequest.submit') }}">
                       			 {{ csrf_field() }}       
								<h3 class="form-signin-heading">Send request for Password Change</h3>
						    <hr class="colorgraph"><br>							  
                                  
                                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								  	<input style="background-color:#fff;" type="text" class="form-control" name="email" placeholder="Enter your {{ trans('app.user') }}" 
                                    value="{{ old('email') }}" required autofocus />
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                	@endif
                                  </div>
                                 
                                  
                                  
                                    		  	 
								  <button class="btn btn-lg btn-primary btn-block"  name="submit" value="Login" type="submit">Send</button><br>
								  <div class="col-sm-6" style="padding-top:5px"><a href="{{ route('password.request') }}">Forgot password?</a></div>						  
							</form>	

                         

														
						</div>
				 </div>
				 <div class="col-md-1"></div>
				
	    </div>
        </div>

        @include('layouts.footer')