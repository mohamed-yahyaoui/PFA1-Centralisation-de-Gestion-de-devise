<?php
include "modules/fcts.php";
  try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $table = "administrateur";
    $dbname = "centralisation";
    $conn = new PDO("mysql:host=$servername;dbname=centralisation", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "<table style='border-collapse:separate;border-spacing: 0 15px;width:97%'>";
      echo "<thead>\n<tr>";
      echo "<th>CIN</th>";
      echo "<th>Nom</th>";
      echo "<th>Prénom</th>";
      echo "<th>Banque</th>";
      echo "<th>Email</th>";
      echo "<th>Date du dernier login</th>";
      echo "</tr>\n</thead>\n<tbody class='tab'>";
   
      $stmt = $conn->prepare("SELECT ida,nom_a, prenom_a, nom_banque_a, email_a, ddl_a FROM $table;");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
          echo $v;
      }
    echo "</tbody>\n</table>";
  }
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
  echo "</table>";
    ?>