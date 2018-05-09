@extends('layouts.app')
    
@section('content')
		<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Social Pension</h1>
                </div>
                <!-- /.col-lg-12 -->
        	<div class="row">
        		<div id="app">
                   <div class="col-md-12">
                    <socialpension-dataviewer source="/clearance/api/resident/socialpension/viewdata" ></socialpension-dataviewer>
                    </div>
        		</div>
        	</div> 
        </div>
@endsection
