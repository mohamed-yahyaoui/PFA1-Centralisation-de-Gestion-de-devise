<?php include "modules/test_session.php"; $_SESSION['ouvert']=1; ?>
<!DOCTYPE html>
<html>

<head>
  <title>compte bank</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Page Style -->
  <link rel="stylesheet" href="styles/style_m.css">
  <!-- AlertifyJS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <style>
    .alertify-notifier .ajs-message.ajs-success {
      background: red;
      color: white;
    }
  </style>
  <style>
    .ajs-buttons .ajs-ok {
      background: #006B38FF;
    }

    .ajs-buttons .ajs-cancel {
      background: red;
    }

    .ajs-content {
      font-size: large;
      font-weight: bold;
    }
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
  <!-- CIN >-->
  <script src="modules/cin.js"></script>
</head>

<body>


  <nav class="sidebar">

    <img src="sources/BCT-Logo-780x405.jpg" style="width:100%">
    <a href="compte.php">

      <p>Les comptes existants</p>
    </a>
    <a href="compte_ajout.php">

      <p>Ajouter un compte</p>
    </a>
    <a href="compte_suppr.php">

      <p>Supprimer un compte</p>
    </a>
    <a class="actif">

      <p>Modifier mon mot de passe</p>
    </a>
    <a onclick="confirm()">

      <p>Déconnexion</p>
    </a>
  </nav>


  <div class="top  large medium" id="myNavbar">
    <div class=" background_col  center">
      <a class="bar-item button" style="width:25% ">Modifier mon mot de passe</a>
      <a href="email.php" class="bar-item button" style="width:25%  ">Modifier mon adresse mail </a>
      <a href="profil.php" class="bar-item button" style="width:25%  ">Retour</a>

    </div>
  </div>

  <div id="main">
    <?php

    include 'modules/pass.php';
  if (isset($_POST['submit'])){
        pass();
    }
    ?>


    <div class="contenu">
      <h2>Modification du mot de passe</h2>
      <hr style="width:350px">


      <p>S'il vous plaît remplissez les champs ci dessous</p>

      <form action="mpass.php" method="POST">
        <p><input type="number" name="cin" placeholder="&#8470; de la carte d'identité national"></p>
        <p><input type="password" name="anpas" placeholder="Ancien mot de passe"></p>
        <p><input type="password" name="npas" placeholder="Nouveau mot de passe"></p>
        <p><input type="password" name="cnpas" placeholder="Confirmer votre nouveau mot de passe"></p>
        <button type="submit" name="submit">
          Valider
        </button>
        </p>
      </form>

    </div>




  </div>

</body>

</html>