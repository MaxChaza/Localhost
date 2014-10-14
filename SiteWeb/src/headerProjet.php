<?php 
	$css = $page."index.css";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
	<title>Maxime Chazalviel</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link href="../images/favicon.ico" type="image/x-icon" rel="shortcut icon">
	<!-- Lien vers ma feuille de styles css -->
	<link rel="stylesheet" type="text/css" href="<?php echo $css ?>" />
</head>

<body>
	<div id="ligneNoir" >
	</div>
	
	<div id="ligne" >
	</div>
	
	<div id="home">
		<div id="header">
			<div class="myName">
				<h1><a  href="../index.php">Maxime Chazalviel</a></h1>
			</div>
				
			<ul class="menu">
				<li><a><?php echo $projets;?></a>
					<ul>
						<li><a href="asteroids.php" class="documents">Asteroids</a></li>
						<li><a href="opal.php" class="messages">Opal-GUI</a></li>
						<li><a href="quadran.php" class="signout">Quadran</a></li>
						<li><a href="interaction.php" class="irit">IRIT</a></li>
						<!-- <li><a href="#" class="signout"><?php echo $projetut;?></a></li>-->
					</ul>
				</li>
				<li><a href="cv.php">CV</a></li>
				<li><a href="contact.php">Contact</a></li>
				<!-- <li><a href="#"><?php echo $autres;?></a></li>-->
			</ul>
		</div>

		<div id="intitule">

			<?php echo $intitule;?>

		</div>

		

		<div id="piedhome" >

		</div>

	</div>

	

	<div id="middle" >

		<div id="surmiddle" >

		</div>

	</div>

	

	<div id="presentation">

		<div id="reseaux">

			<div id="facebook">

				<a  href="http://www.facebook.com/sharer.php?u=file://maximechazalviel.fr" target="_blank"><img src="<?php echo '../images/reseaux/'.$page.'/facebook64.png'?>" alt="facebook" style="border:none"></a>

			</div>

			

			<div id="twitter">

				<a href="http://twitter.com/share?text=An%20Awesome%20Link&url=file://maximechazalviel.fr" target="_blank"><img src="<?php echo '../images/reseaux/'.$page.'/twitter64.png'?>" alt="twitter" style="border:none"></a>

			</div>

			

			<div id="linkedin">

				<a href="http://fr.linkedin.com/pub/maxime-chazalviel/51/595/505" target="_blank"><img src="<?php echo '../images/reseaux/'.$page.'/linkedin64.png'?>" alt="linkedin" style="border:none"></a>

			</div>

		</div>

		

		<div id="hpres" >

			<div id="headpres" >

			</div>

		</div>'	