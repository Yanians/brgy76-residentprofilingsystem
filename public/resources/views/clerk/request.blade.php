@extends('layouts.master')
    
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Request
        <small>manage requests</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> clerk</a></li>
        <li class="active"><a href="#">request</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
          @if (!empty($businesspermit))
          <div class="panel panel-default">
           <div class="panel-heading">Business Permit</div>
             <div class="panel-body">
               <table class="table dt">
                 <thead>
                   <tr>
                     <th>Business Name</th><th>Business Address</th><th>status</th><th>Owner Address</th><th>Date of Bith</th><th>Purpose</th><th>Actions</th>
                   </tr>
                 </thead>
                 <tbody>
                   @foreach ($businesspermit as $b)
                     <tr>
                       <td>{{$b->businessname}}</td>
                       <td>{{$b->businessaddress}}</td>
                       <td>{{$b->status}}</td>
                       <td>{{$b->owneraddress}}</td>
                       <td>{{$b->dateofbirth}}</td>
                       <td>{{$b->purpose}}</td>
                       <td><button onClick="bspModal('{{$b->id}} ', '{{Auth::user()->firstname.' '.Auth::user()->lastname}}')">Review</button></td>
                     </tr>
                   @endforeach
                 </tbody>
               </table>
               </div>
          </div>
          @endif
          @if (!empty($certification))
           <div class="panel panel-default">
           <div class="panel-heading">Request Certification</div>
              <div class="panel-body">
               <table class="table dt">
                 <thead>
                   <tr>
                     <th>Resident Fullname</th> <th>Name of Child</th><th>Date of Birth</th><th>Place of Birth</th><th>Actions</th>
                   </tr>
                 </thead>
                 <tbody>
                   @foreach ($certification as $b)
                     <tr>
                       <td>{{App\User::find($b->user_id)->firstname.' '.App\User::find($b->user_id)->lastname}}</td>
                       <td>{{$b->nameofchild}}</td>
                       <td>{{$b->dateofbirth}}</td>
                       <td>{{$b->placeofbirth}}</td>
                       <td><button onClick="cModal('{{$b->id}} ', '{{Auth::user()->firstname.' '.Auth::user()->lastname}}')">Review</button></td>
                     </tr>
                   @endforeach
                 </tbody>
               </table>
             </div>
           </div>
          @endif
          @if (!empty($clearance))
           <div class="panel panel-default">
           <div class="panel-heading">Request Clearance</div>
              <div class="panel-body">
               <table class="table dt">
                 <thead>
                   <tr>
                     <th>Resident Fullname</th> <th>type</th><th>Year</th><th>Purpose</th><th>Actions</th>
                   </tr>
                 </thead>
                 <tbody>
                   @foreach ($clearance as $b)
                     <tr>
                       <td>{{App\User::find($b->user_id)->firstname.' '.App\User::find($b->user_id)->lastname}}</td>
                       <td>{{$b->type}}</td>
                       <td>{{$b->year}}</td>
                       <td>{{$b->purpose}}</td>
                       <td><button onClick="clModal('{{$b->id}} ', '{{Auth::user()->firstname.' '.Auth::user()->lastname}}')">Review</button></td>
                     </tr>
                   @endforeach
                 </tbody>
               </table>
             </div>
          </div>

          @endif
          
    </section>
  </div>  
          <br class="clear-fix">

