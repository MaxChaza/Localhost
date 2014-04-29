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
            <form onsubmit="return checkParamLogin()" method="post">
                <table border="0">
                    <tr>
                        <td>
                            <h1>Login form</h1>
                        </td>
                    </tr>
                    <tr>
                        <td id="colorUsername" >Username:</td>
                        <td>
                            <!--onsubmit="checkParamLogin()"-->
                            <input type="text" name="username" id="username"  maxlength="20">
<!--                            <script  type="text/javascript" >
                                var keyUsername = document.getElementById('username');
                                keyUsername.focus();
                                keyUsername.select();
                            </script>-->
                        </td>
                    </tr>
                    <tr>
                        <td id="colorPassword" >Password:</td>
                        <td><input type="password" name="pass" id="pass" maxlength="20"></td>
                        <td><input type="hidden" name="nextPage" id="nextPage" value="member"/></td>
                    </tr>

                    <tr>
                        <td align="right"><input type="submit" name="submit" value="Login" class="myButton"></td>
                    </tr>
                    <tr>
                        <td>
                            Cliquer <a href="#" onclick="showContent('register')">ici</a> pour vous enregistrer
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php 
            include("./include/footer.php");
        ?>   
    </body>
</html>

