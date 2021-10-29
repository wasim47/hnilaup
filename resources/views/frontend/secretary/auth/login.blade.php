@extends('layouts.app')

@section('title', 'ToonBD')

@section('sidebar')
    @parent
@endsection

@section('content') 
	                    
     <main id="main">
        
    
        <section id="about" class="inner-page pt-4">
          <div class="container">
            	<form class="form-horizontal" method="POST" action="{{ route('secretary.login') }}">
                                {{ csrf_field() }}
                                
                                @if (session('message'))
                                @if (session('message')=="success")
                                    <div class="alert alert-success">
                                        Successfully Login
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                       Login Failed
                                    </div>
                                @endif
                            @endif
                            
                              <div class="col-lg-4 offset-4">
                            		<div class="row">                                    	
                              			<h4 style="margin:20px 10px;">Login</h4>                                    
                                        <div class="col-lg-12">
                                        	<div class="form-group">
                                            	<input type="text" class="form-control"  placeholder="Email" name="username" value="{{ old('username') }}" required>  
                                            </div>  
                                        </div>
                                        <div class="col-lg-12">
                                        	<div class="form-group">
                                           	<input type="password" name="password" class="form-control" placeholder="Password">
                                           </div>
                                        </div>
                                    </div>
                                    
                                	<div class="row">
                                        <div class="col-sm-6">
                                            <button class="btn btn-success" type="submit">Login</button>
                                        </div>
                                        <div class="col-sm-6">
                                           <div class="col-sm-12"> <input type="checkbox"  name="remember" id="remember"> Keep login</div>
                                        </div>
                                        <div class="col-sm-12">
                                        <div class="form-group"><a href="{{ route('secretary.forgotpassword') }}" style="color:#333"> Forgot password ?</a></div></div>
                                    </div>  
                              </div>
                         </form>
          </div>
        </section>
  </main> 
            
@endsection


@section('footer')
    @parent
@endsection


