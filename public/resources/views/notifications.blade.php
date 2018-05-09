@extends('layouts.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Notifications
        <small>manage notifications</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> admin</a></li>
        <li class="active"><a href="#">notifications</a></li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">

          <div class="panel panel-primary">
            <div class="panel-heading">Clearance Requests ({{$clearance_count}})</div>
            <div class="panel-body">
                 <table class="table dt1">
                    <thead>
                      <tr>
                        <th>User</th><th>Photo</th><th>Type</th><th>Year</th><th>Purpose</th><th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($clearance as $c)
                        <tr>
                          <td>{{App\User::find($c->user_id)->firstname}}</td>
                          <td> <img src="<?php echo asset('storage/app/'.$c->photo);?>" class="img-circle" width="50" height="50"></td>
                          <td>{{$c->type}}</td>
                          <td>{{$c->year}}</td>
                          <td>{{$c->purpose}}</td>
                          <td>
                            @if ($c->status == 'approved')
                                <a class="btn btn-md btn-danger" href="{{URL('admin/clearance/approval/'.$c->id.'/reject') }}">Reject</a>
                            @elseif($c->status == 'reject')
                                <a class="btn btn-md btn-success" href="{{URL('admin/clearance/approval/'.$c->id.'/approved') }}">Approve</a>
                            @else
                                 <a class="btn btn-md btn-danger" href="{{URL('admin/clearance/approval/'.$c->id.'/reject') }}">Reject</a>
                                    <a class="btn btn-md btn-success" href="{{URL('admin/clearance/approval/'.$c->id.'/approved') }}">Approve</a>
                            @endif

                           <a class="btn btn-md btn-info" onclick="viewclearance({{$c->id}})">More details</a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>
        


 

          <div class="panel panel-primary">
          <div class="panel-heading">Businesspermit Requests ({{$businesspermit_count}})</div>
          <div class="panel-body">
          <table class="table dt2">
            <thead>
              <tr>
                <th>User</th><th>Business Name</th><th>Business Address</th><th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($businesspermit as $c)
                <tr>
                  <td>{{App\User::find($c->user_id)->firstname}}</td>
                  <td>{{$c->businessname}}</td>
                  <td>{{$c->businessaddress}}</td>
                  <td>
                    @if ($c->approval_status == 'approved')
                        <a class="btn btn-md btn-danger" href="{{URL('admin/businesspermit/approval/'.$c->id.'/reject') }}">Reject</a>
                    @elseif($c->approval_status == 'reject')
                        <a class="btn btn-md btn-success" href="{{URL('admin/businesspermit/approval/'.$c->id.'/approved') }}">Approve</a>
                    @else
                         <a class="btn btn-md btn-danger" href="{{URL('admin/businesspermit/approval/'.$c->id.'/reject') }}">Reject</a>
                            <a class="btn btn-md btn-success" href="{{URL('admin/businesspermit/approval/'.$c->id.'/approved') }}">Approve</a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
         </div>
       </div>
            

          <div class="panel panel-primary">
          <div class="panel-heading">Certification Requests ({{$certification_count}})</div>
          <div class="panel-body">
          <table class="table dt3">
            <thead>
              <tr>
                <th>User</th><th>Name of child</th><th>Date of birth</th><th>Place of birth</th><th>Name of hospital</th><th>Name of mother</th><th>Name of father</th> <th>Address</th><th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($certification as $c)
                <tr>
                  <td>{{App\User::find($c->user_id)->firstname}}</td>
                  <td>{{$c->nameofchild}}</td>
                  <td>{{$c->dateofbirth}}</td>
                  <td>{{$c->placeofbirth}}</td>
                  <td>{{$c->nameofhospital}}</td>
                  <td>{{$c->nameofmother}}</td>
                  <td>{{$c->nameoffather}}</td>
                  <td>{{$c->address}}</td>
                  <td>
                    @if ($c->status == 'approved')
                        <a class="btn btn-md btn-danger" href="{{URL('admin/certification/approval/'.$c->id.'/reject') }}">Reject</a>
                    @elseif($c->status == 'reject')
                        <a class="btn btn-md btn-success" href="{{URL('admin/certification/approval/'.$c->id.'/approved') }}">Approve</a>
                    @else
                         <a class="btn btn-md btn-danger" href="{{URL('admin/certification/approval/'.$c->id.'/reject') }}">Reject</a>
                            <a class="btn btn-md btn-success" href="{{URL('admin/certification/approval/'.$c->id.'/approved') }}">Approve</a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        </div>
        

          <div class="panel panel-primary">
          <div class="panel-heading">Social Pension Requests ({{$socialpension_count}})</div>
          <div class="panel-body">
          <table class="table dt4">
            <thead>
              <tr>
                <th>User</th><th>Date of birth</th><th>Address</th><th>Purpose</th><th>yearresident</th><th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($socialpension as $c)
                <tr>
                  <td>{{App\User::find($c->user_id)->firstname}}</td>
                  <td>{{$c->dateofbirth}}</td>
                  <td>{{$c->address}}</td>
                  <td>{{$c->purpose}}</td>
                  <td>{{$c->yearresident}}</td>
                  <td>
                    @if ($c->approval_status == 'approved')
                        <a class="btn btn-md btn-danger" href="{{URL('admin/socialpension/approval/'.$c->id.'/reject') }}">Reject</a>
                    @elseif($c->approval_status == 'reject')
                        <a class="btn btn-md btn-success" href="{{URL('admin/socialpension/approval/'.$c->id.'/approved') }}">Approve</a>
                    @else
                         <a class="btn btn-md btn-danger" href="{{URL('admin/socialpension/approval/'.$c->id.'/reject') }}">Reject</a>
                            <a class="btn btn-md btn-success" href="{{URL('admin/socialpension/approval/'.$c->id.'/approved') }}">Approve</a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>


    <!-- clearance Detail Modal  -->
  <div class="modal fade" id="clearanceDetailModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Viewing more detail</h4>
        </div>
        <div class="modal-body">
            <div id="data-clearance-detail"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
@endsection
