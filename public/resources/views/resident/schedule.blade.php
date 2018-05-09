@extends('layouts.app')
    
@section('content')
		<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Schedule of Claims</h1>
                </div>
                  <div id="app">
				   <div class="col-md-12">
		          	  <schedule-dataviewer source="/clearance/api/resident/schedule/viewdata"></schedule-dataviewer>     
		            </div>
		          </div> 
    	</div>
@endsection
