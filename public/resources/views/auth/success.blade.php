@extends('layouts.app')
 
@section('content')
    <div class="container">
        <div class="row">
            <br>    
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-info">
                    Success! You have successfully registered , click <a href="{!! url('/login') !!}" class="btn btn-md btn-success">Login</a> to continue   

                </div>
            </div>
        </div>
    </div>
@endsection