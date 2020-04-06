function change(color){
  $('input[name="cin"]').css("box-shadow", "0 0 5px "+color);
  $('input[name="cin"]').css("border", "1px solid "+color);
}

$(document).ready(function(){
 $('input[name="cin"]').change(function () {  
   val=$('input[name="cin"]').val();
   if(val.length!=8 && !isNaN(val)){
    change("red");
    if ($("i").length==0){
      $("</br><i class='material-icons' style='font-size:18px;color:red'>error</i><b style='color:red;'>CIN doit composé exactement de 8 chiffres !!!</b>").insertAfter('input[name="cin"]');
      }
    else{
          $("i").replaceWith("<i class='material-icons' style='font-size:18px;color:red'>error</i>");
          $("b").replaceWith("<b style='color:red;'>CIN doit composé exactement de 8 chiffres !!!</b>");
      }
  }
  else{
    if ($("i").length==0){
      change("#00FF00");
      $("</br><i class='fa fa-check-circle' style='color:#00FF00;'></i><b style='color:#00FF00;'>Le numero CIN saisi est acceptable!!!</b>").insertAfter('input[name="cin"]');
      }
    else{
    change("#00FF00");
    $("i").replaceWith("<i class='fa fa-check-circle' style='color:#00FF00;'></i>");
    $("b").replaceWith("<b style='color:#00FF00;'>Le numero CIN saisi est acceptable!!!</b>");
  }}
 })
});