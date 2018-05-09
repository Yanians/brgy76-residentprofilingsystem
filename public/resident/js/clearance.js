$('.ClearanceTble').dataTable();



    function deleteClearance(id)
     {
        var r = confirm("Are you sure you want to delete this!");
        if (r == true) {
            $.ajax({
              url: base_url_api+"resident/clearance/delete/"+id,
             }).done(function(data) {
                if (data == 1) {  $.toaster('Clearance data deleted success!','Success', 'success'); }
                else if(data == 0){ $.toaster('Something went wrong clearance data not deleted!','Error', 'danger');  }  
                else { $.toaster('Something went wrong clearance data not deleted!','Error', 'danger'); }  

                setTimeout(function(){
                   location.reload();
                }, 3000);

            });
        } 
     }


     function viewClearance(id)
     {
        $('#clearanceModal').modal('toggle');
        var htmldata = "";
         $.ajax({
          url: base_url_api+"resident/clearance/status/"+id,
         }).done(function(data) {
            if (!data[0].status) {
                var status = "Pending"
            }else{
                var status =  data[0].status
            }
            htmldata +='<center><h3>Clearance Status : '+status+'</h3></center>'
           $('.clearance-request-wrapper').html(htmldata)

        });
        
     }