@extends('layouts.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Users
        <small>manage users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> admin</a></li>
        <li class="active"><a href="#">users</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <a href="{{url('/admin/credentials')}}" class="btn btn-success btn-flat pull-right"> Add New</a>
        <br style="clear: both;"> 
        <hr>

      <?php if (!empty($listusers)): ?>
        <div class="box">
            <div class="box-header">
                <?php if (Auth::user()->role == 'Staff'): ?>
                        Listing Purok Leaders
                <?php else: ?>
                        
                <?php endif ?>  
            </div>
            <div class="box-body">
                 <table class="table table-hover dt1" id="DataTable">
                    <thead>
                      <th>First Name</th> <th>Middle Name</th><th> Last Name</th> <th> Email </th> <th> Username </th>
                    </thead>
                    <tbody>
                    <?php foreach ($listusers as $l): ?>
                        <tr>
                          <td>{{ $l->firstname}}</td>
                          <td>{{ $l->middlename}}</td>
                          <td>{{ $l->lastname}}</td>
                          <td>{{ $l->email}} </td>
                          <td>{{ $l->username}} </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                  </table>
            </div>
        </div>
      <?php endif ?>
   
    </section>
    <!-- /.content -->
  </div>
@endsection
