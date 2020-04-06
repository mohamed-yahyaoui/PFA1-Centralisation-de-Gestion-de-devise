<?php

Require "fcts.php" ;

$servername = "localhost";
$username = "root";
$dbname = "centralisation";
$password = "";
$table="administrateur";

if (isset($_POST['submit'])){
    $id=$_SESSION['ID'];
    $new=$_POST['npas'];
    $new1=$_POST['cnpas'];
    try {
    $conn=dbconnect($servername,$dbname,$username,$password);
	if($_POST['mdp']!=$_SESSION['PASSWD_a']){
        echo "<script>
        $(document).ready(function(){
          $('style:first').replaceWith('<style>.alertify-notifier .ajs-message.ajs-success {background: red ;color:white;}</style>');
        });
        </script>";
          echo "<script>alertify.success('Le mot de passe est incorrect!!');</script>";
    }
    else{
	 if($new!=$new1)
          {        echo "<script>
            $(document).ready(function(){
              $('style:first').replaceWith('<style>.alertify-notifier .ajs-message.ajs-success {background: red ;color:white;}</style>');
            });
            </script>";
              echo "<script>alertify.success('Verifiez que les deux adresses saisies coincident');</script>"; }
	 else
    {
    
	$conn->query("UPDATE $table set EMAIL_A='$new' WHERE IDA = '$id';");
	  
	
	echo "<script>alertify.success('votre adress mail a été changé avec success');</script>"; 
    }
	
    }
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
    echo $e->getMessage();
    }

$conn = null;
}
?>