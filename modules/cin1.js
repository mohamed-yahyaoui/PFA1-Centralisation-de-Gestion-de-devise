function change(color,input){
  $(input).css("box-shadow", "0 0 5px "+color);
  $(input).css("border", "1px solid "+color);
}

e = 'input[name="cin"]';

$(document).ready(function(){
 $(e).change(function () {  
   
});