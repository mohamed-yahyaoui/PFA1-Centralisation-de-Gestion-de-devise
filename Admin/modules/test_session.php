<?php 
session_start();
$s=count($_SESSION);
if($s==0)
	header("Refresh:0; url=Admin.php");
?>