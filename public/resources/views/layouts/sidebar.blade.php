 <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">

          <?php if (Auth::user()->profilepic): ?>
            <img src="<?php echo asset("storage/app/".Auth::user()->profilepic."");?>" style="width:50px;height:50px;">
          <?php else : ?>
            <img src="<?php echo asset("storage/app/photos/default.png");?>" style="width:50px;height:50px;">
          <?php endif ?>

        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->firstname .'('.Auth::user()->role .')'}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        
        <?php if (Auth::user()->role == 'Barangay Captain'): ?>
          
             <li>
              <a href="{{url('/admin/credentials')}}">
                <i class="fa fa-th"></i> <span>Credentials</span>
              </a>
            </li>
                <li>
              <a  href="{{url('/admin/announcement')}}">
                <i class="fa fa-th"></i> <span>Set Announcement</span>
              </a>
            </li>

                <li>
              <a  href="{{url('/admin/purokleaderlocation')}}">
                <i class="fa fa-th"></i> <span>Purok Leaders Location</span>
              </a>
            </li>

            <li>
              <a  href="{{url('/admin/receiveletter')}}">
                <i class="fa fa-th"></i> <span>Receive Letter</span>
              </a>
            </li>
               <li>
              <a  href="{{url('/admin/setappointment')}}">
                <i class="fa fa-th"></i> <span>Set appointment</span>
              </a>
            </li>

        <?php elseif (Auth::user()->role == 'Admin'): ?>
             <li>
              <a href="{{url('/admin/credentials')}}">
                <i class="fa fa-th"></i> <span>Credentials</span>
              </a>
            </li>
             <li>
              <a href="{{url('/admin/notifications')}}">
                <i class="fa fa-th"></i> <span>Notifications {{!empty($notif_count) ? "(".$notif_count.")" : "" }}</span>
              </a>
            </li>

         <?php elseif (Auth::user()->role == 'Purok leader'): ?>
           <li>
            <a href="{{url('/admin/credentials')}}">
              <i class="fa fa-th"></i> <span>Users Profile</span>
            </a>
          </li>
           <li>
            <a href="{{url('/admin/approval')}}">
              <i class="fa fa-th"></i> <span>Approval</span>
            </a>
          </li>
           <li>
            <a href="{{url('/admin/notifications')}}">
              <i class="fa fa-th"></i> <span>Notifications {{!empty($notif_count) ? "(".$notif_count.")" : "" }}</span>
            </a>
          </li>

          <?php elseif (Auth::user()->role == 'Staff'): ?>
           <li>
            <a href="{{url('/admin/staff/blotter')}}">
              <i class="fa fa-th"></i> <span>Blotter</span>
            </a>
          </li>
           <li>
            <a href="{{url('/admin/staff/request')}}">
              <i class="fa fa-th"></i> <span>Request</span>
            </a>
          </li>
           <li>
            <a href="{{url('/admin/staff/purokleaderlocation')}}">
              <i class="fa fa-th"></i> <span>Purok Leaders</span>
            </a>
          </li>
           <li>
            <a href="{{url('/admin/staff/registeredresidents')}}">
              <i class="fa fa-th"></i> <span>Registered Residents</span>
            </a>
          </li>
          {{--  <li>
            <a href="{{url('/admin/staff/privileges')}}">
              <i class="fa fa-th"></i> <span>Privileges</span>
            </a> --}}
          </li>
           <li>
            <a href="{{url('/admin/staff/schedules')}}">
              <i class="fa fa-th"></i> <span>Set Schedule</span>
            </a>
          </li>
        <?php elseif (Auth::user()->role == 'Clerk'): ?>
           <li>
            <a href="{{url('/admin/clerk/request')}}">
              <i class="fa fa-th"></i> <span>Requests</span>
            </a>
          </li>
       {{--    <li>
            <a href="{{url('/admin/clerk/messages')}}">
              <i class="fa fa-envelope"></i> <span>Messages</span>
            </a>
          </li> --}}
          <li>
            <a href="{{url('/admin/clerk/history')}}">
              <i class="fa fa-history"></i> <span>Transaction History</span>
            </a>
          </li>
        <?php endif ?>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>