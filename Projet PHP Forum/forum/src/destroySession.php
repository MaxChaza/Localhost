<?php
require('../includes/config.php');
session_start();

//Destruction of all session variables
$_SESSION=array();

//Destroy the data session and cookie session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

//Destroy session
session_destroy();

//Redirect to the index page
global $URL_SITE;
header('Location: '.$URL_SITE); //Il faudra mettre une variable globale pour stocker l'URL du site
?>
