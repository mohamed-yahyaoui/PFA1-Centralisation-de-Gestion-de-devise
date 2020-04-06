<?php

if (isset($_POST['submit'])){
try {
    $conn=dbconnect($servername,$dbname,$username,$password);
 
		$test=False;
		$tab=$conn->query("SELECT idg,nom_banque_g FROM $table ORDER BY idg;");
		 foreach($tab as $ligne)
            {
                if ($ligne['idg']==$_POST["cin"] && $ligne['nom_banque_g']==$_SESSION['BANQUE'])
                {$test=True;
                
				}
            }
		
	if($test==True){	
		
		
		
    $sql = "DELETE FROM $table WHERE idg = ".$_POST['cin'];
    $conn->exec($sql);
  $_SESSION['msg']="L\'élément est supprimé avec succes";
	header("Refresh:0; url=compte.php");
	  echo "<script>alertify.success('L\'élément est supprimé avec succes');</script>"; 
    }
    else{
        echo "<script>
            $(document).ready(function(){
              $('style:first').replaceWith('<style>.alertify-notifier .ajs-message.ajs-success {background: red ;color:white;}</style>');
            });
            </script>";
        echo "<script>alertify.success('Ce compte n\'existe pas !!!');</script>";
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
        //echo $e->getMessage();
    }

$conn = null;
}
?>