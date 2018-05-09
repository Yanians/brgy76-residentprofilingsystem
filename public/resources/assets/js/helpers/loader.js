
$(document).ajaxStart(function() {
  $( ".loader-wrapper" ).show();
});

$( document ).ajaxComplete(function() {
  $( ".loader-wrapper" ).hide();
});