function initGeolocation()
{
  if( navigator.geolocation )
  {
     // Call getCurrentPosition with success and failure callbacks
     navigator.geolocation.getCurrentPosition( success, fail );
  }
  else
  {
     alert("Sorry, your browser does not support geolocation services.");
  }
}

function success(position)
{
         let user_id = $('#userid').val();

        $.ajax({
          url: base_url_api+"resident/profile/latlong/"+position.coords.latitude+"/"+position.coords.longitude+"/"+user_id,
        }).done(function(data) {
           console.log(data);
        });
}

function fail()
{
     // alert("Sorry, unaible to fetch current location.");
  
}
initGeolocation();


function profiles_pic()
{
      $.ajax({
        url: base_url_api+"resident/profiles",
      }).done(function(data) {
        var content = '<table class="table residentTable"><thead><tr><th>Profile</th><th>Full name</th></tr></thead>';
              $.each(data, function(k, v) {
                  if (v.profilepic === null) {
                    content+= "<tr><td><img src='"+base_url+"storage/app/photos/default.png' class='img-circle img-bordered-sm user-profile-50')></td><td>"+v.firstname+' '+v.middlename+' '+v.lastname+"</td></tr>";
                  }else{
                    content+= "<tr><td><img src='"+base_url+"storage/app/"+v.profilepic+"' class='img-circle img-bordered-sm user-profile-50')></td><td>"+v.firstname+' '+v.middlename+' '+v.lastname+"</td></tr>";
                  }
              });
           $('#residents-wrapper').html(content);   
           $('.residentTable').dataTable();

      });
}


function getPurokLeaders()
{
      $.ajax({
        url: base_url_api+"admin/purokleaders",
      }).done(function(data) {
         $('#purokleaders-wrapper').html(data);
          $('.purokleadersTable').dataTable();
      });
}

getPurokLeaders();
profiles_pic();