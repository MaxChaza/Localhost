<?php

	$dir_lang = './langues/';

	$page = 'index';

	include('./langues.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

   

<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">

<head>

	<title>Maxime Chazalviel</title>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<link href="images/favicon.ico" type="image/x-icon" rel="shortcut icon">

	<!-- Lien vers ma feuille de styles css -->

	<link rel="stylesheet" type="text/css" href="src/index.css" />

	<script type="text/javascript" src="src/cprefixfree.dynamic-dom.js"></script>
	
</head>



<body>

	<div id="ligneNoir" >

	</div>

	

	<div id="ligne" >

	</div>

	

	<div id="home">

		<div id="header">

			<div class="myName">

				<h1><a  href="./index.php">Maxime Chazalviel</a></h1>

			</div>

				

			<ul class="menu">

				<li><a><?php echo $projets;?></a>

					<ul>

						<li><a href="src/asteroids.php" class="documents">Asteroids</a></li>

						<li><a href="src/opal.php" class="messages">Opal-GUI</a></li>

						<li><a href="src/quadran.php" class="signout">Quadran</a></li>
						
						<li><a href="src/interaction.php" class="irit">IRIT</a></li>

						<!-- <li><a href="#" class="signout"><?php echo $projetut;?></a></li>-->

					</ul>

				</li>

				<li><a href="src/cv.php">CV</a></li>

				<li><a href="src/contact.php">Contact</a></li>

				<!-- <li><a href="#"><?php echo $autres;?></a></li>-->

			</ul>

		</div>

		

		<div id="intitule">

			<?php

				echo $intitule;

			?>

		</div>

		

		<span id="sl_play" class="sl_command"></span>  

		

		<span id="sl_pause" class="sl_command"></span>  

		   

		<section id="slideshow"> 



			<a class="play_commands pause" href="#sl_pause" title="Maintain paused">Pause</a>  

			

			<a class="play_commands play" href="#sl_play" title="Play the animation">Play</a>  

			

			<div class="container">  

				<div class="c_slider"></div>  

					<div class="slider">  

					
						<a href="src/asteroids.php" style="margin-right:-4px">

							<figure>

								<img src="images/space3.jpg" alt=""  height="600" />

								<figcaption>Asteroids</figcaption>

							</figure>

						</a>

						

						<a href="src/opal.php"  style="margin-right:-4px">

							<figure>

								<img src="images/card17.jpg" alt="" height="600" />

								<figcaption>OPAL GUI</figcaption>

							</figure>

						</a>

						

						<a href="src/quadran.php" style="margin-right:-4px">

							<figure>

								<img src="images/mont.jpg" alt="" height="600" />

								<figcaption><?php echo $stage;?></figcaption>

							</figure>

						</a>

						
						
						<a href="src/interaction.php" >

							<figure>

								<img src="images/interaction.jpg" alt="" height="600" />

								<figcaption><?php echo $stageIrit;?></figcaption>

							</figure>

						</a>
						
					</div>  

				</div>  

			<span id="timeline"></span> 

		</section> 

	</div>

	

	<div id="middle" >

		<div id="surmiddle" >

		</div>

	</div>

	

	<div id="presentation">

		<div id="reseaux">

			<div id="facebook">

				<a  href="http://www.facebook.com/sharer.php?u=file://maximechazalviel.fr" target="_blank"><img src="images/ico/Nuova cartella/facebook64.png" alt="facebook" style="border:none"></a>

			</div>

			

			<div id="twitter">

				<a href="http://twitter.com/share?text=An%20Awesome%20Link&url=file://maximechazalviel.fr" target="_blank"><img src="images/ico/Nuova cartella/twitter64.png" alt="twitter" style="border:none"></a>

			</div>

			

			<div id="linkedin">

				<a href="http://fr.linkedin.com/pub/maxime-chazalviel/51/595/505" target="_blank"><img src="images/ico/Nuova cartella/linkedin64.png" alt="linkedin" style="border:none"></a>

			</div>

		</div>

		

		<div id="hpres" >

			<div id="headpres">

			</div>

		</div>

		

		<div id="divpresentation" >

			<?php echo $presentation;?>

		</div>	

			

		<div id ="espace">

		</div>

		

		<div id ="espace">

		</div>

		

		<div id="lignePied">

		</div>

		

		<div id="piedPage">

			<div id="gauche">

				<li><a href="#">Index</a></li>

				<li><a href="src/cv.php">CV</a></li>

				<li><a href="src/contact.php">Contact</a></li>

				<!-- <li><a href="#"><?php echo $autres;?></a></li>-->

			</div>

			<div id="lang">

				<?php

					echo '<li><a  href="./index.php?lang=fr" target="_top"><img src="images/fr.png" alt="Fran&ccedil;ais" style="border:none"></a></li>';

					echo '<li><a  href="./index.php?lang=en" target="_top"><img src="images/en.png" alt="Anglais" style="border:none"></a></li>';

				?>

			</div>

		</div>

	</div>

</body>

</html>

