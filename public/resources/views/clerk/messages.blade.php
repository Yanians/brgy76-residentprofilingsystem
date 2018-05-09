@extends('layouts.master')
    
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
          <h1>
            Messages
            <small>manage messages</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> clerk</a></li>
            <li class="active"><a href="#">messages</a></li>
          </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <input type="hidden" id="userid" value="{{Auth::user()->id}}">
        <div id="app">
          <div class="row">
             <message-room></message-room>
          </div>
        </div>
    </section>
  </div>  
@endsection

  