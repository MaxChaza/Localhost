<?php

	$page = 'asteroids';

	$dir_lang = '../langues/';

	include('../langues.php');

	

	include('./headerProjet.php');

?>

	

	<div id="divpresentation" >

		<?php echo $presentation;?>

	

		<a href="../telechargements/Asteroid.jar" ><?php echo $telecharge;?></a>

		

		<p>

		</p>

		<div id="divvideos" >
			<video id="video"controls src="../videos/force.ogv" width="60%"></video>
		</div>
	</div>


	<div id ="espace"></div>	

	<div id="insignes" >
		<img src="../images/Logo-Unilim.png" height="100px"/>
	</div>
	
	<div id ="espace">

	</div>


	

<?php

		include('./piedProjet.php');

?>				

		