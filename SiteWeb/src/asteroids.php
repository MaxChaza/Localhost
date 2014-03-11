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

		

		<div id ="jeu">

			<table id="page-table">

				<tr>

					<td id="page-td">

						<applet 	

								codebase = "../classes"

								code     = "org/ast/AsteroVue.class"

								archive  = "JAppletAsteroids.jar"

								alt="Navigateur non compatible JAVA" 

								width="800" 

								height="700"

								>

						</applet>

					</td>

				</tr>

			</table>			

		</div>


		<div id ="espace">

		</div>

	</div>

	

<?php

		include('./piedProjet.php');

?>				

		