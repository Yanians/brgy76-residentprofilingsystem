@extends('layouts.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blotter Report
        <small>manage blotter</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> admin</a></li>
        <li class="active"><a href="#">blotter</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="blotter-wrapper"></div>
    </section>
    <!-- /.content -->
  </div>


  <!-- Modal -->
            <div id="viewBlotterModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">

                        <center><h3 style="color: red;">Blotter Case</h3></center>


                  <div class="blotter-noticewrapper"></div>
                  <center><h1>Send a Notice</h1></center>

                 <form method="POST" id="blotterNotice">
                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                          <input type="hidden" name="blotter_id" value="" id="blotter_id">
                          <textarea name="notice" class="form-control notice" cols="30" rows="6"></textarea>
                          </div>
                      </div>  
                    </div>
                    
                  </div>
                  <div class="modal-footer">
                      <button type="submit" name="submit" class="btn btn-success">Send</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                  </div>
                </div>

              </div>
            </div>
  <!-- Modal -->

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


            <!-- Modal Blotter notice -->
            <div id="editNoticeModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Notice</h4>
                  </div>
                  <div class="modal-body">
                <form method="POST" id="editNotice">
                          <input type="hidden" id="edit_blotter_id" name="blotter_id">
                          <input type="hidden" id="edit_notice_id"  name="notice_id">
                          <textarea name="notice" class="form-control edit_notice" cols="30" rows="6"></textarea>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" name="submit" class="btn btn-success">Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                  </div>
                </div>

              </div>
            </div>

@endsection
