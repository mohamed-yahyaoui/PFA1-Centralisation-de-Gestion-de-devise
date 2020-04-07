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
    
    //////////////////////////////////////////
   /* if ($da == "01-01 00:00:00")
    {
        foreach ($mon as $r)
        {
            $r['Montant']=0;
            
        }   
        echo $r['Montant'];
        
        $up=$base->query("UPDATE transcrire SET Montant = '0';");
    }*/
    /////////////////////////////////////////////
}
else
{
	header("Refresh:0; url=login1.php");
}
?>
 <html style="height:100%">
    <head>
    <script>
function imprimer(divName) {

      var printContents = document.getElementById(divName).innerHTML;    
   var originalContents = document.body.innerHTML; 
   //document.body.style.backgroundImage = "url('b1.png')";  
   document.getElementById(divName).style.margin = "500px 200px";  
   
   document.getElementById("fdiv").innerHTML = printContents;  
   window.print();     
   document.body.innerHTML = originalContents;
   }
   
</script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <style>
            #sectionAimprimer
            {
                margin:0 auto;
            }
        .alertify-notifier .ajs-message.ajs-success {background: #03769c ;color:white;height:60px;text-align:center;font-size:30px;}
        </style>
        <style>
        .ajs-buttons .ajs-ok {background: #006B38FF;}
        .ajs-buttons .ajs-cancel {background : red;}
        .ajs-content {font-size:large;font-weight:bold;}
        </style>
        <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <!-- jQuery -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="cin.js"></script>
        <!-- Font -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
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
        <br><br>
        <br><br>

                <form action="gui.php" method=POST>
                    <label for=rech><h1 id=tit style="margin-top:-5%;">Tapez Le numrero du CIN</h1></label></br>
                    <input type=number class=barr id=rech name=ci placeholder=exp:12345678 autocomplete=off>
                    <input type="hidden" id="hg" name="hg" value="<?php echo"".$i."".$p.""; ?> ">
                    <button type=submit id=button style="font-size:20px;"><i class="fa fa-search" style="margin-top:2px;"> Rechercher</i></button>
                </form>
                <hr >
            
            
                 
                <?php
                
                if(isset($_POST['ci']) || isset($_POST['b']) )
                {
                    echo "<h1 id=tit2>Infos du Passager</h1> ";
                    $c=$_POST['ci'];
                    
                    function existc($c)
                    {
                        global $base;
                        $ch=$base->query("SELECT cin FROM client;");
                        foreach($ch as $row)
                        {
                            if ($row['cin']==$c)
                            {return 1;}
                        }
                        return 0;
                    }
                    
                    $h=$base->query("SELECT * FROM client where cin='$c';");
                    if(existc($c)==1)
                    {
                        $dtr=date("Y");
                        
                        $sup=$base->query("SELECT SUM(Montant) FROM transcrire WHERE cin='$c' and date_tr LIKE '$dtr%';");
                        
                        foreach($sup as $r)
                        {
                            $quota=6000-$r['SUM(Montant)'];
                        }
    
                        
                        $up=$base->query("INSERT INTO transcrire(cin,idg,Montant)VALUES('$c',$i,'0');");
                        $ntr=$base->query("SELECT MAX(N_tr) FROM transcrire;");
                        foreach($ntr as $f)
                        {
                            $nt=$f['MAX(N_tr)'];
                        }
                        echo"<table >";
                        foreach($h as $row)
                        {      
                            echo "<tr><td ><h3 id=tit2 >Nom: </td>"; echo"<td><h3 id=tit2 >". $row['nom_c']."</h3></td></tr> ";
                            echo "<tr><td ><h3 id=tit2 >Prenom: </td><td><h3 id=tit2 >".$row['prenom_c']."</h3></td></tr> ";
                            echo "<tr><td ><h3 id=tit2 >Quota Disponible: </td><td><h3 id=tit2 >".round($quota,2)."</td></tr> ";
                        
                        }  
                        echo"</table>";
                        $l=$quota;
                        
                        //var_dump($p); 
                        echo "<form method=POST>
                        <label for=rech><h1 id=tit>Effectuer la transaction</h1></label></br>";?>
                        <input type=hidden class=barr id=rech name=ci value="<?php echo $c ?>">
                        <?php
                        echo"<input type=number step=0.01 class=barr id=rech name=m placeholder=\"Entrer la somme à transcrire\" autocomplete=off></br>
                        <select size=1 class=barr name=sel>
                        <option selected>EURO</option>
                        <option>DOLAR USA</option>
                        <option>YUAN CHINOIS</option>
                        <option>LIVRE STERLING</option>
                        <option>DOLLAR CANADIEN</option>
                        </select></br>
                        <input type=submit id=button value=Transcrire name=tr>
                        </form>";
                    
                        if(isset($_POST['tr']) )
                        {
                            if(isset($_POST['sel'])&& isset($_POST['m'])  )
                            {
                                $c=$_POST['ci'];
                                $sel=$_POST['sel'];
                                $quota=$l - $_POST['m'];
                                $mon=$_POST['m'];
                                if($quota>=0 && ($_POST['m'])>=0)
                                {
                                    $tux=NULL;
                                    $t = date("Y-m-d H:i:s");
                                    //$f=$base->query("UPDATE client set quota_dispo='$q' where cin='$c' ;");
									//$f=$base->query("UPDATE client set ddt='$t' where cin='$c' ;");
                                    switch($sel)
                                    {
                                        
                                        case 'EURO':$tux= 1/3.1814 ;break;
                                        case 'DOLAR USA':$tux=1/2.8260;break;
                                        case 'YUAN CHINOIS':$tux=1/0.4075;break;
                                        case 'LIVRE STERLING':$tux=1/3.5932;break;
                                        case 'DOLLAR CANADIEN':$tux=1/2.0613;break;
                                        
                                    }
                                    //$base->query("DELETE FROM transcrire WHERE  Montant=0;");
                                    $k=$base->query("UPDATE transcrire set Montant='$mon' ,devise='$sel',taux='$tux',date_tr='$t' WHERE N_tr=$nt-1;");
                                    //$k=$base->query("UPDATE transcrire set taux='$tux' where cin='$c';");
                                    //header("Refresh:0; url=gui.php");
                                    echo "<h2 style=\"color:green;\">Transaction éffectué avec succés</h2> ";
                                    $gg=round($tux*$mon,2);
                                    echo "<h3 id=tit>Le montant transcrit: $gg $sel </h2> ";
                                    
                                    
                                    echo"<h2 id=tit>";
                                        $quota=round($quota,2);
                                    echo "Nouveau Quota Disponible: \"".$quota."\"</br> ";

                                    echo "</h2>";
                                    echo "<button id=button onClick=\"imprimer('sectionAimprimer')\"><i class=\"fa fa-print\" style=\"margin-top:2px;\"> Imprimer</i></button>";
                                    echo"<div id=sectionAimprimer>
                                    <h1>ID Client :".$c."</h1>";
                                    
                //N_tr Montant devise date_tr
                                    $req=$base->query("SELECT * FROM transcrire WHERE Montant !='0' and cin='$c' and date_tr like '$dtr%';");
                                    echo "<table border=1 style=\"width:100%;radius:0%;\">";
                                    echo"<tr><th>N° de transaction</th><th>Montant</th><th>Devise</th><th>Date de transaction</th></tr>";
                                    foreach($req as $row)
                                    {
                                        echo "<tr>";
                                        echo "<td>".$row['N_tr']."</td>";
                                        echo "<td>".$row['Montant']."</td>";
                                        echo "<td>".$row['devise']."</td>";
                                        echo "<td>".$row['date_tr']."</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                            
                                    echo"</div>";
                                }

                                else
                                {
                                    echo "<h2 style=\"color:red;\">Transaction échouée !</h2>";

                                }
                                

                            }
                        }   
                    

                    }
                    else
                    {
                        echo"<form id=fr action=gui.php method=POST>";?>
                            <input type=hidden class=barr id=rech name=ci value="<?php echo $c ?>">
                            <label ><h1 id=tit>Tapez Le nom du client</h1></label></br>
                            <input type=text class=barr id=rech name=na autocomplete=off>
                            <label ><h1 id=tit>Tapez Le prenom du client</h1></label></br>
                            <input type=text class=barr id=rech name=pna autocomplete=off></br>
                            <button type=submit id=button name=b>Ajouter</button>
                            
                        </form>
                        
                        <?php
                        if(isset($_POST['ci'])&&isset($_POST['na'])&&isset($_POST['pna']))
                            {
                                $_SESSION['ci']=$_POST['ci'];$w=$_POST['na'];$l=$_POST['pna'];$temp = date("Y-m-d H:i:s");$c=$_SESSION['ci'];
                                //echo$w;
                                $m=$base->query("INSERT INTO client VALUES('$c','$w','$l');");
                                echo "<script>var x=document.getElementById(\"fr\").style.display=\"none\";</script> ";
                                //echo "<h2 style=\"color:green;\">Client ajouté avec succés</h2> ";
                                echo "<script>alertify.success('Client ajouté avec succes');</script>"; 
                                //header("Refresh:0;url=gui.php");
                                if(existc($c)==1)
                                {
                                    $sup=$base->query("SELECT SUM(Montant) FROM transcrire WHERE cin='$c';");
                                    
                                    foreach($sup as $r)
                                    {
                                        $quota=6000-$r['SUM(Montant)'];
                                    }
                                
                                    
                                    $upp=$base->query("INSERT INTO transcrire(cin,idg,Montant)VALUES('$c',$i,'0');");
                                    $ntr=$base->query("SELECT MAX(N_tr) FROM transcrire;");
                                    foreach($ntr as $f)
                                    {
                                        $nt=$f['MAX(N_tr)'];
                                    }
                                    echo"<table >";
                                    $h=$base->query("SELECT * FROM client where cin='$c';");
                                    foreach($h as $row)
                                    {      
                                        echo "<tr><td ><h3 id=tit2 >Nom: </td>"; echo"<td><h3 id=tit2 >". $row['nom_c']."</h3></td></tr> ";
                                        echo "<tr><td ><h3 id=tit2 >Prenom: </td><td><h3 id=tit2 >".$row['prenom_c']."</h3></td></tr> ";
                                        echo "<tr><td ><h3 id=tit2 >Quota Disponible: </td><td><h3 id=tit2 >".$quota."</td></tr> ";
                                    
                                    }  
                                    echo"</table>";
                                    
                                    $l=$quota;
                                    
                                    //var_dump($p); 
                                    echo "<form method=POST>
                                    <label for=rech><h1 id=tit>Effectuer la transaction</h1></label></br>";?>
                                    <input type=hidden class=barr id=rech name=ci value="<?php echo $c ?>">
                                    <?php
                                    echo"<input type=number class=barr id=rech name=m placeholder=\"Entrer la somme à transcrire\" autocomplete=off></br>
                                    <select size=1 class=barr name=sel>
                                    <option selected>EURO</option>
                                    <option>DOLAR USA</option>
                                    <option>YUAN CHINOIS</option>
                                    <option>LIVRE STERLING</option>
                                    <option>DOLLAR CANADIEN</option>
                                    </select></br>
                                    <input type=submit id=button value=Transcrire name=tr>
                                    </form>";
                                
                                    if(isset($_POST['tr']) )
                                    {
                                        if(isset($_POST['sel'])&& isset($_POST['m'])  )
                                        {
                                            $c=$_POST['ci'];
                                            
                                            $sel=$_POST['sel'];
                                            $quota=$l - $_POST['m'];
                                            $mon=$_POST['m'];
                                            if($quota>=0 && ($_POST['m'])>=0)
                                            {
                                                $tux=NULL;
                                                $t = date("Y-m-d H:i:s");
                                                //$f=$base->query("UPDATE client set quota_dispo='$q' where cin='$c' ;");
                                                //$f=$base->query("UPDATE client set ddt='$t' where cin='$c' ;");
                                                switch($sel)
                                                {
                                                    
                                                    case 'EURO':$tux= 1/3.1814 ;break;
                                                    case 'DOLAR USA':$tux=1/2.8260;break;
                                                    case 'YUAN CHINOIS':$tux=1/0.4075;break;
                                                    case 'LIVRE STERLING':$tux=1/3.5932;break;
                                                    case 'DOLLAR CANADIEN':$tux=1/2.0613;break;
                                                    
                                                }
                                                //$base->query("DELETE FROM transcrire WHERE  Montant=0;");
                                                $k=$base->query("UPDATE transcrire set Montant='$mon' ,devise='$sel',taux='$tux',date_tr='$t' WHERE N_tr=$nt-1;");
                                                //$k=$base->query("UPDATE transcrire set taux='$tux' where cin='$c';");
                                                //header("Refresh:0; url=gui.php");
                                                echo "<h2 style=\"color:green;\">Transaction éffectué avec succés</h2> ";
                                                $gg=round($tux*$mon,2);
                                                echo "<h3 id=tit>Le montant transcrit: $gg $sel </h2> ";
                                                $h=$base->query("SELECT * FROM client where cin='$c';");
                                                foreach($h as $row)
                                                {      echo"<h2 id=tit>";
                                                    
                                                    echo "Nouveau Quota Disponible: \"".$quota."\"</br> ";
                                                    echo "</h2>";
                                                }
                                                echo "<button id=button onClick=\"imprimer('sectionAimprimer')\"><i class=\"fa fa-print\" style=\"margin-top:2px;\"> Imprimer</i></button>";
                                    echo"<div id=sectionAimprimer>
                                    <h1>ID Client :".$c."</h1>";
                                    
                //N_tr Montant devise date_tr
                                    $req=$base->query("SELECT * FROM transcrire WHERE Montant !='0' and cin='$c' and date_tr like '$dtr%';");
                                    echo "<table border=1 style=\"width:100%;radius:0%;\">";
                                    echo"<tr><th>N° de transaction</th><th>Montant</th><th>Devise</th><th>Date de transaction</th></tr>";
                                    foreach($req as $row)
                                    {
                                        echo "<tr>";
                                        echo "<td>".$row['N_tr']."</td>";
                                        echo "<td>".$row['Montant']."</td>";
                                        echo "<td>".$row['devise']."</td>";
                                        echo "<td>".$row['date_tr']."</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                            
                                    echo"</div>";
            
                                            }
                                            else
                                            {
                                                echo "<h2 style=\"color:red;\">Transaction échouée !</h2>";
            
                                            }
                                            
            
                                        }
                                    }   
                                
            
                                }
                            }
                    }

                }
                $base->query("DELETE FROM transcrire WHERE  N_tr > ALL (SELECT N_tr FROM transcrire);");
                ?>
            
            
        </div>
    </body>
</html>
