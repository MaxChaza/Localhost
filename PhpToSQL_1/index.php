<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
    <head>
        <title>Fisrt php</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="./styleCss.css" />
        <?php include('./include/counter.php');?> 
        <script language="javascript" type="text/javascript" src="./js/checkParam.js"></script>
        <script language="javascript" type="text/javascript" src="./js/ajaxUpload.js"></script>
        <script language="javascript" type="text/javascript" src="./js/ajaxCode.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <!--<script type="text/javascript" src="./js/jquery.js"></script>-->
    </head>
    <body>
        <?php 
        // Connects to your Database
        if(isset($_POST['nextPage']))
        {
            if($_POST['nextPage']=='reponseRegister')
            {
                include("./src/enregistrer.php");
            ?>
                <script type="text/javascript">
                $(function() {
                // Déclaration d'attributs.
                    var page = '<?php echo $_POST['nextPage']; ?>';
                    showContent(page);
                 });
                </script>
            <?php
            }
            if($_POST['nextPage']=='membre')
            {
                include("./src/connecterMembre.php");
                if((isset($_SESSION["username"])) && (isset($_SESSION["password"]))){
            ?>
                    <script type="text/javascript">
                    $(function() {
                    // Déclaration d'attributs.
                        var page = '<?php echo $_POST['nextPage']; ?>';
                        showContent(page);
                     });
                    </script>
            <?php
                }
            }
        }
        ?>
        
        <div id="ligneNoir" >
	</div>
        
	<div id="ligne" >
	</div>

        <div id="header">
            <?php 
                include("./include/header.php");
            ?> 
        </div>
        <div id="content">
            Welcome on our website
            <div id="titre"></div>
        </div>
        


        <?php 
            include("./include/footer.php");
        ?>   
    </body>
</html>
