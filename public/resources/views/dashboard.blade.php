@extends('layouts.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Credentials
        <small>manage credentials</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> admin</a></li>
        <li class="active"><a href="#">credentials</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-6">        
      <!-- Default box -->
      <div class="box">
        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {!! Form::open(['url' => '/upload', 'method' => 'post' , 'enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
              <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                             <div class="form-group">
                              <label for="firstname">First Name</label>
                              <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter first name">
                            </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                          <label for="middlename">Middle Name</label>
                          <input type="text" name="middlename" class="form-control" id="username" placeholder="Enter middle name">
                        </div>
                    </div>    
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="lastname">Last Name</label>
                          <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter last name">
                        </div>
                    </div>
                  </div>      

                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="role">Role</label>
                          <select name="role" class="form-control">
                              <option>Admin</option>
                              <option>Barangay Captain</option>
                          </select>
                        </div>
                    </div>
                </div>
               
                
                <div class="row">
                    <div class="col-md-6">
                           <div class="form-group">
                              <label for="latitude">Latitude</label>
                              <input type="text" name="latitude" class="form-control" id="latitude" placeholder="Enter latitude">
                            </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                          <label for="longitude">Longitude</label>
                          <input type="text" name="longitude" class="form-control" id="longitude" placeholder="Enter longitude">
                        </div>
                    </div>
                </div>

                
             
                <div class="form-group">
                  <label for="exampleInputFile">Profile Pic</label>
                  <input type="file"  name="photos[]" id="exampleInputFile">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
           {!! Form::close() !!}
      </div>
      <!-- /.box -->
     </div>
     <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-primary">8 New Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style="">
                  <ul class="users-list clearfix">
                    <li>
                      <img src="http://localhost/clearance/resources/assets/css/dist/img/user1-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander Pierce</a>
                      <span class="users-list-date">Today</span>
                    </li>
                    <li>
                      <img src="http://localhost/clearance/resources/assets/css/dist/img/user8-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                      <img src="http://localhost/clearance/resources/assets/css/dist/img/user7-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Jane</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="http://localhost/clearance/resources/assets/css/dist/img/user6-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">John</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="http://localhost/clearance/resources/assets/css/dist/img/user2-160x160.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander</a>
                      <span class="users-list-date">13 Jan</span>
                    </li>
                    <li>
                      <img src="http://localhost/clearance/resources/assets/css/dist/img/user5-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Sarah</a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                      <img src="http://localhost/clearance/resources/assets/css/dist/img/user4-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nora</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                    <li>
                      <img src="http://localhost/clearance/resources/assets/css/dist/img/user3-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nadia</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center" style="">
                  <a href="javascript:void(0)" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
     </div> 
    </section>
    <!-- /.content -->
  </div>
@endsection
