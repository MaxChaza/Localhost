<?php
session_start();

if((isset($_SESSION["username"])) && (isset($_SESSION["password"]))){
    echo "Welcome on board ".$_SESSION["username"]." <br/>";
    echo "Admin Area<br>";
    echo "Your Content<br>";
    echo "<a href=logout.php>Logout</a>";
}
else
{
    setcookie("PHPSESSID", "", time()-3600,"/");
    session_destroy();
    
    
    $header="Location:./login.php";
    header($header);
}

?> 
