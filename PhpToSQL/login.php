<?php
include("./config.php");
$trouve=TRUE;
if (isset($_POST['username'])) { 
    $connection=mysql_connect($host, $login, $passwd) or die("impossible de se connecter");
    mysql_select_db($dbname) or die("impossible d'aller sur la bd");

//    $connection=mysqli_connect($host, $login, $passwd, $dbname) or die("impossible de se connecter");
    
    //RECHERCHE DU USER
    $query="SELECT * FROM ".$table."  WHERE username = '".$_POST['username']."'";
    $check = mysql_query($query) or die("essayer plus tard!");
//    $check = mysqli_query($connection, $query) or die("essayer plus tard!");

    //si le client n'est pas ds la bd il doit s'enregistrer
    $numberOfRow = mysql_num_rows($check);
    if ($numberOfRow == 0) {
        //il n'y a aucune ligne correspondante
        die("Vous n'existez pas. Cliquer <a href=register.php>ici</a> pour vous enregistrer");
    }
    
    //Recherche du password
    $trouve=FALSE;
    
    while(($result = mysql_fetch_array($check)) && ($trouve==FALSE)){
        if (md5($_POST['pass']) == $result["password"]){
            //on doit maintenant checker le password maison le fait pas pour l'instant
            //tout est OK - on ferme la connection et on envoie le client sur la page input.php
            mysql_close($connection);
            $trouve=TRUE;
            
            setcookie("yourname", $_POST['username'], time() + 3600);
            $header="location:member.php?nom=".$_POST['username'];//on edans l'URLnvoie avec methode GET name=valeur 
            header($header);
        }
    }
    
}
// le client n'est pas loge - regardez bien imbrication php-html
//regardez bien comment j'execute le fichier lui meme au lieu d'aller ailleurs
//on envoie le formulaire
?>
    <script language="javascript" type="text/javascript" src="./js/checkParam.js">
    </script>
    
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <table border="0">
            <tr>
                <td>
                    <h1>Login form</h1>
                </td>
            </tr>
            <tr>
                <td id="colorUsername" colspan="0">Username:</td>
                <td>
                    <input type="text" name="username" id="username" onsubmit="checkParamLogin()" maxlength="20">
                    <script  type="text/javascript" >
                        var keyUsername = document.getElementById('username');
                        keyUsername.focus();
                        keyUsername.select();
                    </script>
                </td>
            </tr>
            <tr>
                <td id="colorPassword" colspan="0">Password:</td>
                <td>
                    <input type="password" name="pass" id="pass" maxlength="20">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="submit" name="submit" value="Login">
                </td>
            </tr>
            <tr>
                <td>
                    Cliquer <a href=register.php>ici</a> pour vous enregistrer
                </td>
                <td id="reponse" colspan="0">
                    <?php
                    if(!$trouve)
                    {
                    ?>
                        <div id="reponse" color="red">
                            Votre password et votre login ne correspondent pas. 
                        </div>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
    </form>
</body>

