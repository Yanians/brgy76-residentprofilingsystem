 
  getAllBlotter();
 $('.dt').dataTable();


  function getAllBlotter()
  {
        $.ajax({
          url: base_url_api+"resident/blotter",
         }).done(function(data) {
            $('.blotter-wrapper').html(data);
            $('.blotterTable').dataTable();
        });
  }

  function viewBlotter(id)
  {
        $('#viewBlotterModal').modal('toggle');
        $('#blotter_id').val(id);
         
         $.ajax({
          url: base_url_api+"resident/blotter/view/"+id,
         }).done(function(data) {
            $('.blotter-noticewrapper').html(data);
        });

        $('#blotterNotice').submit(function(e){
            $.ajax({
                     type: "POST",
                     url: base_url_api+'admin/blotter/sendnotice',
                     data: $("#blotterNotice").serialize(), // serializes the form's elements.
                     success: function(data)
                     {
                          $.toaster({ settings :{'timeout' : 9500}});

                          if(data == 1)
                          {
                              // Success
                              $.toaster('Blotter notice sent success!','Success', 'success');
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
                          getAllBlotter();
                     }
               });

              e.preventDefault();
        $('#viewBlotterModal').modal('close');
              

       }) 
  }

    function deleteNotice(id)
    {
        var r = confirm("Are you sure you want to delete this!");
        if (r == true) {
              $.ajax({
              url: base_url_api+"admin/blotter/notice/delete/"+id,
             }).done(function(data) {
                if (data == 1) {
                  $.toaster('Blotter notice delete success!','Success', 'success');

                  viewNoticeBlotter(id);
                }else{
                    $.toaster('Something went wrong please try again','Error :', 'danger');
                }
            });
        }  
    }

    function editNotice(id)
    {
          $('#editNoticeModal').modal('toggle');

          $.ajax({
            url: base_url_api+"admin/blotter/notice/edit/"+id,
           }).done(function(data) {
              $('#edit_notice_id').val(data.id);
              $('#edit_blotter_id').val(data.blotter_id);
              $('.edit_notice').val(data.notice);

                  $('#editNotice').submit(function(e){
                    
                          $.ajax({
                                 type: "POST",
                                 url: base_url_api+'admin/blotter/notice/save',
                                 data: $("#editNotice").serialize(), // serializes the form's elements.
                                 success: function(data2)
                                 {
                                      $.toaster({ settings :{'timeout' : 9500}});

                                      if(data2 == 1)
                                      {
                                          // Success
                                          $.toaster('Blotter notice updated success!','Success', 'success');
                                      }
                                      else if(data2 == 0)
                                      {
                                          // Error
                                          $.toaster('Something went wrong please try again','Error :', 'danger');
                                      }
                                      else
                                      {
                                          // Error
                                          $.toaster(data2,'Error', 'warning');
                                      }

                                 }
                           });
                          e.preventDefault();
                      $('#editNoticeModal').modal('close');


               }) 
          });
    }

   function viewNoticeBlotter(id)
   {
      $('#blotterNoticeModal').modal('toggle');

      
      $.ajax({
        url: base_url_api+"admin/blotter/notice/"+id,
       }).done(function(data) {
          $('.viewnotice-blotterwrapper').html(data);
      });

   }