@endsection

        <!-- New Businesspermit Modal -->
         <div class="modal fade in" id="bspModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Request For Business Permit</h4>
                    </div>
                    <div class="modal-body">
                        <div class="bsp-wrapper">
                            <img class="resident-bsp-img" src="" alt="">
                            <h3 class="fullname"></h3>
                            <p class="bsp-date-of-birth"></p>
                            <p class="bsp-age"></p>
                            <p class="bsp-businessname"></p>
                            <p class="bsp-businessaddress"></p>
                            <span class="btn btn-success btn-block bsp-clerk-fullname"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
         </div>
        <!-- End modal  -->

         <!-- New Businesspermit Modal -->
         <div class="modal fade in" id="cModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Request For Birth Certifcate</h4>
                    </div>
                    <div class="modal-body">
                            <span id="bc_profile"></span>
                             <p class="bc_fullname"></p>
                            <p class="bc_address"></p>
                            <p class="bc_dateofbirth"></p>
                            <p class="bc_nameofchild"></p>
                            <p class="bc_nameoffather"></p>
                            <p class="bc_nameofmother"></p>
                            <p class="bc_nameofhospital"></p>
                            <p class="bc_placeofbirth"></p>
                            <span class="btn btn-success btn-block c-clerk-fullname"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
         </div>
        <!-- End modal  -->

         <!-- New Businesspermit Modal -->
         <div class="modal fade in" id="clModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Request For Clearance</h4>
                    </div>
                    <div class="modal-body">
                          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
         </div>
        <!-- End modal  -->
<script>
    function bspModal(id,fullname)
    {
        $('#bspModal').modal('toggle');

         $.ajax({
          url: base_url_api+"admin/request/businesspermit/"+id+"/"+fullname,
         }).done(function(data) {

          var bsp_id          = data['q'][0].id
          var businessaddress = 'Business address :'+data['q'][0].businessaddress
          var businessname    = 'Business name :'+data['q'][0].businessname
          var dateofbirth     = 'Date of birth: '+data['q'][0].dateofbirth
          var owneraddress    = 'Owner Address '+data['q'][0].owneraddress
          var purpose         = 'Purpose: '+data['q'][0].purpose
          var profilepic      = data['q'][0].profilepic
          var bspage          = 'Age: '+data['q'][0].age+' Years old'
          var clerkfullname   = 'Approved by '+data['clerk']

          var residentfullname =  data['q'][0].firstname+' '+data['q'][0].lastname
          $('.fullname').text(residentfullname);
          $('.bsp-date-of-birth').text(dateofbirth);
          $('.resident-bsp-img').val(profilepic);
          $('.clerkfullname').text(clerkfullname)
          $('.bsp-age').text(bspage)
          $('.bsp-businessname').text(businessname)
          $('.bsp-businessaddress').text(businessaddress)
          $('.bsp-clerk-fullname').text(clerkfullname)
        });
    }

    function cModal(id,fullname)
    {
        $('#cModal').modal('toggle');

         $.ajax({
          url: base_url_api+"admin/request/certification/"+id+"/"+fullname,
         }).done(function(data) {

          var bsp_id          = data['q'][0].id       
          var address          = 'Address : '+data['q'][0].address       
          var dateofbirth         ='Date of birth'+ data['q'][0].dateofbirth       
          var nameofchild          ='Name of child'+ data['q'][0].nameofchild       
          var nameoffather          ='Name of father'+ data['q'][0].nameoffather       
          var nameofhospital          ='Name of hospital'+ data['q'][0].nameofhospital       
          var nameofmother          ='Name of mother'+ data['q'][0].nameofmother       
          var placeofbirth          ='Place of birth'+ data['q'][0].placeofbirth       
          var profilepic          ='<img src="'+base_url+'storage/app/'+data['q'][0].profilepic+'" style="width:100px;height:100px;">';       

          var residentfullname =  data['q'][0].firstname+' '+data['q'][0].lastname
          $('#bc_profile').html(profilepic);
          $('.bc_fullname').text(residentfullname);
          $('.bc_address').text(address)
          $('.bc_dateofbirth').text(dateofbirth)
          $('.bc_nameofchild').text(nameofchild)
          $('.bc_nameoffather').text(nameoffather)
          $('.bc_nameofhospital').text(nameofhospital)
          $('.bc_nameofmother').text(nameofmother)
          $('.bc_placeofbirth').text(placeofbirth)
          
          $('.c-clerk-fullname').text(data.clerk)
          
        });
    }

    function clModal(id,fullname)
    {
        $('#clModal').modal('toggle');

    }
</script>