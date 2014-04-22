<?php
require('../includes/config.php');
global $URL_SITE;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
        <title>The Super Fouine</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/indexAdmin.css" />
        
</head>
<body>
	<div id="logo">
		<a href='<?php echo $URL_SITE; ?>'><img src="../image/illus-fouine.gif" /></a>
	<h1>The Super Fouine</h1>
	</div>
	
	<div id="top_admin">
		<?php
		if(!isset($_SESSION['user'])) 
			echo '<a href="identification.php">Se connecter/S\'inscrire</a>';
		else
			echo 'Connection sous <b>'.$_SESSION['user'].'</b>'; ?>
	</div>
