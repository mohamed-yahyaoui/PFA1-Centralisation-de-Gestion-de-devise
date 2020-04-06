
///Il suffit de changer entry et entryc
entry = 'input[name="npas"]';
entryc = 'input[name="cnpas"]';
msg = 'champs';
function change(color){
      $(entryc).css("box-shadow", "0 0 5px "+color);
      $(entryc).css("border", "1px solid "+color);
}

$(document).ready(function () {
    //entry + ',' + entryc multiple selector jquery
            $(entry+','+entryc).change(function () {
                        if ($(entry).val() != $(entryc).val()) {
                            change("red");
                            if ($("i").length==0){
                            $("</br><i class='material-icons' style='font-size:18px;color:red'>error</i><b style='color:red;'>Ces deux " + msg + " doivent être identiques !!!</b>").insertAfter(entryc);
                            }
                            else{
                                $("i").replaceWith("<i class='material-icons' style='font-size:18px;color:red'>error</i>");
                                $("b").replaceWith("<b style='color:red;'>Ces deux " + msg + " doivent être identiques !!!</b>");
                            }
                        }
                        else {
                            change("green");
                            if ($("b").length){
                                $("i").replaceWith("<i class='fa fa-check-circle' style='color:green;'></i>");
                                $("b").replaceWith("<b style='color:green;'> Ces deux " + msg + " sont identiques.</b>");
                            }
                            else  $("</br><i class='fa fa-check-circle' style='color:green;'></i><b style='color:green;'> Ces deux " + msg + " sont identiques.</b>").insertAfter(entryc); 
                        }    
                    });
                });