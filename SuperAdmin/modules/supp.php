<?php
$servername = "localhost";
$username = "root";
$password = "";
$table = "administrateur";
$dbname = "centralisation";
include 'modules/fcts.php';
if (isset($_POST['submit'])){
try {
    $conn = new PDO("mysql:host=$servername;dbname=centralisation", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (rowExists($conn,$table,"ida",$_POST["cin"])!=0){
    $sql = "DELETE FROM $table WHERE ida = ".$_POST['cin'];
    $conn->exec($sql);
    echo "<script>alertify.success('L\'élément est supprimé avec succes');</script>"; 
    }
    else{
        echo "<script>
            $(document).ready(function(){
              $('style:first').replaceWith('<style>.alertify-notifier .ajs-message.ajs-success {background: red ;color:white;}</style>');
            });
            </script>";
        echo "<script>alertify.success('Ce compte n\'existe pas!!!');</script>";
    }
}
catch(PDOException $e)
    {
        echo "<script>
            $(document).ready(function(){
              $('style:first').replaceWith('<style>.alertify-notifier .ajs-message.ajs-success {background: red ;color:white;}</style>');
            });
            </script>";
            echo '<script>alertify.success("'.$e->getMessage().'");</script>';	;
    }

$conn = null;
}
?>