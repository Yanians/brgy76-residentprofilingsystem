<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('resources/assets/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/plugins/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/plugins/dataTables/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/loader.css') }}" rel="stylesheet">

      <!-- Font Awesome -->
      <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

      <!-- Ionicons -->
      <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
      <script src="{{ asset('resources/assets/js/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

</head>
<body class="hold-transition sidebar-mini skin-blue-light">
    <div class="loader-wrapper">
        <div class="loader">Loading...</div>
    </div>
<!-- Site wrapper -->
<div class="wrapper" style="height: 100% !important;">

  <!-- =============================================== -->

       @include('includes.header')
            
  <!-- =============================================== -->

       @include('layouts.sidebar')
            
  <!-- =============================================== -->

        @yield('content')

 <footer class="main-footer">
    <div class="pull-right hidden-xs">
        beta version 0.0.1
    </div>
    Copyright &copy; 2017  All rights  reserved.
  </footer>

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('public/js/app.js') }}"></script>
    
    <script src="{{ asset('resources/assets/js/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('resources/assets/js/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/helpers/loader.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('resident/js/jquery.toaster.js') }}"></script>
          
    <script src="{{ asset('resources/assets/js/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('admin/js/blotter.js') }}"></script>
    <script src="{{ asset('admin/js/purokleader.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
       $('.dt1').dataTable();
       $('.dt2').dataTable();
       $('.dt3').dataTable();
       $('.dt4').dataTable();
       $('.select2').select2();
       
       function viewclearance(id){
          $("#clearanceDetailModal").modal();
             $.ajax({url: "http://localhost/clearance/api/resident/clearance/"+id, success: function(result){
                var data = '';
                for (var key in result) {
                    if (result.hasOwnProperty(key)) {
                      if(!result[key].profilepic)
                      {
                         var profile = "photos/default.png"
                      }else{
                        var profile = result[key].profilepic;
                      }
                                  data+='<div class="col-md-12"><img src="http://localhost/clearance/storage/app/'+profile+'" style="display:block;margin:0 auto;width:100px;height:100px;border-radius:50%;"><br>  <center> Profile Photo</center> <hr> </div>';
                   

                        data+='<div class="row"><div class="col-md-12">Fullname : '+result[key].firstname+' '+result[key].lastname+'</div>';
                        data+='<div class="col-md-12">Age : '+result[key].age+'</div>';
                        data+='<div class="col-md-12">Birthday : '+result[key].bday+'</div>';
                        data+='<div class="col-md-12">Citizenship : '+result[key].citizenship+'</div>';
                        data+='<div class="col-md-12">Contact Number : '+result[key].contactnumber+'</div>';
                        data+='<div class="col-md-12">Email : '+result[key].email+'</div>';
                        data+='<div class="col-md-12">Gender : '+result[key].gender+'</div>';
                        data+='<div class="col-md-12">Provincial Address : '+result[key].provincialaddress+'</div>';
                        data+='<div class="col-md-12">Purpose : '+result[key].purpose+'</div>';
                        data+='<div class="col-md-12">Requirements: <br> <img src="http://localhost/clearance/storage/app/'+result[key].photo+'"></div>';
                    }
                }

                $("#data-clearance-detail").html(data);
            }});
       }

       function viewclearanceStaffDetails(id){
          $("#clearanceDetailModal").modal();
             $.ajax({url: "http://localhost/clearance/api/resident/clearance/"+id, success: function(result){
                var data = '';
                for (var key in result) {
                    if (result.hasOwnProperty(key)) {
                           if(!result[key].profilepic)
                      {
                         var profile = "photos/default.png"
                      }else{
                        var profile = result[key].profilepic;
                      }
                                  data+='<div class="col-md-12"><img src="http://localhost/clearance/storage/app/'+profile+'" style="display:block;margin:0 auto;width:100px;height:100pxborder-radius:50%;"><br><center> Profile Photo</center><hr> </div>';

                        data+='<div class="row"><div class="col-md-12">Name : '+result[key].firstname+' '+result[key].lastname+'</div>';
                        data+='<div class="col-md-12">Gender : '+result[key].gender+'</div>';
                        data+='<div class="col-md-12">Status : '+result[key].status+'</div>';
        
                        data+='<div class="col-md-12">Address : '+result[key].presentaddress+'</div>';
                        data+='<div class="col-md-12">Date of Birth : '+result[key].bday+'</div>';
                        data+='<div class="col-md-12">Place of Birth : '+result[key].placeofbirth+'</div>';
                        data+='<div class="col-md-12">Age : '+result[key].age+'</div>';
                        data+='<div class="col-md-12">Citizenship : '+result[key].citizenship+'</div>';
                        data+='<div class="col-md-12">Contact Number : '+result[key].contactnumber+'</div>';
                        data+='<div class="col-md-12">Purpose : '+result[key].purpose+'</div>';
                        data+='<div class="col-md-12">Requirements : <br><img src="http://localhost/clearance/storage/app/'+result[key].photo+'"></div>';
                    }
                }

                $("#data-clearance-detail-staff").html(data);
            }});
       }
     
    </script>


</body>
</html>
