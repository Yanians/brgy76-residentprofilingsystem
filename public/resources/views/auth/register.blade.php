@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (Session::has('register_success'))
            <div class="alert alert-info">{{ Session::get('register_success') }}</div>
        @endif
        
      <img src="resources/assets/img/logo.png" style="width:100px;display: block;margin:50px auto;">
        <div class="col-md-8 col-md-offset-2"  style="margin-top:10px;">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text    " class="form-control" name="firstname" value="{{ old('firstname') }}"  autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="middlename" class="col-md-4 control-label">Middle Name</label>

                            <div class="col-md-6">
                                <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename') }}"  autofocus>
                            </div>
                        </div>

                           <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}"  autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                            <label for="age" class="col-md-4 control-label">Age</label>

                            <div class="col-md-6">
                                <input id="age" type="text" class="form-control" name="age" value="{{ old('age') }}"  autofocus>

                                @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('bday') ? ' has-error' : '' }}">
                            <label for="bday" class="col-md-4 control-label">Birthday</label>

                            <div class="col-md-6">
                                <input id="bday" type="date" class="form-control" name="bday" value="{{ old('bday') }}"  autofocus>

                                @if ($errors->has('bday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                         <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-md-4 control-label">Gender</label>
                                <div class="col-md-6">
                                    <select name="gender" class="form-control">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status" class="col-md-4 control-label">Status</label>
                                <div class="col-md-6">
                                    <select name="status" class="form-control">
                                        <option>Single</option>
                                        <option>Married</option>
                                        <option>Widowed</option>
                                        <option>Devorced</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('citizenship') ? ' has-error' : '' }}">
                                <label for="citizenship" class="col-md-4 control-label">Citizenship</label>

                                <div class="col-md-6">
                                    <input id="citizenship" type="text" class="form-control" name="citizenship" value="{{ old('citizenship') }}"  autofocus>

                                    @if ($errors->has('citizenship'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('citizenship') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                              <div class="form-group{{ $errors->has('contactnumber') ? ' has-error' : '' }}">
                                <label for="contactnumber" class="col-md-4 control-label">Contact Number</label>

                                <div class="col-md-6">
                                    <input id="contactnumber" type="text" class="form-control" name="contactnumber" value="{{ old('contactnumber') }}"  autofocus>

                                    @if ($errors->has('contactnumber'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('contactnumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group{{ $errors->has('presentaddress') ? ' has-error' : '' }}">
                                <label for="presentaddress" class="col-md-4 control-label">Present Address</label>

                                <div class="col-md-6">
                                    <input id="presentaddress" type="text" class="form-control" name="presentaddress" value="{{ old('presentaddress') }}"  autofocus>

                                    @if ($errors->has('presentaddress'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('presentaddress') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                                 <div class="form-group{{ $errors->has('placeofbirth') ? ' has-error' : '' }}">
                                <label for="presentaddress" class="col-md-4 control-label">place of birth</label>

                                <div class="col-md-6">
                                    <input id="placeofbirth" type="text" class="form-control" name="placeofbirth" value="{{ old('placeofbirth') }}"  autofocus>

                                    @if ($errors->has('placeofbirth'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('placeofbirth') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group{{ $errors->has('provincialaddress') ? ' has-error' : '' }}">
                                <label for="provincialaddress" class="col-md-4 control-label">Provincial Address</label>

                                <div class="col-md-6">
                                    <input id="provincialaddress" type="text" class="form-control" name="provincialaddress" value="{{ old('provincialaddress') }}"  autofocus>

                                    @if ($errors->has('provincialaddress'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('provincialaddress') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" >

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-primary" value="Register">
                                    
                                    <a class="btn btn-primary" href="{{ route('login') }}">
                                    Login
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript">
     function initGeolocation()
     {
        if( navigator.geolocation )
        {
           // Call getCurrentPosition with success and failure callbacks
           navigator.geolocation.getCurrentPosition( success, fail );
        }
        else
        {
           alert("Sorry, your browser does not support geolocation services.");
        }
     }

     function success(position)
     {
        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);
     }

     function fail()
     {
           // alert("Sorry, unaible to fetch current location.");
        
     }
     initGeolocation();
   </script>   
@endsection
