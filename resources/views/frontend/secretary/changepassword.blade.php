@extends('frontend.customer.layouts.app')																																																																			

@section('title', Auth::guard('customer')->user()->fullname)

@section('sidebar')
    @parent
@endsection

@section('content')																																													
<div class="dashboardArea secPdngB animated">
        <div class="container">
            <div class="row">               
                <div class="col-md-12">
                    <div class="boardTitle">
                        <h2 style="margin:20px 0;">{{ trans('app.changePassword') }}</h2>
                    </div>
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form action="{{ route('customer.passwordupdate') }}" method="post" role="form">
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
                                    <input type="password"  class="form-control" placeholder="*********" name="password">
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
                                    <input type="password" class="form-control" placeholder="*********" name="password_confirmation">
                                     @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-5">
                                <div class="submitBtn" style="margin:10px;">
                                    <input type="submit" value="{{ trans('app.edit') }} Password" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
