@extends('layouts.app')
    
@section('content')
		<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Request Certificate</h1>
                </div>
                <!-- /.col-lg-12 -->
				<div id="app">
					   <div class="col-md-12">
                      		  <certification-dataviewer source="/clearance/api/resident/certification/viewdata" ></certification-dataviewer>
                        </div>
				</div>
        </div>
@endsection
