function change(color,input){
  $(input).css("box-shadow", "0 0 5px "+color);
  $(input).css("border", "1px solid "+color);
}

e = 'input[name="cin"]';

$(document).ready(function(){
 $(e).change(function () {  
   val=$(e).val();
   if(val.length!=8 || isNaN(val)){
    change("red",e);
    $('button[type="submit"]').prop('disabled', true);
    if ($("i").length==0){
      $("</br><i class='material-icons' style='font-size:18px;color:red'>error</i><b style='color:red;'>CIN doit composé exactement de 8 chiffres !!!</b>").insertAfter(e);
      }
    else{
          $("i").replaceWith("<i class='material-icons' style='font-size:18px;color:red'>error</i>");
          $("b").replaceWith("<b style='color:red;'>CIN doit composé exactement de 8 chiffres !!!</b>");
      }
  }
  else{
    if ($("i").length!=0){
    change("green",e);
    $('button[type="submit"]').prop('disabled', false);
    $("i").replaceWith("<i class='fa fa-check-circle' style='color:green;'></i>");
    $("b").replaceWith("<b style='color:green;'>Votre CIN est correcte!!!</b>");
  }}
 })
});