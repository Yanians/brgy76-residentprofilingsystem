@extends('layouts.app')
    
@section('content')
		<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Blotter Report</h1>
                </div>
                
                <button type="button" class="btn btn-primary btn-flat btn-sm pull-right blotterbutton" onclick="addNewBlotter()" style="margin-bottom: 10px;">Add New Blotter Report</button>

                <div class="col-lg-12">
                	<!-- Trigger the modal with a button -->
					<input type="hidden" value="{{Auth::user()->id}}" id="userid" />

					<div id="blotter-wrapper"></div>

						<!-- Modal -->
						<div id="blotterModal" class="modal fade" role="dialog">
						  <div class="modal-dialog">

						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Blotter Report Form</h4>
						      </div>
						      <div class="modal-body">
								 <form method="POST" id="blotterReport">
										 <input type="hidden" value="{{ Auth::user()->id}}" class="form-control" name="user_id" >
										 <input type="hidden" value="" class="form-control edit_id" name="edit_id" >

								 
								  		 <div class="form-group">
										    <label for="person_blotter">You're Full Name</label>
										    <input type="text" value="{{ Auth::user()->firstname.' '.Auth::user()->middlename.' '.Auth::user()->lastname }}" class="form-control" name="person_fullname" readonly>
										  </div>

										 <div class="form-group">
										    <label for="person_blotter">Person to blotter</label>
										    	<input type="text" name="person_blotter_not_registered" class="form-control" placeholder="Type here if person does not exist in the database">
									    	<br>


										    <select name="person_blotter" class="form-control selectsearch person_blotter" style="width: 100%"></select>
										  </div>

										   <div class="form-group">
										    <label for="person_witness">Name of Witness</label>
									    	<input type="text" name="person_witness_not_registered" class="form-control" placeholder="Type here if person does not exist in the database">
									    	<br>

										  	<select name="person_witness" class="form-control selectsearch person_witness" style="width: 100%"></select>
										  </div>
										
										<div class="row">
											<div class="col-md-6">
												   <div class="form-group">
												    <label for="contact">Your Contact</label>
												    <input type="text" class="form-control contact" name="contact">
												  </div>
											</div>
											<div class="col-md-6">
												   <div class="form-group">
												    <label for="witness_contact">Witness Contact</label>
												    <input type="text" class="form-control witness_contact" name="witness_contact">
												  </div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
													<div class="form-group">
												    <label for="incedentreport">Incedent Report</label>
													<textarea name="incedentreport" class="form-control incedentreport" cols="30" rows="3"></textarea>
													</div>
											</div>	
										</div>

										<div class="row">
											<div class="col-md-12">
												   <div class="form-group">
												    <label for="addressofincedent">Address of incedent</label>
												    <input type="text" name="addressofincedent" class="form-control addressofincedent" >
												  </div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												   <div class="form-group">
												    <label for="contact">Date</label>
												    <input type="date" name="date" class="form-control date" >
												  </div>
											</div>
											<div class="col-md-6">
												   <div class="form-group">
												    <label for="hour">Hour</label>
												   	<div class="input-group bootstrap-timepicker timepicker">
											            <input name="hour" type="text" class="form-control input-small hour timepicker">
											            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
											        </div>
												  </div>
											</div>
										</div>
										
						      </div>
						      <div class="modal-footer">
							        <button type="submit" name="submit" class="btn btn-success">Submit</button>
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        </form>
						      </div>
						    </div>

						  </div>
						</div>


						<!-- Modal Blotter notice -->
						<div id="blotterNoticeModal" class="modal fade" role="dialog">
						  <div class="modal-dialog">

						    <!-- Modal content-->
								   	  <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">Viewing Blotter Notice</h4>
								      </div>
								      <div class="modal-body">
									  <form method="POST" id="viewNotice">
											<div class="viewnotice-blotterwrapper"></div>
								      </div>
								      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        </form>
						      </div>
						    </div>

						  </div>
						</div>


                </div>
                <!-- /.col-lg-12 -->
        </div>

            
@endsection
