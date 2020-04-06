
///Il suffit de changer entry et entryc
entry = 'input[name="npas"]';
entryc = 'input[name="cnpas"]';
msg = 'champs';
function change(color,input){
      $(input).css("box-shadow", "0 0 5px "+color);
      $(input).css("border", "1px solid "+color);
}

$(document).ready(function () {
    //entry + ',' + entryc multiple selector jquery
            $(entry+','+entryc).change(function () {
                        if ($(entry).val() != $(entryc).val()) {
                            change("red",entryc);
                            if ($("#sym").length==0){
                            $("</br><i id='sym' class='material-icons' style='font-size:18px;color:red'>error</i><b id='msg' style='color:red;'>Ces deux " + msg + " doivent être identiques !!!</b>").insertAfter(entryc);
                            }
                            else{
                                $("#sym").replaceWith("<i id='sym' class='material-icons' style='font-size:18px;color:red'>error</i>");
                                $("#msg").replaceWith("<b id='msg' style='color:red;'>Ces deux " + msg + " doivent être identiques !!!</b>");
                            }
                        }
                        else {
                            change("green",entryc);
                            if ($("#msg").length){
                                $("#sym").replaceWith("<i class='fa fa-check-circle' style='color:green;'></i>");
                                $("#msg").replaceWith("<b style='color:green;'> Ces deux " + msg + " sont identiques.</b>");
                            }
                            else  $("</br><i id='#sym' class='fa fa-check-circle' style='color:green;'></i><b id='#msg' style='color:green;'> Ces deux " + msg + " sont identiques.</b>").insertAfter(entryc); 
                        }    
                    });
                });