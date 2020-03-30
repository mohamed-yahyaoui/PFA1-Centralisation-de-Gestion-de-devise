<?php
function pass(){

$id=$_SESSION['ID'];
$pass=$_SESSION['PASSWD_s'];
$idd=$_POST['cin'];
$ancien=$_POST['anpas'];
$new=$_POST['npas'];
$new1=$_POST['cnpas'];

$servername = "localhost";
$username = "root";
$dbname = "centralisation";
$password = "";
$table="administrateur";

if (isset($_POST['submit'])){
try {
    $conn = new PDO("mysql:host=$servername;dbname=centralisation", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	if($id!=$idd)
	{ echo "<script>alertify.success('Vérifiez votre identifiant');</script>";  }
     else if($pass!=$ancien)
		 {echo "<script>alertify.success('Vérifiez votre ancien mot de passe');</script>"; }
	  else if($new!=$new1)
		  {echo "<script>alertify.success('Vérifiez que les deux derniers champs soient identiques!!!');</script>"; }
	 else
    {
    $sql = "UPDATE superadministrateur SET passwd_s=$new WHERE IDS = ".$id;
    $conn->exec($sql);
	  
	$_SESSION['PASSWD']=$new;
    echo "<script>
    $(document).ready(function(){
      $('style:first').replaceWith('<style>nav .alertify-notifier .ajs-message.ajs-success {background: #006B38FF ;color:white;}</style>');
    });
    </script>";
	echo "<script>alertify.success('Votre mot de passe a été changé avec success');</script>"; 

	
    }
    }
catch(PDOException $e)
    {
        echo '<script>alertify.success("'.$e->getMessage().'");</script>';	
    }

$conn = null;}
}
?>