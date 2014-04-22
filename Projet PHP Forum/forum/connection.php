<?php
//Inclusions
require('includes/userManagement.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>Accueil du forum</title>
	</head>
	<body>
	
	<div id="en_tete">
	</div>
	 	 
	<div id="corps">
		<?php
		//Dans le cas où les identifiants n'ont pas été rentrés
		if(!isset($_POST['user']) && !isset($_POST['password']))
		{?>
			<form action="connection.php" method="post">
			<p>
				<label for="user">Nom d'utilisateur : </label>
				<input type="text" id="user" name="user"/>
				<br />
				<label for="password">Password : </label>
				<input type="password" id="password" name="password" />
				<input type="submit" value="Valider" />
			</p>
		<?php
		}
		else
		{
			if(validId($_POST['user'], $_POST['password']))
				echo "Identification réussie !!";
			else
				echo "Les identifiants saisis sont invalides !!";
		}?>
	</div>
	 
	<div id="foot">
	</div>
	
	</body>
</html>
