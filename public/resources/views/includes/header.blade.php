 <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>C</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Barangay</b> Clearance</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php if (!empty(Auth::user()->profilepic)): ?>
                      <img src="<?php echo asset("storage/app/".Auth::user()->profilepic."");?>" class="user-image" alt="User Image">
                    <?php else : ?>
                      <img src="<?php echo asset("storage/app/photos/default.png");?>" class="user-image" alt="User Image">
                    <?php endif ?>
          
              <span class="hidden-xs">   {{Auth::user()->firstname.' '.Auth::user()->middlename.' '.Auth::user()->lastname}}</span>
           
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                  <?php if (Auth::user()->profilepic): ?>
                      <img src="<?php echo asset("storage/app/".Auth::user()->profilepic."");?>" class="img-circle" style="width:50px;height: 50px;" alt="User Image">
                    <?php else : ?>
                      <img src="<?php echo asset("storage/app/photos/default.png");?>" class="img-circle" style="width:50px;height: 50px;" alt="User Image">
                    <?php endif ?>
                <p>
                  {{Auth::user()->firstname.' '.Auth::user()->middlename.' '.Auth::user()->lastname}}
                  <small>Member since {{Auth::user()->created_at}}</small>
                </p>
              </li>
           
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('admin/user/'.Auth::user()->username) }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                     <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();"  class="btn btn-default btn-flat">
                          Logout
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          {{-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> --}}
        </ul>
      </div>
    </nav>
  </header>