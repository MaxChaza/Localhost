<?php
if(isset($_COOKIE['yourname'])){
    echo "Welcome on board ". $_GET['nom']." <br/>";
    echo "Admin Area<br>";
    echo "Your Content<br>";
    echo "<a href=logout.php>Logout</a>";
}
else
{
    $header="Location:./login.php";
    header($header);
}
?> 
