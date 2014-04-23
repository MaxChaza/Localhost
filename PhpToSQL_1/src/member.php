<?php
session_start();

if((isset($_SESSION["username"])) && (isset($_SESSION["password"]))){
    echo "Welcome on board ".$_SESSION["username"]." <br/>";
    echo "Admin Area<br>";
    echo "Your Content<br>";
    echo "<a href=# onclick=\"showContent('logout')\">Logout</a>";
}
else
{
    setcookie("PHPSESSID", "", time()-3600,"/");
    session_destroy();
    
    ?>
        <script type="text/javascript">
            showContent("login");
        </script>
    <?php
}

?> 
