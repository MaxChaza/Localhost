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
         <link rel="stylesheet" type="text/css" href="../css/styleCss.css" />
       
        <?php include('../include/counter.php');?>
        
        
    </head>
    <body>
        <form name="myForm" action="./src/sendMail.php" onsubmit="return checkParam()" method="post">
            <table>  
                <tr>
                    <td id="colorPrenom">* Entrez prenom : </td>
                    <td><input type="text" id="prenom" name="prenom"/></td>
                </tr>
                <tr>
                    <td id="colorNom">* Entrez nom :</td>
                    <td><input type="text" id="nom" name="nom"/></td>
                </tr>
                <tr>
                    <td id="colorTelephone">* Entrez telephone :</td> 
                    <td><input type="text" id="telephone" name="telephone"/></td>
                    <td><div id="formatTelephone"></div></td>
                </tr>
                <tr>
                    <td id="colorMail">* Entrez mail :</td> 
                    <td><input type="text" id="mail" name="mail"/></td>
                    <td><div id="formatMail"></div></td>
                </tr>
                <tr>   
                    <td>  Entrez texte : </td>
                    <td><textarea name="message" rows=4 cols=40></textarea></td>
                </tr>
                <tr>
                    <td><input type="submit" value="go" /></td>
                    <td><input type="reset" value="reset"/></td>
                </tr>                    
            </table>
        </form>
    <!--                <form method="post" action="get-file.php" encode="">
                    <tr>  
                        <input type="file" 
                    </tr>
                </form>-->

        <div>
            (*) Les champs pr&eacute;c&eacute;d&eacute;s d'une &eacute;toile sont obligatoires.
        </div>
        
        <div>
            <?php  
                if(!empty($_POST['prenom']) && !empty($_POST['nom'])){
                    include('../include/onBosse.php'); 
                }
            ?>
        </div>
        <div id="footer">
             <?php  echo calc("../counter/counterContact.txt") ?> visitor. 
        </div>
    </body>
</html>
