<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('resident/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resident/vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resident/dist/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('resident/vendor/morrisjs/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('resident/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/loader.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/timepicker.less') }}" rel="stylesheet/less" type="text/css">

    <link href="{{ asset('resources/assets/css/plugins/dataTables/jquery.dataTables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('resources/assets/css/plugins/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('resources/assets/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css">


    <link href="{{ asset('resident/css/custom.css') }}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
    </script>
  


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
    @if (Auth::guest())
         <body style="background: #337ab7;">
                 <div class="row">
                    @yield('content')
                 </div> 
             </body>
         </html>   
    @else

<body>
    <div id="wrapper">
    <div class="loader-wrapper">
        <div class="loader">Loading...</div>
    </div>
    <input type="hidden" value="{{Auth::user()->id}}" id="userid" />

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="{{url('/resident/blotter')}}">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> <span id="blotternotice-count"></span> Blotter Notice 
                                    {{-- <span class="pull-right text-muted small">4 minutes ago</span> --}}
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                            <?php 
                                $c = App\Clearance::where('user_id', '=', Auth::user()->id)->where('seen', '=', 0)->get();

                                $s = App\Socialpension::where('user_id', '=', Auth::user()->id)->where('seen', '=', 0)->where('approval_status', '!=', '')->get();

                                $cer = App\Certification::where('user_id', '=', Auth::user()->id)->where('seen', '=', 0)->where('status', '!=', '')->get();
                            ?>
                            @foreach ($c as $cl_notif)
                             <li>
                                <a href="{{url('/resident/clearance/user/'.Auth::user()->id)}}">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> Clearance {{$cl_notif->purpose}} was {{$cl_notif->status}} 
                                        {{-- <span class="pull-right text-muted small">4 minutes ago</span> --}}
                                    </div>
                                </a>
                            </li>   
                             <li class="divider"></li>
                            @endforeach

                            @foreach ($s as $sl_notif)
                             <li>
                                <a href="{{url('/resident/socialpension')}}">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> Socialpension {{$sl_notif->purpose}} was {{$sl_notif->approval_status}} 
                                        {{-- <span class="pull-right text-muted small">4 minutes ago</span> --}}
                                    </div>
                                </a>
                            </li>   
                             <li class="divider"></li>
                            @endforeach


                            @foreach ($cer as $cer_notif)
                             <li>
                                <a href="{{url('/resident/socialpension')}}">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> Birth Certification for {{$cer_notif->nameofchild}} was {{$cer_notif->status}} 
                                        {{-- <span class="pull-right text-muted small">4 minutes ago</span> --}}
                                    </div>
                                </a>
                            </li>   
                             <li class="divider"></li>
                            @endforeach
                      
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{url('/resident/profile')}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="{{url('/resident/settings')}}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                          <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();" >
                          <i class="fa fa-sign-out fa-fw"></i> Logout
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li class="list-profile-sidebar">
                               <?php if (Auth::user()->profilepic): ?>
                                  <img src="<?php echo asset("storage/app/".Auth::user()->profilepic."");?>" alt="User Image" class="img-circle user-profile-100 center">
                                <?php else : ?>
                                  <img src="<?php echo asset("storage/app/photos/default.png");?>"  class="img-circle center user-profile-100" alt="User Image">
                                <?php endif ?>
                                <h3 class="txt-center">{{Auth::user()->firstname.' '.Auth::user()->middlename.' '.Auth::user()->lastname}}</h3>
                        </li>
                     
                        <li>
                            <a href="{{ url('/resident/clearance/user/'.Auth::user()->id) }}"><i class="fa fa-file-text-o"></i> Barangay Clearance</a>
                        </li>
                        <li>
                            <a href="{{ url('/resident/businesspermit') }}"><i class="fa fa-book"></i> Business Permit</a>
                        </li>
                         <li>
                            <a href="{{ url('/resident/socialpension') }}"><i class="fa  fa-bank"></i> Social Pension </a>
                        </li>
{{-- 
                           <li>
                            <a href="{{ url('/resident/prerequisite') }}"><i class="fa fa-asterisk"></i> Prerequisite </a>
                        </li> --}}
                           <li>
                            <a href="{{ url('/resident/blotter') }}"><i class="fa  fa-send-o"></i> Blotter Report </a>
                        </li>
                         
                           <li>
                            <a href="{{ url('/resident/schedule') }}"><i class="fa  fa-calendar"></i> Schedule of Claims </a>
                        </li>
                    {{--        <li>
                            <a href="{{ url('/resident/location') }}"><i class="fa fa-map-marker"></i> Location </a>
                        </li>
                           <li>
                            <a href="{{ url('/resident/details') }}"><i class="fa fa-info-circle"></i> Details Info </a>
                        </li> --}}
                         <!--   <li>
                            <a href="{{ url('/resident/certificate') }}"><i class="fa fa-certificate"></i> Request Certificate </a>
                        </li> -->
                   
                   
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            
                    @yield('content')
            
        </div>
        <!-- /#page-wrapper -->
         <footer class="main-footer footer ">
            <div class="pull-right hidden-xs">
              <b>Version</b> 0.1
            </div>
            <strong>Copyright © 2017-2029</strong> All rights reserved.
          </footer>
    </div>
    <!-- /#wrapper -->

      <!--  Bootstrap and jquery are loaded already in this module including vuejs-->
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('public/js/app.js') }}"></script>

        <script src="{{ asset('resident/dist/js/sb-admin-2.js') }}"></script>
        <script src="{{ asset('resident/vendor/metisMenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('resident/vendor/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('resident/dist/js/sb-admin-2.js') }}"></script>
        <script src="{{ asset('resources/assets/js/select2.min.js') }}"></script>
        <script src="{{ asset('resources/assets/js/bootstrap-timepicker.js') }}"></script>
        <script src="{{ asset('resident/js/jquery.toaster.js') }}"></script>
        <script src="{{ asset('resources/assets/js/helpers/loader.js') }}"></script>


        <script src="{{ asset('resources/assets/js/plugins/datatables/dataTables.bootstrap.js') }}"></script>
        <script src="{{ asset('resources/assets/js/plugins/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('resident/js/blotter.js') }}"></script>
        <script src="{{ asset('resident/js/profile.js') }}"></script>
        <script src="{{ asset('resident/js/clearance.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
        
</body>

</html>
    @endif
