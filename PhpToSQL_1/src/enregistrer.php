<?php
// Connects to your Database
require ("./src/config.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// Connects to your Database
    $connection=mysql_connect($host, htmlentities($login), htmlentities($passwd)) or die("impossible de se connecter");
    mysql_select_db($dbname) or die("impossible d'aller sur la bd");
    // checks if the username is in use

    $usercheck = addslashes($_POST['username']);
    $query="SELECT username FROM users WHERE username = '$usercheck'";
    $check = mysql_query($query) or die(mysql_error());
    $numberOfRow = mysql_num_rows($check);

    //if the name exists it gives an error
    if ($numberOfRow == 0) {//on doit faire mieux
        // now we insert it into the database
        $insert = "INSERT INTO users (username, password) VALUES ('".addslashes($_POST['username'])."','".md5($_POST['password'])."')";
        $add_member = mysql_query($insert);
    }
    mysql_close($connection);
?>
