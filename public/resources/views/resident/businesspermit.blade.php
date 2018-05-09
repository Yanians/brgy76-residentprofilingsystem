@extends('layouts.app')
    
@section('content')
		<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Business Permit</h1>
                </div>
                <!-- /.col-lg-12 -->
        </div>
        <div id="app">
            <businesspermit-dataviewer source="/clearance/api/resident/businesspermit/viewdata"></businesspermit-dataviewer>     
        </div>   

@endsection
	