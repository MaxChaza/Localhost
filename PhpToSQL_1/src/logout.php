<?php
// STOP les COOKIES
//setcookie("yourname", '', time() - 3600);
session_start();
if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
}
setcookie("PHPSESSID", "", time()-3600,"/");
session_destroy();
?>
    <script type="text/javascript">
    $(function() {
    // Déclaration d'attributs.
        showContent("login");
     });
    </script>
