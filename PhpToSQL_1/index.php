<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
    <head>
        <title>Fisrt php</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="./styleCss.css" />
        <?php include('./include/counter.php');?> 
        <script language="javascript" type="text/javascript" src="./js/ajaxDate.js"></script>
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
            $nextPage = $_POST['nextPage'];
            if($nextPage =='reponseRegister')
            {
                $numberOfRow=0;
                include("./src/enregistrer.php");
                if($numberOfRow==0){
            ?>
                
                    <script type="text/javascript">
                    $(function() {
                    // Déclaration d'attributs.
                        var page = '<?php echo $nextPage; ?>';
                        showContent(page);
                     });
                    </script>
                <?php
                }
                else
                {
                    ?>
                    <script type="text/javascript">
                        $(function() {
                        // Déclaration d'attributs.
                            showContent("userExist");
                         });
                    </script>
        <?php
                }
            }
            if($nextPage=='member')
            {
                include("./src/connecterMembre.php");
                if((isset($_SESSION["username"])) && (isset($_SESSION["password"]))){
            ?>
                    <script type="text/javascript">
                    $(function() {
                    // Déclaration d'attributs.
                        var page = '<?php echo $nextPage; ?>';
                        showContent(page);
                     });
                    </script>
            <?php
                }
            }
            if($nextPage=='mailEnvoye')
            {
                $mail_status=0;
                include("./src/sendMail.php");
                if($mail_status)
                {
                ?>
                    <script type="text/javascript">
                    $(function() {
                    // Déclaration d'attributs.
                        var page = '<?php echo $nextPage; ?>';
                        showContent(page);
                     });
                    </script>
                    <?php 
                }
                else 
                {
                ?>
                <script type="text/javascript">
                    window.alert("Une erreur s'est produite, votre mail n'a pas été envoyé.")
                </script> 
                <?php 
                }
            }
            if($nextPage=='serviceRendu')
            {
            ?>
                    <script type="text/javascript">
                    $(function() {
                    // Déclaration d'attributs.
                        var page = '<?php echo $nextPage; ?>';
                        showContent(page);
                        upload();
                     });
                    </script>
            <?php
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

