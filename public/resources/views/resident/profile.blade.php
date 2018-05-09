@extends('layouts.app')
    
@section('content')
	
	<br style="margin-top: 10px;">
     <div class="panel panel-primary">
          <div class="panel-body">
              <img src="<?php echo asset("resources/assets/img/logo.png");?>" class="profile-logo-header" alt="Logo">
              <h1 class="profile-location-text">{{Auth::user()->presentaddress}}</h1>
          </div>
      </div>

	<div class="row">
        <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            My Profile
                        </div>
                        <div class="panel-body">
                            <?php if (Auth::user()->profilepic): ?>
                              <img src="<?php echo asset("storage/app/".Auth::user()->profilepic."");?>" alt="User Image" class="img-circle user-profile-100 center">
                            <?php else : ?>
                              <img src="<?php echo asset("storage/app/photos/default.png");?>"  class="img-circle center user-profile-100" alt="User Image">
                            <?php endif ?>
                              <h2>{{Auth::user()->firstname.' '.Auth::user()->middlename.' '.Auth::user()->lastname}}</h2>
                              <p> Age : <strong>{{Auth::user()->age}}</strong>   </p>
                              <p> Address : <strong>{{Auth::user()->presentaddress}}</strong>   </p>
                              <p> Contact : <strong>{{Auth::user()->contactnumber}}</strong>   </p>
                              <p> Cevil Status : <strong>{{Auth::user()->status}}</strong>   </p>
                              <p> Cetizenship : <strong>{{Auth::user()->citizenship}}</strong>   </p>
                        </div>
                        <div class="panel-footer">
                        </div>
                    </div>

        </div>
        <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Navigations
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#residents" data-toggle="tab" aria-expanded="true">Residents</a>
                                </li>
                                <li class=""><a href="#purokleaders" data-toggle="tab" aria-expanded="false">Purok leaders</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="residents">
                                    <div class="panel panel-primary">
                                        <div class="panel-body">
                                         <div id="residents-wrapper"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="purokleaders">
                                     <div class="panel panel-primary">
                                         <div class="panel-body">
                                           <div id="purokleaders-wrapper"></div>
                                         </div>
                                     </div> 
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
          
		    </div>
    </div>

            
@endsection
