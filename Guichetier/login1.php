<?php
        
        try{
            $base = new PDO("mysql:host=localhost", "root", "");
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
           $base->exec("use centralisation;");
            //$exx='exx';
           
    }
    catch(PDOException $e)
    {
    echo "";
    } 
    ?>
<html>
    <head>
        <style>
        #glob{
        margin: 0px;

        height:600px;
        max-width : 100%;
        background-image: url("bb.png");
        background-size: cover;
        opacity: 1;

        border-radius: 10px;
        }
        body
        {
            top: 5%;
            overflow: hidden;
        }
        #gauche{
        width: 60%;
        height: 600px;
        float: left;
        
        }
        #droite{

        width: 40%;
        height: 600px;
        float: right; 
        background-image: url("b1.png");  
        border-radius: 7px;
        }

        #button 
        {
            background-color: #008CBA;
        padding : 2% 5%;
        text-align : center;
        display: inline-block;
        color : white ;
        border : none;
        border-radius: 7px;
        transition-duration: 0.4s;
        opacity: 1;
        }
        #button:hover {
        background-color: rgb(115, 204, 118);
        color: white;
        cursor: pointer;
        }
        form
        {
            padding-top: 6%;
            padding-left: 3%;
        }
        label
        {
            color: #008CBA;
            font-size: x-large;
            
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance:textfield;
        }
        input
        {
            border-radius: 9px;
            opacity: 0.75;
            font-size: larger;
            overflow: hidden;
        }
        </style>
    </head>
    <body>
        <div id="glob">        
            <div id="gauche">
                 
            </div>
            <div id="droite"">
                <h1 style="color: #03769c;padding-top: 18%;">&nbsp;Espace Guichetier</h1>
                    <form  method="POST">
                    <label for="fid"><strong>Identifiant:</strong></label></br>
                     <input type="number" id="fid" name="idd"><br><br>
                    <label for="pass"><strong>Mot de passe:</strong></label></br>
                     <input type="password" id="pass" name="pass"><br><br>
                    <input id="button" type="submit" name="conn" value="Connecter">
                    
                  </form>
                  <?php
                  if(!(isset($_POST['idd']) && isset($_POST['pass']))&& isset($_POST['conn']))
                  {
                      
                    echo "<h2 style=\"color:red;\">*Identifiant ou Mot de passe incorrecte(s)</h2> ";
                  }
                  else
                  {
                      if((isset($_POST['idd']) && isset($_POST['pass']))&& isset($_POST['conn']))
                      {
                  
                          $i=$_POST['idd'];
                          $p=$_POST['pass'];
                          function exist($i,$p)
                          {
                              global $base;
                              $ch=$base->query("SELECT idg,passwd_g FROM guichetier ;");
                              foreach($ch as $row)
                              {
                                  if ($row['idg']==$i && $row['passwd_g']==$p)
                                  {return 1;}
                              }
                              return 0;
                          }
                          if (exist($i,$p)==0)
                          {echo "<h2 style=\"color:red;\">*Identifiant ou Mot de passe incorrecte(s)</h2> ";}
                          else
                          {
                              session_start();
                              $_SESSION['idd']=$_POST['idd'];
                              $_SESSION['pass']=$_POST['pass'];
                              $t = date("Y-m-d H:i:s");
                              $h=$base->query("UPDATE guichetier set ddl_g='$t' where idg='$i';");
                              header("Refresh:0; url=gui.php");
                          }
                          
                      }
                  } 
                  ?>
                
            </div>
        </div>
    </body>
</html>