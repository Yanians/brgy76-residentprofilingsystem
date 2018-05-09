@extends('layouts.master')
    
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purok Leaders
        <small>manage purok leaders</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> admin</a></li>
        <li class="active"><a href="#">Purok Leaders</a></li>
      </ol>
    </section>
        <!-- Main content -->
    <section class="content">

<div class="purokleader-wrapper">
<div class="row">

<div class="col-md-12" style="margin-top: 50px;">
     <button class="btn btn-flat btn-primary btn-sm pull-right" onclick="addNewPurokLeader()"><i class="fa fa-user-plus" aria-hidden="true"></i> Add New Purok Leader</button>
     <br class="clear-fix">
     <br class="clear-fix">

     <div class="panel panel-primary"> <div class="panel-heading"> <h3 class="panel-title">Listing Purok Leaders</h3> </div> 
     <div class="panel-body"> 
     <table class="table purokTable" >
        <thead>
          <tr><th>Profile</th><th>Full Name</th><th>Date Added</th><th>Location</th><th>Actions</th></tr>
        </thead>
        <tbody>
          @foreach ($pl as $p)
              <tr>
                  <td>
                        <?php if (!empty($p->profilepic)): ?>
                          <img src="<?php echo asset("storage/app/".$p->profilepic."");?>" class="user-image" style="width:50px;height:50px;" alt="User Image">
                        <?php else : ?>
                          <img src="<?php echo asset("storage/app/photos/default.png");?>" class="user-image" style="width:50px;height:50px;"  alt="User Image">
                        <?php endif ?>

                  </td>
                  <td>{{ $p->firstname.' '.$p->middlename.' '.$p->lastname}}</td>
                  <td>{{ $p->created_at}}</td>
                  <td>{{$p->presentaddress}}</td>
                  <td>{{-- <a href="#" class="btn btn-flat btn-success" onclick="viewLocation({{ $p->latitude.','.$p->longitude }})"><i class="fa fa-location-arrow" aria-hidden="true"></i> View Location</a>  --}}<a href="#" class="btn btn-flat btn-primary" onclick="editPurokleader('{{$p->id}}')"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a> <a href="#" class="btn btn-flat btn-danger" onclick="deletPurokLeader('{{$p->id}}')"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
  </div>
</div>

 <div id="map" class="col-md-12" style="width:100%;height:650px;position:fixed;"></div>
 </section>
  </div>  
  
  <!-- Modal Blotter notice -->
    <div id="addPurokLeaderModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Purok Leader</h4>
          </div>
          <div class="modal-body">
        <form method="POST" id="addPurokleader">
                 
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
                              <label for="latitude">Latitude</label>
                              <input type="text" name="latitude" value="{{ old('latitude') }}" class="form-control" id="latitude" placeholder="Enter latitude">
                            </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                          <label for="longitude">Longitude</label>
                          <input type="text" name="longitude" value="{{ old('longitude') }}" class="form-control" id="longitude" placeholder="Enter longitude">
                        </div>
                    </div>
                </div>

              </div>
          </div>
          <div class="modal-footer">
              <button type="submit" name="submit" class="btn btn-success">Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
          </div>
        </div>

      </div>
    </div>



    <!-- Modal Blotter notice -->
    <div id="editPurokLeaderModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Purok Leader</h4>
          </div>
          <div class="modal-body">
        <form method="POST" id="editPurokleader">
                    <input type="hidden" name="edit_purok_id" id="edit_purok_id">
                     <div class="row">
                    <div class="col-md-4">
                             <div class="form-group">
                              <label for="firstname">First Name</label>
                              <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}" id="edit_firstname" placeholder="Enter first name">
                            </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                          <label for="middlename">Middle Name</label>
                          <input type="text" name="middlename" class="form-control" value="{{ old('middlename') }}" id="edit_middlename" placeholder="Enter middle name">
                        </div>
                    </div>    
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="lastname">Last Name</label>
                          <input type="text" name="lastname" class="form-control" id="edit_lastname" value="{{ old('lastname') }}" placeholder="Enter last name">
                        </div>
                    </div>
                  </div>      

                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" id="edit_username" value="{{ old('username') }}" placeholder="Enter username">
                </div>
                <div class="form-group">
                  <label for="password">Password (Leave blank if you dont want to update)</label>
                  <input type="password" name="password" class="form-control" id="edit_password" placeholder="Password">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="text" name="email" class="form-control" value="{{ old('email') }}" id="edit_email" placeholder="Enter email">
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
                              <label for="latitude">Address</label>
                              <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="edit_address" placeholder="Enter Address">
                            </div>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
              <button type="submit" name="submit" class="btn btn-success">Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
          </div>
        </div>

      </div>
    </div>




 <script src="https://maps.google.com/maps/api/js?key=AIzaSyCMwT4MxXMtf42ycnlusXGTINrjWT1-15A"></script>
 <script src="https://www.bunnyradar.com/assets/admin/js/oms.min.js"></script>  

@endsection
