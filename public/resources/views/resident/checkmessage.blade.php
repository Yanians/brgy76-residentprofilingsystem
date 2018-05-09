@extends('layouts.app')
    
@section('content')
		<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Messages</h1>
                </div>
                <!-- /.col-lg-12 -->
            <div class="row">
        		<div id="app">
        			<div class="col-md-12">
        				<message-room></message-room>
        			</div>
        		</div>
            </div>    
        </div>
@endsection
