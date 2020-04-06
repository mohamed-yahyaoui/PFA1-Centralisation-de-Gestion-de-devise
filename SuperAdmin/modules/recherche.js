function existdisplay(e){
  k=0;
  $(e).each(function(i,el){
    if( $(el).css("display")=='none' ) k++; 
   });
  if(k!=$(e).length) return true; 
  return false;
}


$(document).ready(function(){
    $("input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".tab tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
      if(!existdisplay(".tab tr")){;
        if ($("b").length==0){
        $("<b style='margin-left:40%;'>(Vide)</b>").insertAfter("table");
         }
        else{
          $("b").replaceWith("<b style='margin-left:40%;'>(Vide)</b>");
         }
        }
      else $("b").remove();
    });
  });