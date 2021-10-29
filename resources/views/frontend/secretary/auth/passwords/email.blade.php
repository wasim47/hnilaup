@extends('layouts.app')

@section('content')
<section id="breadcrumbs" class="breadcrumbs">
          <div class="container">
    
            <div class="d-flex justify-content-between align-items-center">
              <h2>Reset Password</h2>
              <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Forgot Password</li>
              </ol>
            </div>
    
          </div>
        </section>
        
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-9 offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if (session('message'))
                                <div class="alert alert-danger">
                                    {{ session('message') }}
                                </div>
                            @endif
        
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('hospital.passemail') }}">
                                {{ csrf_field() }}
        
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Send Password Reset Link
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
@endsection
