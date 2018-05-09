@extends('layouts.master')
    
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registered Residents
        <small>manage residents</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> admin</a></li>
        <li class="active"><a href="#">residents</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
         <?php if (!empty($user)): ?>
        <div class="box">
            <div class="box-header">
                <?php if (Auth::user()->role == 'Staff'): ?>
                        Listing Residents
                <?php else: ?>
                        
                <?php endif ?>  
            </div>
            <div class="box-body">
                 <table class="table table-hover dt1" id="DataTable">
                    <thead>
                      <th>First Name</th> <th>Middle Name</th><th> Last Name</th> <th> Email </th> <th> Username </th>
                    </thead>
                    <tbody>
                    <?php foreach ($user  as $l): ?>
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
  </div>  
@endsection
