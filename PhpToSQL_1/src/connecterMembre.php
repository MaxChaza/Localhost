<?php
include("./src/config.php");
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
        die("Vous n'existez pas. Cliquer <a href=\"#\" onclick=\"showContent('register')\">ici</a> pour vous enregistrer");
    }
    
    //Recherche du password
    $trouve=FALSE;
    
    while(($result = mysql_fetch_array($check)) && ($trouve==FALSE)){
        if (md5($_POST['pass']) == $result["password"]){
            //on doit maintenant checker le password maison le fait pas pour l'instant
            //tout est OK - on ferme la connection et on envoie le client sur la page input.php
            mysql_close($connection);
            $trouve=TRUE;
            
            // Avec COOKIES 
            //setcookie("yourname", $_POST['username'], time() + 3600);
           
            session_start();
            $_SESSION['username']=$_POST['username'];
            $_SESSION['password']=$_POST['pass'];
            
        }
    }
}
?>

<td id="reponse" colspan="0">
<?php
    if(!$trouve)
     {
     ?>
         <script type="text/javascript">
            $(function() {
            // Déclaration d'attributs.
                showContent("login");
             });
         </script>
         <div id="titre" color="red">
             Votre password et votre login ne correspondent pas. 
         </div>
     <?php
     }
     ?>
 </td>
