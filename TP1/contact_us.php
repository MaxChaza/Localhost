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
        <div id="formulaire"> 
            
            <form name="myForm" action="contact_us.php" onsubmit="return checkParam()" method="POST">
                <table>  
                    <tr>
                        <td>entrez prenom : </td>
                        <td><input type="text" name="prenom"/></td>
                        <div id="starPrenom"></div>
                    </tr>
                    <tr>
                        <td>entrez nom :</td>
                        <td><input type="text" name="nom"/></td>
                        <div id="starNom"></div>
                    </tr>
                    <tr>
                        <td>entrez telephone :</td> 
                        <td><input type="text" name="telephone"/></td>
                        <div id="starTelephone"></div>
                    </tr>
                    <tr>
                        <td>entrez mail :</td> 
                        <td><input type="text" name="mail"/></td>
                        <div id="starMail"></div>
                    </tr>
                    <tr>   
                        <td>entrez texte : </td>
                        <td><textarea name="textarea" rows=4 cols=40></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="go" /></td>
                        <td><input type="reset" value="reset"/></td>
                    </tr>
                
                    <tr>
                        <td><input type="submit" value="resetCounter" onclick = "document.forms['myForm'].action='./include/reset.php';" /></td>
                    </tr>
                </table>
            </form>
<!--                <form method="post" action="get-file.php" encode="">
                <tr>  
                    <input type="file" 
                </tr>
            </form>-->
            </div>
        
        
        <div>
            <?php  
                if(isset($_POST['prenom']) && isset($_POST['nom'])){
                    include('./include/onBosse.php'); 
                }
            ?>
        </div>
        <div id="footer">
             <?php  echo calc("./counter/counterContact.txt") ?> visitor. 
        </div>
    </body>
</html>
