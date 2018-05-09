@extends('layouts.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <?php if (Auth::user()->role == 'Staff'): ?>
      
    <?php endif ?>
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
        {!! Form::open(['url' => '/upload', 'method' => 'post' , 'enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
              <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                             <div class="form-group">
                              <label for="firstname">First Name</label>
                              <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}" id="firstname" placeholder="Enter first name">
                            </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                          <label for="middlename">Middle Name</label>
                          <input type="text" name="middlename" class="form-control" value="{{ old('middlename') }}" id="username" placeholder="Enter middle name">
                        </div>
                    </div>    
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="lastname">Last Name</label>
                          <input type="text" name="lastname" class="form-control" id="lastname" value="{{ old('lastname') }}" placeholder="Enter last name">
                        </div>
                    </div>
                  </div>      

                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}" placeholder="Enter username">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="text" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="role">Role</label>
                          <select name="role" class="form-control" value="{{ old('role') }}">
                              <?php if (Auth::user()->role == 'Barangay Captain'): ?>
                                   <option>Admin</option>
                                   <option>Barangay Captain</option>
                              <?php elseif (Auth::user()->role == 'Admin'): ?>
                                    <option>Staff</option>
                                    <option>Clerk</option>
                              <?php elseif (Auth::user()->role == 'Staff'): ?>
                                    <option>Purok leader</option>
                              <?php endif ?>
                             
                          </select>
                        </div>
                    </div>
                </div>
               
                
                <div class="row">
                    <div class="col-md-6">
                           <div class="form-group">
                              <label>Address</label>
                              <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Enter Address">
                            </div>
                    </div>
                </div>

                
             
                <div class="form-group">
                  <label for="exampleInputFile">Profile Pic <small>(Leave blank if no picture)</small></label>
                  <input type="file"  name="photos[]">
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
                    <span class="label label-primary"> {{count($users)}} New Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style="">
                  <ul class="users-list clearfix">
                      <?php foreach ($users as $user): ?>
                    <li>
                          <?php if ($user->profilepic): ?>
                            <img src="<?php echo asset("storage/app/$user->profilepic");?>" style="width:50px;height:50px;">
                          <?php else : ?>
                            <img src="<?php echo asset("storage/app/photos/default.png");?>" style="width:50px;height:50px;">
                          <?php endif ?>
                            <a class="users-list-name" href="#">{{ $user->firstname.' '.$user->middlename.' '.$user->lastname }}</a>
                            <span class="users-list-date">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans()  }}</span>
                    </li>
                            
                      <?php endforeach ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center" style="">
                  <a href="{{url('/admin/listusers')}}" class="uppercase">View All Users</a>
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
