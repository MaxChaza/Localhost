<?php
setcookie("yourname", '', time() - 3600);
header("Location: login.php");
?> 
