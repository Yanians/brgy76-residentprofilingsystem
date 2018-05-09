@extends('layouts.app')
  
@section('content')
	<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Barangay Clearance</h1>
            </div>
	<div class="col-md-4">
        <div class="panel panel-primary">
        <div class="panel-heading">
          <h4>Request For Barangay Clearance</h4>
        </div>
        @if (Session::has('msg_success'))
        	        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-success"></i> Success!</h4>
                              {{Session::get('msg_success')}}  
                    </div>
        @endif
        @if (Session::has('msg_err'))
        	  <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Warning!</h4>
                              {{Session::get('msg_err')}}  
                    </div>
        @endif
         @if (count($errors) > 0)
                    <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                 <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                    </div>
        @endif
        <div class="panel-body">

        {!! Form::open(['url' => 'resident/clearance/save', 'method' => 'post' , 'enctype' => 'multipart/form-data']) !!}
                {{ csrf_field() }}
            <label for=""> <p>Type of Residency : </p> </label>
            <div class="form-group">
                <input type="text" class="form-control" name="type">
            </div>

            <div class="form-group">
            <label for=""> <p>Years of Residency : </p> </label>

                <select name="year" class="form-control select2">
                       <option value=""></option>

                @for ($i = 1; $i <= 300 ; $i++)
                        @if ($i == 1)
                       <option value="{{$i}}">{{$i.' Year'}}</option>
                        @else
                       <option value="{{$i}}">{{$i.' Years'}}</option>
                        @endif
                @endfor
                </select>
            </div>
            <div class="form-group">
              <label for=""> <p>Purpose : </p> </label>
              <div class="form-group">
                 <textarea name="purpose" class="form-control" cols="30" rows="10"></textarea>
              </div>
            </div>

        		<div class="form-group">
            <label for=""> <p>Attach 2 x 2 image : </p> </label>
        			<input type="file" name="photos[]" class="form-control">
        			<input type="hidden" name="userid" value="{{Auth::user()->id}}">
        		</div>
            
            <div class="form-group">
                <label for=""> <p>Name of purok leader : </p> </label>
                <select name="purokleader_id" class="form-control select2">
                     @foreach ($pl as $p)
                       <option value="{{$p->id}}">{{$p->firstname.' '.$p->middlename.' '.$p->lastname.' - '.$p->presentaddress}}</option>
                     @endforeach 
                </select>
            </div>

        		<div class="form-group">
        		<input type="submit" value="submit" class="btn btn-primary">
        		</div>
           {!! Form::close() !!}     
    </div>
    </div>
    </div>

    <div class="col-md-8">
    <div class="panel panel-primary">
          <div class="panel-heading">
              listing Requests
          </div>
          <div class="panel-body">
                         <table class="table ClearanceTble">
                                  <thead><tr>
                                      <th>Photo Requirement</th>
                                      <th>Purpose</th>
                                      <th>Years of Residency</th> 
                                      <th>Date Submitted</th>
                                      <th>Actions</th>
                                  </tr></thead>
                                  <tbody>
                                          @foreach ($cl as $c)
                                          <tr>
                                               <td>
                                                  <?php if ($c->photo): ?>
                                                      <img src="<?php echo asset('storage/app/'.$c->photo);?>" alt="User Image" class="img-circle user-profile-50 center">
                                                  <?php endif ?>
                                               </td>
                                               <td>{{ $c->purpose}}</td>
                                               <td>{{ $c->year}}</td>
                                               <td>{{ $c->created_at}}</td>
                                               <td><button onclick="deleteClearance({{$c->id}})" class="btn btn-sm btn-danger"><i class=" fa  fa-trash-o"></i></button> <button onclick="viewClearance({{$c->id}})" class="btn btn-sm btn-primary"> <i class="fa  fa-eye"> </i></button></td>
                                          </tr>
                                              
                                          @endforeach

                                  </tbody>
                        </table>           
            </div>
       </div>
     </div>

    </div>




        <!-- Modal Blotter notice -->
            <div id="clearanceModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                          <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Viewing Clearance Request Status</h4>
                          </div>
                          <div class="modal-body">
                          <form method="POST" id="viewNotice">
                                <div class="clearance-request-wrapper"></div>
                          </div>
                          <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                  </div>
                </div>

              </div>
            </div>



@endsection
