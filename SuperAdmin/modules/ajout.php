<?php
if (isset($_POST['submit'])){
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $table = "administrateur";
    $dbname = "centralisation";
    
    $conn = new PDO("mysql:host=$servername;dbname=centralisation", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 function randomPassword() {
	 $pass="";
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789?!";
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, strlen($alphabet)-1);
        $pass[$i] = $alphabet[$n];
    }
    return $pass;
}
 $passwd=randomPassword();
    $sql = "INSERT INTO $table (ida,ids, nom_a, prenom_a,passwd_a,email_a,nom_banque_a)
    VALUES ('".$_POST["cin"]."','". $_SESSION['ID']."','".$_POST["nom"]."','".$_POST["prenom"]."','".$passwd."','".$_POST["mail"]."','".$_POST["nom_banque"]."');";
    $conn->exec($sql);
    header("Refresh:0; url=compte.php");
    $_SESSION['msg']=$_POST["prenom"]." est ajouté avec succes";
	$to = $_POST["mail"];
$subject = "Compte guichetier";
$txt = "Bonjour,\n l'administrateur de votre banque vous a ajouté en tant que guichetier \vous trouverai ci joint tous les  coordonnés de votre compte\n Nom:".$_POST["nom"]."\Prenom:".$_POST["prenom"]."\ID:".$_POST["cin"]."Password:".$passwd;
$headers = "From: essid.nizar@gmail.com" . "\r\n" ;
	mail($to,$subject,$txt,$headers);
	header("Refresh:0; url=compte.php");}
catch(PDOException $e)
    {
        echo "<script>
            $(document).ready(function(){
              $('style:first').replaceWith('<style>.alertify-notifier .ajs-message.ajs-success {background: red ;color:white;}</style>');
            });
            </script>";
            echo '<script>alertify.success("'.$e->getMessage().'");</script>';	
    }

$conn = null;
}

?>
