@extends('layouts.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
        <small>Update Profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> admin</a></li>
        <li class="active"><a href="#">profile</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-6">        
      <!-- Default box -->
      <div class="box">
        @if(Session::has('msg'))
         <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-success"></i> Success</h4>
                    {{Session::get('msg')}}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                         <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
            </div>
        @endif
        {!! Form::open(['url' => '/editprofile', 'method' => 'post' , 'enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
              <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                              <input type="hidden" name="id" class="form-control" value="{{ Auth::user()->id }}" >

                             <div class="form-group">
                              <label for="firstname">First Name</label>
                              <input type="text" name="firstname" class="form-control" value="{{ Auth::user()->firstname }}" id="firstname" placeholder="Enter first name">
                            </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                          <label for="middlename">Middle Name</label>
                          <input type="text" name="middlename" class="form-control" value="{{ Auth::user()->middlename }}" id="username" placeholder="Enter middle name">
                        </div>
                    </div>    
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="lastname">Last Name</label>
                          <input type="text" name="lastname" class="form-control" id="lastname" value="{{ Auth::user()->lastname }}" placeholder="Enter last name">
                        </div>
                    </div>
                  </div>      

                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" id="username" value="{{ Auth::user()->username }}" placeholder="Enter username">
                </div>
                <div class="form-group">
                  <label for="password">Password <small> (Leave blank if dont want to update)</small></label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}" id="email" placeholder="Enter email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Profile Pic <small>(Leave blank if dont want to update)</small></label>
                  <input type="file"  name="photos[]">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update profile</button>
              </div>
           {!! Form::close() !!}
       </div>
      <!-- /.box -->
     </div>
    
     </div> 
    </section>
    <!-- /.content -->
  </div>
@endsection
