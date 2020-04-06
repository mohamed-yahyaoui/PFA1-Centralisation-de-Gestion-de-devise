function change(color,input){
  $(input).css("box-shadow", "0 0 5px "+color);
  $(input).css("border", "1px solid "+color);
}

e = 'input[name="ci"]';

$(document).ready(function(){
 $(e).change(function () {  
   val=$(e).val();
   if(val.length!=8 || isNaN(val)){
    change("red",e);
    $('#button').prop('disabled', true);
    if ($("#erri").length==0){
      $("<i id='erri' class='material-icons' style='font-size:18px;color:red'>error</i><b id='errb' style='color:red;'>CIN doit composé exactement de 8 chiffres !!!</b>").insertBefore("h4");
      }
    else{
          $("#erri").replaceWith("<i class='material-icons' style='font-size:18px;color:red'>error</i>");
          $("#errb").replaceWith("<b style='color:red;'>CIN doit composé exactement de 8 chiffres !!!</b>");
      }
  }
  else{
    if ($("#erri").length!=0){
    change("green",e);
    $('#button').prop('disabled', false);
    $("#erri").replaceWith("<i id='erri' class='fa fa-check-circle' style='color:green;'></i>");
    $("#errb").replaceWith("<b id='errb' style='color:green;'>Votre CIN est correcte!!!</b>");
  }}
 })
});