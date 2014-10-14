<?php
	$page = 'cv';
	$dir_lang = '../langues/';
	include('../langues.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
	<title>Maxime Chazalviel</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link href="../images/favicon.ico" type="image/x-icon" rel="shortcut icon">
	<!-- Lien vers ma feuille de styles css -->
	<link rel="stylesheet" type="text/css" href="cvindex.css" />
</head>

<body>
	<div id="ligneNoir">
	</div>
	
	<div id="ligne" >
	</div>
	
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
	
	<div id="presentation">
		<div id="hpres" >
			<div id="headpres" >
			</div>
		</div>
		
		<div id="divpresentation">
			<table id="page-table">
				<tr>
					<td id="page-td">
						<?php echo $presentation; ?>
						
						<p>
							<a href="../telechargements/cv.zip" ><?php echo $telecharger; ?></a>
						</p>
						
						<div id="cv"></div>
					</td>
				</tr>
			</table>
		</div>
		
		<div id ="espace">
		</div>
		
<?php	
	include('./piedProjet.php');
?>		
	