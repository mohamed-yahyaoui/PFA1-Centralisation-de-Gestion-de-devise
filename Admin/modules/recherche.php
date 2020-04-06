<?php

if (isset($_POST['submit'])){
  try {
    $conn = new PDO("mysql:host=$servername;dbname=centralisation", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if (isset($_POST['submit'])){
      $filter = $_POST['filter'];
      $rech = $_POST['rech'];
      echo '<script>$("table").remove()</script>';
      echo "<table style='border-collapse:separate;border-spacing: 0 15px;'>";
      echo "<tr class='ligne'>";
      echo "<td><b>Nom</b></td>";
      echo "<td><b>Prénom</b></td>";
      echo "<td><b>Banque</b></td>";
      echo "<td><b>Email</b></td>";
      echo "</tr>";
      $stmt = $conn->prepare("SELECT nom_g, prenom_g, nom_banque_g, email_g FROM $table WHERE $filter = '$rech';");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
          echo $v;
      }
  }
  }
  catch(PDOException $e)
      {
          
      echo '<script>alert("Connection interrompue  essayer une autre fois: ");</script>';	
     
      }
  $conn = null;
  echo "</table>";
    }
    ?>