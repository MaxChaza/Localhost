<?php
    // Connects to your Database
    include("./config.php");
    //This code runs if the form has been submitted
    
    if (isset($_POST['submitRegister'])) {
//        if ($_POST['password']!=$_POST['password2'])
//            die('Sorry, pasword different.');
//        //This makes sure they did not leave any fields blank
//        if (!$_POST['username']  ) {//doit se faire cote client avec javascript
//            die('You did not complete all of the required fields');
//        }
        //on se connecte
        $connection=mysql_connect($host, $login, $passwd) or die("impossible de se connecter");
        mysql_select_db($dbname) or die("impossible d'aller sur la bd");
        // checks if the username is in use

        $usercheck = $_POST['username'];
        $query="SELECT username FROM users WHERE username = '$usercheck'";
        $check = mysql_query($query) or die(mysql_error());
        $numberOfRow = mysql_num_rows($check);

        //if the name exists it gives an error
        if ($numberOfRow != 0) {//on doit faire mieux
            die('Sorry, the username '.$_POST['username'].' is already in use. Start again <a href='.$_SERVER['PHP_SELF'].'>here</a>');
        }
        
        // now we insert it into the database
        $insert = "INSERT INTO users (username, password) VALUES ('".$_POST['username']."','".md5($_POST['password'])."')";
        $add_member = mysql_query($insert);
        mysql_close($connection);
        ?>


        <h1>Registered</h1>
        <p>Thank you, you have registered - you may now <a href="login.php">login</a>.</p>
    <?php
    }
    else
    {
    ?>
        
    <script language="javascript" type="text/javascript" src="./js/checkParam.js">
    </script>
    
    <form  onsubmit="return checkParamRegister()" name="log" method="post">
        <table border="0">
            <tr>
                <td id="colorUsername">Username:</td>
                <td>
                    <input type="text" name="username" id="username" maxlength="60"/>
                    <script  type="text/javascript" >
                        var keyUsername = document.getElementById('username');
                        keyUsername.focus();
                        keyUsername.select();
                    </script>
                </td>
            </tr>
            <tr>
                <td id="colorPassword">Password:</td>
                <td>
                    <input type="password" name="password" id="password" maxlength="10"/>
                    <td><div id="erreurPassword"></div></td>
                   
                </td>
            </tr>
            <tr>
                <td id="colorPassword2">Confirm Password:</td>
                <td>
                    <input type="password" name="password2" id="password2" maxlength="10"/>
                </td>
            </tr>
            <tr>
                <th colspan=2>
                    <input type="submit" name="submitRegister" value="Register">
                </th>
            </tr> 
        </table>
    </form>

    <?php
}
?> 
