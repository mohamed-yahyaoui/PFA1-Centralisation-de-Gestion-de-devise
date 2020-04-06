<?php

if (isset($_POST['go'])){
try {
    $conn = new PDO("mysql:host=$servername;dbname=centralisation", $username, $password);
   
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	 if(!(isset($_POST['go']) && isset($_POST['mpass']))&& isset($_POST['cin']))
{
    
   echo "<script>alertify.success('*Identifiant ou Mot de passe incorrecte(s)!!!');</script>";
}
else
{
    if((isset($_POST['go']) && isset($_POST['mpass']))&& isset($_POST['cin']))
    {

        $iden=$_POST['cin'];
        $pas=$_POST['mpass'];
		$test=False;
		 $tab=$conn->query("SELECT IDA,passwd_a,nom_a ,NOM_BANQUE_A FROM $table ORDER BY IDA;");
		 foreach($tab as $ligne)
            {
                if ($ligne['IDA']==$iden && $ligne['passwd_a']==$pas)
                {$test=True;
                $nom=$ligne['nom_a'];
				$banque=$ligne['NOM_BANQUE_A'];
				}
            }
            if($test ==False)
				{echo "<script>alertify.success('*Identifiant ou Mot de passe incorrecte(s)!!!');</script>";}
			else 
				{
            session_start();
            $_SESSION['ID']=$_POST['cin'];
            $_SESSION['PASSWD_a']=$_POST['mpass'];
            $_SESSION['ouvert']=0;
            $_SESSION['NOM']=$nom;
			$_SESSION['BANQUE']=$banque;
			$_SESSION['msg']="";
			$t = date("Y-m-d H:i:s");
		
            $h=$conn->query("UPDATE administrateur set DDL_A='$t' WHERE IDA = '$iden';");
         
            header("Refresh:0; url=compte.php");
        }
		
		
	}
}}
catch(PDOException $e)
    {
		
    echo '<script>alertify.success("Il ya quelques problèmes!!!Essayer une autre fois);</script>';	
        //uncomment to get error
        echo $e->getMessage();
   
}}
?>