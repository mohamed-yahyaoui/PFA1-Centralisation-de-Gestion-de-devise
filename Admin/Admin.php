<?php
session_start();
session_unset();
session_destroy();
$conn=null;?>
<!DOCTYPE html>
<html>
<head>
<title>compte bank</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Page Style -->
<link rel="stylesheet" href="styles/style_login.css">
<!-- AlertifyJS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<style>
.alertify-notifier .ajs-message.ajs-success {background: red ;color:white;}

</style>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- Font -->
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
</head>
    <body>
        <div id="glob">   

<?php

$servername = "localhost";
$username = "root";
$password = "";
$table = "administrateur";
$dbname = "centralisation";

include "modules/fcts.php";
include "modules/login.php";

?>

		
          <div class="contenu">
                <h1 style="font-family: fantaisie;"> Espase Administrateur d'une banque</h1>
                    <form action="Admin.php" method="post">
                    <label for="fid">Identifiant:</label></br>
                     <input type="number" name="cin"  placeholder="12345678"><br><br>
                    <label for="pass">Mot de passe:</label></br>
                     <input type="password" name="mpass" id="pass" placeholder="Au moins 6 caractères"><br><br>
                    <button type="submit" name="go" formmethod="post" value="Connecter">Connecter</button></br>

                  </form>
				
                
            </div>
        </div>
    </body>
</html>