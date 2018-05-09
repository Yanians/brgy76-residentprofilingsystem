@extends('layouts.master')
    
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Schedules
        <small>manage schedules</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> staff</a></li>
        <li class="active"><a href="#">schedules</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
              <div class="col-md-4">
                <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h4>Add New Schedule Form</h4>
                      </div>
                       <div class="panel-body">
                      {!! Form::open(['url' => 'staff/schedule/save', 'method' => 'post']) !!}
                      {{ csrf_field() }}
                      <label for=""> <p>Date scheduled : </p> </label>
                      <div class="form-group">
                          <input type="datetime-local" class="form-control" name="datescheduled">
                      </div>
                      <label for=""> <p>Claim : </p> </label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="claim">
                      </div>

                      <div class="form-group">
                          <label for=""> <p>Name of resident : </p> </label>
                          <select name="user_id" class="form-control select2">
                               @foreach ($pl as $p)
                                 <option value="{{$p->id}}">{{$p->firstname.' '.$p->middlename.' '.$p->lastname}}</option>
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
            <div class="panel-heading">Schedules</div>
            <div class="panel-body">
                 <table class="table dt1">
                    <thead>
                      <tr>
                        <th>User</th><th>Schedule</th><th>Claim</th><th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($s as $c)
                        <tr>
                          <td>{{App\User::find($c->user_id)->firstname}}</td>
                          <td>{{$c->datescheduled}}</td>
                          <td>{{$c->claim}}</td>
                          <td>
                            <button class="btn btn-info" onclick="editSchedule({{$c->id}})">Edit</button>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>
            </div>
      </div>
    </section>
  </div>  

     <div id="editScheduleModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Schedule Modal</h4>
            </div>
                  <div class="modal-body">
                    <form method="POST" id="editSchedule">
                          <input type="hidden" name="schedule_id" class="schedule_id">
                         <label for=""> <p>Date scheduled : </p> </label>
                          <div class="form-group">
                              <input type="text" class="form-control edit_schedule" name="datescheduled">
                          </div>
                          <label for=""> <p>Claim : </p> </label>
                          <div class="form-group">
                              <input type="text" class="form-control edit_claim" name="claim">
                          </div>
                          <label for=""> <p>Name of resident : </p> </label>
                          <div class="form-group">
                              <select name="user_id" class="form-control select2 edit_resident_schedule">
                                   @foreach ($pl as $p)
                                     <option value="{{$p->id}}">{{$p->firstname.' '.$p->middlename.' '.$p->lastname}}</option>
                                   @endforeach 
                              </select>
                          </div>
                  </div>
                 <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </form>
            </div>
          </div>

        </div>
      </div>

    <script>
        function editSchedule(id){
            $('#editScheduleModal').modal('toggle');
             $.ajax({
              url: base_url_api+"admin/schedule/"+id,
             }).done(function(data) {
                 $('.edit_schedule').val(data.datescheduled)
                 $('.edit_claim').val(data.claim)
                 $('.schedule_id').val(data.id)


                 $('#editSchedule').submit(function(e){
                  $.ajax({
                           type: "POST",
                           url: base_url_api+'admin/schedule/update',
                           data: $("#editSchedule").serialize(), // serializes the form's elements.
                           success: function(data)
                           {
                                $.toaster({ settings :{'timeout' : 9500}});

                                if(data == 1)
                                {
                                    // Success
                                    $.toaster('Schedule updated  success!','Success', 'success');
                                }
                                else if(data == 0)
                                {
                                    // Error
                                    $.toaster('Something went wrong please try again','Error :', 'danger');
                                }

                                else
                                {
                                    // Error
                                    $.toaster(data,'Error', 'warning');
                                }

                                location.reload();
                           }
                     });
                    e.preventDefault();
                  $('#editScheduleModal').modal('close');
                }) 
            });
        }
    </script>
@endsection
