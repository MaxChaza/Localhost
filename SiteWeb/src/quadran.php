<?php
	$page = 'quadran';
	$dir_lang = '../langues/';
	include('../langues.php');
	
	include('./headerProjet.php');
?>
	<div id="divpresentation" >
		<?php echo $presentation;?>
	</div>
	
	<div id ="espace"></div>

	<div id="insignes" >
		<img src="../images/Logo-Quadran.png" height="100px"/>
		<img src="../images/Logo_UT3.jpg" height="100px" />
	</div>

	<div id ="espace">
	</div>	
	
<?php
		include('./piedProjet.php');
?>				
		