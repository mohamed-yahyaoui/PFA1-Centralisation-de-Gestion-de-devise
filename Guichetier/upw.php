<?php
session_start ();
try{
    $base = new PDO("mysql:host=localhost", "root", "");
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   try 
   { $base->exec("CREATE DATABASE centralisation");}
   catch(PDOException $e)
   {echo "";}
   $base->exec("use centralisation;");
   
}
catch(PDOException $e)
{
echo "";
} 
if (isset($_SESSION['idd']) && isset($_SESSION['pass']))
{
    $i=$_SESSION['idd'];$p=$_SESSION['pass'];
}
else
{
    header("Refresh:0; url=login1.php");
}
?>
 <html style="height:100%">
    <head>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Espace Guichetier</title>
        <link rel="stylesheet" href="style_g.css">
    </head>

    <body style="height:100%;overflow: hidden;">
    <div id=fdiv>
        <div style="opacity:0.7;" id=gauche>
            <form method=POST ><br><br><br><br><br>
                <button type="submit" name="ho" class="btn" style="padding-right: 71.5px;"><i class="fa fa-pencil"> Espace de travail</i></button><br><br>
                <button type="submit" name="pw" class="btn" style="padding-right: 135px;"><i class="fa fa-id-badge"> Mon Profil</i></button><br><br>
                <button type="submit" name="bu" class="btn" style="padding-right: 171px;"><i class="fa fa-power-off"> Quitter</i></button>
            </form>
            <?php
                if(isset($_POST['bu']))
                {
                    session_unset ();    
                    session_destroy ();

                    header ("Refresh:0;url=login1.php");
                }
                if(isset($_POST['ho']))
                {
        
                    header ("Refresh:0;url=gui.php");
                }
                if(isset($_POST['pw']))
                {
                    header ("Refresh:0;url=upw.php"); 
                }
            ?>
        </div>
        
        <div id=droite >
        <br><br><br><br><br>
        <h1 id=tit>Mon Profil</h1><hr><br><br>

                <?php
                
                
                $ch=$base->query("SELECT * FROM guichetier where idg='$i';");
                
                echo"<table >";
                        foreach($ch as $row)
                        {
                            echo "<tr><td ><h3 id=tit2 >Identifiant: </td>"; echo"<td><h2 id=tit2 >". $row['idg']."</h2></td></tr> ";      
                            echo "<tr><td ><h3 id=tit2 >Prenom: </td>"; echo"<td><h2 id=tit2 >". $row['prenom_g']."</h2></td></tr> ";
                            echo "<tr><td ><h3 id=tit2 >Nom: </td><td><h2 id=tit2 >".$row['nom_g']."</h2></td></tr> ";
                            echo "<tr><td ><h3 id=tit2 >Mon Mail: </td><td><h2 id=tit2 >".$row['email_g']."</td></tr> ";
                            echo "<tr><td ><h3 id=tit2 >Nom Banque: </td><td><h2 id=tit2 >".$row['Nom_banque_g']."</td></tr> ";
                        
                        }  
                echo"</table>";
                 
                ?>
               
        
            
        </div>
    </body>
</html>