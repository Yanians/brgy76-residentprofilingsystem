 
 // $('select').select2();
 $('.timepicker').timepicker();
 getBlotter();

    $.ajax({
      url: base_url_api+"resident/fullname",
     }).done(function(data) {
        $('.selectsearch').html(data);
    });

     function viewNoticeBlotter(id)
     {
        $('#blotterNoticeModal').modal('toggle');

        
        $.ajax({
          url: base_url_api+"resident/blotter/notice/"+id,
         }).done(function(data) {
            $('.viewnotice-blotterwrapper').html(data);
        });

       $.ajax({
          url: base_url_api+"resident/blotter/notice/isviewed/"+id,
         }).done(function(data) {
            getBlotter();
            getBlotterNoticeCount();
        });  

     }
     
     function addNewBlotter()
     {
        $('#blotterModal').modal('toggle');
        $('.contact').val('');
        $('.witness_contact').val('');
        $('.incedentreport').val('');
        $('.addressofincedent').val('');
        $('.date').val('');
        $('.hour').val('');
  

        $('#blotterReport').submit(function(e){
            $.ajax({
                     type: "POST",
                     url: base_url_api+'resident/blotter/save',
                     data: $("#blotterReport").serialize(), // serializes the form's elements.
                     success: function(data)
                     {
                          $.toaster({ settings :{'timeout' : 9500}});

                          if(data == 1)
                          {
                              // Success
                              $.toaster('Blotter saved success!','Success', 'success');
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
                          getBlotter();
                         $('#blotterModal').modal('toggle');
                     },
                    error: function(e)
                     {
                          $.toaster({ settings :{'timeout' : 9500}});

                          // Error
                          $.toaster('Something went wrong please try again '+e,'Error :', 'danger');
                        
                          getBlotter();
                         $('#blotterModal').modal('toggle');
                     },
               });
              e.preventDefault();
       }) 

     }

        
        

     function getBlotter()
     {
         let user_id = $('#userid').val();

         $.ajax({
          url: base_url_api+"resident/blotter/"+user_id,
         }).done(function(data) {
            $('#blotter-wrapper').html(data);
            $('.blotterTable').dataTable();
        });
     }

     function editBlotter(id)
     {
        $('#blotterModal').modal('toggle');

         $.ajax({
          url: base_url_api+"resident/blotter/edit/"+id,
         }).done(function(data) {
            $('.contact').val(data.person_contact);
            $('.witness_contact').val(data.witness_contact);
            $('.incedentreport').val(data.report);
            $('.addressofincedent').val(data.address_incedent);
            $('.date').val(data.date);
            $('.hour').val(data.hour);
            $('.edit_id').val(data.id);

             $('#blotterReport').submit(function(e){
              $.ajax({
                           type: "POST",
                           url: base_url_api+'resident/blotter/save_edit',
                           data: $("#blotterReport").serialize(), // serializes the form's elements.
                           success: function(data2)
                           {

                                $.toaster({ settings :{'timeout' : 9500}});

                                if(data2 == 1)
                                {
                                    // Success
                                    $.toaster('Blotter updated successfully!','Success', 'success');
                                }
                                else if(data2 == 0)
                                {
                                    // Error
                                    $.toaster('Blotter update failed something went wrong please try again','Error :', 'danger');
                                }

                                else
                                {
                                    // Error
                                    $.toaster(data2,'Error', 'warning');
                                }
                                getBlotter();
                           }
                     });
                    e.preventDefault();
             }) 
        });
     }

     function deleteBlotter(id)
     {
        var r = confirm("Are you sure you want to delete this!");
        if (r == true) {
            $.ajax({
              url: base_url_api+"resident/blotter/delete/"+id,
             }).done(function(data) {
                if (data == 1) {  $.toaster('Blotter data deleted success!','Success', 'success'); }
                else if(data == 0){ $.toaster('Something went wrong blotter data not deleted!','Error', 'danger');  }  
                else { $.toaster('Something went wrong blotter data not deleted!','Error', 'danger'); }  
                getBlotter();

            });
        } 
     }

     function getBlotterNoticeCount()
     {
        let user_id = $('#userid').val();
        $.ajax({
          url: base_url_api+"resident/blotternoticecount/"+user_id,
         }).done(function(data) {
            $('#blotternotice-count').text(data);
        });
     }

     getBlotterNoticeCount();

      