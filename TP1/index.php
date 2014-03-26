<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fisrt php</title>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" href="./css/myCss.css" />
        <?php include('./include/counter.php');?>
         <script type="text/javascript">
            <!-- Debut
            // JavaScript pris sur le site: "http://www.java.scripts-fr.com"

            if (document.body)
            {
            var larg = (document.body.clientWidth);
            var haut = (document.body.clientHeight);
            }

            /*
            Ici une version DOM (le script est entre les balises <body> et </body>) qui devrait fonctionner sur tous les navigateurs.
            On commence donc par détecter la présence de l'objet body dans le DOM.
            Si il est présent, on va mettre dans 2 variables larg et haut la largeur et la hauteur de la fenêtre pris avec les propriétés clientWidth et clientHeight de l'objet body.
            */

            else
            {
            var larg = (window.innerWidth);
            var haut = (window.innerHeight);
            }

            /*
            Cette version est purement javascript et ne fonctionne pas sous IE (les propriétés innerWidth et innerHeight de l'objet window n'ayant pas été intégrée dans ce navigateur).
            Si l'objet n'existe pas, on met dans nos variables la hauteur et la largeur de la page. Seulement on utilisera ici les propriété innerWidth et innerHeight de l'objet window.
            */

            document.write("Cette fenêtre fait " + larg + " de large et "+haut+" de haut");

            // ensuite on en fait ce que l'on veut, la je les écrit avec la méthode write
            // de l'objet document

            // fin du script -->
        </script> 
    </head>
    
    <body>
        <div>
        <div id="header">
            <?php 
                include("./include/header.php");
            ?> 
        </div>
        <div>
            Coucou
            <form name="myForm" action="./include/reset.php" onsubmit="return checkParam()" method="post">
                <input type="submit" value="resetCounter"/>
            </form>
        </div>
        <div id="footer">
            <?php 
                echo calc("./counter/counterIndex.txt"); 
            ?> visitor. 
        </div>
    </body>
</html>