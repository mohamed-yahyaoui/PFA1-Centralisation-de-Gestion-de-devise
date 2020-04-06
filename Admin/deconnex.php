<?php
session_start();
session_unset();
session_destroy();
$conn=null;
header("Refresh:0; url=Admin.php");

?>

       