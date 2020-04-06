function confirm(){
alertify.confirm('','Voulez-vous déconnecter??',function(){window.location.replace('deconnex.php');}, function(){});
$(".ajs-ok").html('Oui');
$(".ajs-cancel").html('Annuler');
}