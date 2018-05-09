@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <img src="resources/assets/img/logo.png" style="width:100px;display: block;margin:50px auto;">

        <div class="col-md-4 col-md-offset-4"  style="margin-top:10px;">
            <div class="panel panel-default" style="padding:15px;">
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                           <h3 class="text-center">Log in to your account</h3> 
                           <hr>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
       

                             <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="username" type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}"  autofocus>
                            </div>
                           @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
               
 
                           <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" placeholder="Password" class="form-control" name="password" >
                            </div>
                                 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                      
                                <button type="submit" class="btn btn-block btn-primary">
                                    Login
                                </button>
                              <hr>   
                              <p style="text-align: center;">
                               New to Barangay Clearance?  <a href="{{ route('register') }}">
                                    Sign up
                                </a>   
                              </p>  

                        </div>
                    </form>

                </div>
            </div>
                    <a class="btn btn-link pull-right" style="color:#fff;" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
        </div>
        </div>
    </div>
@endsection
