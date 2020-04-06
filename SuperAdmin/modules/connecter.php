<?php

if (isset($_POST['go'])){
$servername = "localhost";
$username = "mohamed";
$password = "TxMdyFb21";
$table = "superadministrateur";

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
		 $tab=$conn->query("SELECT IDS,passwd_s,nom_s FROM $table ORDER BY IDS;");
		 foreach($tab as $ligne)
            {
                if ($ligne['IDS']==$iden && $ligne['passwd_s']==$pas)
                {$test=True;
                $nom=$ligne['nom_s'];}
            }
            if($test ==False)
				{echo "<script>alertify.success('*Identifiant ou Mot de passe incorrecte(s)!!!');</script>";}
			else 
				{
            $sql = "UPDATE $table SET ddl_s='".date("Y-m-d H:i:s")."' WHERE IDS = ".$iden;
            $conn->exec($sql);        
            session_start();
            $_SESSION['ID']=$_POST['cin'];
            $_SESSION['PASSWD_s']=$_POST['mpass'];
            $_SESSION['ouvert']=0;
            $_SESSION['NOM']=$nom;
            $_SESSION['msg']='';
            header("Refresh:0; url=compte.php");
        }
		
		
	}
}}
catch(PDOException $e)
    {
    echo '<script>alertify.success("'.$e->getMessage().'");</script>';	

}}
?>