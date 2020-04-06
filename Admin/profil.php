<?php  include "modules/test_session.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>compte bank</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Page Style -->
<link rel="stylesheet" href="styles/style_m.css">
<!-- AlertifyJS -->
<link rel="stylesheet" href="styles/prf.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

<style>
.alertify-notifier .ajs-message.ajs-success {background: #006B38FF ;color:white;}
</style>
<style>
.ajs-buttons .ajs-ok {background: #006B38FF;}
.ajs-buttons .ajs-cancel {background : red;}
.ajs-content {font-size:large;font-weight:bold;}
</style>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Font -->
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
<!--Confirm -->
<script src="modules/deconnex.js"></script>
<!-- Confirm password -->
<script src="modules/champ_identiq.js"></script>
<!-- Google Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>


<nav class="sidebar bar-block  small center">
 
  <img src="sources/BCT-Logo-780x405.jpg" style="width:100%">
  <a href="compte.php" class="bar-item padding-large ">
   
    <p>Les comptes existants</p>
  </a>
  <a href="compte_ajout.php" class="bar-item padding-large">
   
    <p>Ajouter un compte</p>
  </a>
  <a href="compte_suppr.php" class="bar-item padding-large  ">
  
    <p>Supprimer un compte</p>
  </a>
  <a  class="bar-item padding-large actif ">
  
    <p>Mon Profil</p>
  </a>
  <a  onclick="confirm()" class="bar-item padding-large  ">
   
    <p>Déconnexion</p>
  </a>
</nav>


<div class="top  large medium" id="myNavbar">
  <div class=" background_col  center">
    <a href="compte.php" class="bar-item button" style="width:25% ">Les comptes existants</a>
    <a  class="bar-item button" style="width:25%  ">Ajouter un compte</a>
    <a href="compte_suppr.html" class="bar-item button" style="width:25%  ">supprimer un compte</a>
	 <a href="mpass.php" class="bar-item button" style="width:25%  ">modifier mon mot de passe</a>
    <a onclick="confirm()" class="bar-item button" style="width:25%  ">deconnection</a>
  </div>
</div>

<div class="padding-large" id="main">
 
<div class="contenu">
    <h2 >Profil :</h2>
  </br>

<?php
include "modules/vars.php";
include "modules/fcts.php";
include "modules/recherche.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "centralisation";
$table = "administrateur";

$iden=$_SESSION['ID'];
try {
    $conn=dbconnect($servername,$dbname,$username,$password);

	$tab=$conn->query("SELECT nom_a,prenom_a,passwd_a,NOM_BANQUE_A,EMAIL_A FROM administrateur WHERE IDA= '$iden';");
	
	 foreach($tab as $stmt){
	echo "<table style='border: solid 1px white;border-collapse:collapse;'>";
      echo "<tr >";
	  
	 
      echo "<th >Identifiant </th>";
	  echo"<td> ".$iden."</td>";
	  echo"</tr><tr>";
	  
	   echo "<th >Nom</th>";
	   echo"<td> ".$stmt['nom_a']."</td>";
	   echo"</tr><tr>";
	   
     echo "<th >Prenom</th>";
	   echo"<td> ".$stmt['prenom_a']."</td>";
	   echo"</tr><tr>";
	   echo "<th >Mot de passe</th>";
	   echo"<td> ".str_repeat("*", strlen($stmt['passwd_a']))."</td>";
	   echo"</tr><tr>";
      echo "<th >Nom de la banque</th>";
	  echo"<td> ".$stmt['NOM_BANQUE_A']."</td>";
	   echo"</tr><tr>";
      echo "<th >Email</th>";
	echo"<td> ".$stmt['EMAIL_A']."</td>";

	   echo"</tr>";
	   
     
	
}}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
</div>
  </div>
</body>

</html>