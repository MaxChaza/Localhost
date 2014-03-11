<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link rel="stylesheet" type="text/css" href="./css/style.css" />
       
        <?php include('./include/counter.php');?>
         <script language="javascript" type="text/javascript">
            function checkParam(){
                var ok = true;
                if(document.myForm.prenom.value==""){
                    ok=false;
                    document.getElementById("starPrenom").innerHTML="*";
                }
                if(document.maForm.nom.value==""){
                    ok=false;
                    document.getElementById("starNom").innerHTML="*";
                }
                return ok;
            }
        </script>
    </head>
    <body>
        <div id="header">
            <?php 
                include("./include/header.php");
            ?> 
        </div>
        
        <form name="myForm" action="contact_us.php" onsubmit="return checkParam()" method="POST">
                    entrez prenom : <input type="text" name="prenom"/><br/>
                    <div id="starPrenom"></div>
                    entrez nom : <input type="text" name="nom"/><br/>
                    <div id="starNom"></div>
                    entrez telephone : <input type="text" name="telephone"/><br/>
                    <div id="starTelephone"></div>
                    entrez mail : <input type="text" name="mail"/><br/>
                    <div id="starMail"></div>
                    <input type="submit" value="go" /><input type="reset" value="reset"/><br/>
        </form>
        
        <form name="resetCounter" action="./include/reset.php" method="post">
            <input type="submit" value="resetCounter" >
        </form>
        
        <?php  if(isset($_POST['prenom']) && isset($_POST['nom'])){
                  include('./include/onBosse.php'); 
               }
        ?>
        
        <form method="post" action="get-file.php" encode="">
              <input type="file" 
        </form>
        
        <div id="footer">
             <?php  echo calc("./counter/counterContact.txt") ?> visitor. 
        </div>
    </body>
</html>
