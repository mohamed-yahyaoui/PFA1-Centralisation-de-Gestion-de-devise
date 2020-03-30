<?php include "modules/test_session.php";?>
<!DOCTYPE html>
<html>
<head>
<title>compte bank</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Page Style -->
<link rel="stylesheet" href="styles/style_m.css">
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- AlertifyJS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<style>
.alertify-notifier .ajs-message.ajs-success {background: #008CBA ;color:white;}
</style>
<style>
.ajs-buttons .ajs-ok {background: #006B38FF;}
.ajs-buttons .ajs-cancel {background : red;}
.ajs-content {font-size:large;font-weight:bold;}
input{
margin : 5% 10% 5% 15%;
background-image: url('sources/searchicon.png');
background-position: 10px 10px;
background-repeat: no-repeat;
padding: 20px 20px 20px 40px;
border-radius: 20px;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- Font -->
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
<!--Confirm -->
<script src="modules/deconnex.js"></script>
<!-- Recherche -->
<script src="modules/recherche.js"></script>
<!-- CIN -->
<script src="modules/cin.js"></script>
</head>

<body>


<nav class="sidebar bar-block  small center">
 
  <img src="sources/BCT-Logo-780x405.jpg" style="width:100%">
  <a class="bar-item padding-large actif">
   
    <p>Les comptes existants</p>
  </a>
  <a href="compte_ajout.php" class="bar-item padding-large">
   
    <p>Ajouter un compte</p>
  </a>
  <a href="compte_suppr.php" class="bar-item padding-large  ">
  
    <p>Supprimer un compte</p>
  </a>
  <a href="mpass.php" class="bar-item padding-large  ">
  
  <p>Modifier mon mot de passe</p>
  </a>
  <a onclick="confirm()" class="bar-item padding-large ">
   
    <p>Déconnexion</p>
  </a>
</nav>


<div class="top  large medium" id="myNavbar">
  <div class=" background_col  center">
    <a href="compte.php" class="bar-item button" style="width:25% ">Les comptes existants</a>
    <a  class="bar-item button" style="width:25%  ">Ajouter un compte</a>
    <a href="compte_suppr.html" class="bar-item button" style="width:25%  ">supprimer un compte</a>
	 <a href="profil.php" class="bar-item button" style="width:25%  ">Mon profil</a>
    <a href="deconnex.php" class="bar-item button" style="width:25%  ">deconnection</a>
  </div>
</div>

<div class="padding-large" id="main">
 
<div class="contenu">
  <input class="input" type="text" placeholder="Recheche ..." name="rech">


  <?php

include "modules/affiche.php";

if($_SESSION['ouvert']==0){
  $nom=$_SESSION['NOM'] ;
  echo "<script>alertify.success('Bienvenu $nom');</script>";
  $_SESSION['ouvert']=1;
}
else if($_SESSION['msg']!="")
{     $msg=$_SESSION['msg'];
echo "<script>
            $(document).ready(function(){
              $('style:first').replaceWith('<style>.alertify-notifier .ajs-message.ajs-success {background: green ;color:white;}</style>');
            });
            </script>";
	 echo "<script>alertify.success(' $msg');</script>";
	 $_SESSION['msg']="";
}
?>
</div>
  </div>
</body>

</html>