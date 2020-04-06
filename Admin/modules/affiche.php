<?php

  try {
	  $banque=$_SESSION['BANQUE']; 
    $conn = new PDO("mysql:host=$servername;dbname=centralisation", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$n=0;
	$stmt = $conn->prepare("SELECT idg,nom_g, prenom_g,  email_g, ddl_g FROM $table WHERE Nom_banque_g='$banque';");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	  
      foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
          $n++;
      }
	  if($n==0){echo "<script>
            $(document).ready(function(){
              $('style:first').replaceWith('<style>.alertify-notifier .ajs-message.ajs-success {background: red ;color:white;}</style>');
            });
            </script>";
	  echo "<script>alertify.success('pas de comptes!!!');</script>";}
	else{
	
	
      echo "<table style='border-collapse:separate;border-spacing: 0 15px;width:97%'>";
      echo "<thead>\n<tr>";
      echo "<th>CIN</th>";
      echo "<th>Nom</th>";
      echo "<th>Prénom</th>";
      //echo "<th>&#8470; du guichet</th>";
      echo "<th>Email</th>";
      echo "<th>Date du dernier login</th>";
      echo "</tr>\n</thead>\n<tbody id='tab'>";
  
      $stmt = $conn->prepare("SELECT idg,nom_g, prenom_g,  email_g, ddl_g FROM $table WHERE Nom_banque_g='$banque';");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	  
      foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
          echo $v;
      }
    echo "</tbody>\n</table>";}
  }
  catch(PDOException $e)
      {
        echo "<script>
            $(document).ready(function(){
              $('style:first').replaceWith('<style>.alertify-notifier .ajs-message.ajs-success {background: red ;color:white;}</style>');
            });
            </script>";
        echo "<script>alertify.success('Il ya des problèmes!!!');</script>";
        //uncomment to get error
        //echo $e->getMessage();
          }
  $conn = null;
  echo "</table>";
    ?>