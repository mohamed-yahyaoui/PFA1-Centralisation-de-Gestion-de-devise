$(document).ready(function(){
    $("input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#tab tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });