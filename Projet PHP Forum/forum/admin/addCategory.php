<?php
session_start();
?>
<?php
require('../includes/categoryManagement.php');
include('headerAdmin.php');
include('menuAdmin.php');
?>

	
	<div id="page_spec">
		<div id="centre">
			<form action="addCategory.php" method="post" class="centre">
						<fieldset>
							<legend>Ajouter une catégorie</legend>
										<table>	
											<tr colspan="2">	
									<td >
										<p>&nbsp;&nbsp;&nbsp;
										<em class="etoile">*</em> Titre :
									</td>

									<td>	
										<input type="text" id="titre" name="titre" />&nbsp;&nbsp;&nbsp;</p>  	
									</td>
								</tr>
								
								<tr colspan="2" >	
									<td>
										<p>&nbsp;&nbsp;&nbsp;
										<em class="etoile">*</em> Descriptif :
									</td>

									<td>	
										<TEXTAREA cols="60" rows="13" id="commentaire" name="commentaire" /></TEXTAREA>
									</td>
								</tr>
							</table>
							<p id="chp_obli">
								<em class="etoile">* Champs obligatoires</em>
							</p>
							<input class="bouton1" type="submit" id="envoyer0" name="envoyer0" value="OK"/>
						</fieldset>
					</form>
			</div>
		
		<?php
		if(isset($_POST['titre']) && isset($_POST['commentaire']) && $_POST['commentaire']!="" && $_POST['titre']!="")
		{
			$name = NULL;
			$description = NULL;
			$name = $_POST['titre'];
			$description = $_POST['commentaire'];
			if(registerCategory($name, $description))
			{
		?>
				<div id="centre">
					<p> Categorie créée.
				</div>
			</div>
	<?php
			}
			else
			{
		?>
				<div id="centre">
					<p> Erreur lors de la création.
				</div>
			</div>
	<?php
			}
		}
		else
		{
		?>
				<div id="centre">
					<p> Veuillez remplir tout les champs de saisie.
				</div>
			</div>
	<?php
		}
		
include('footAdmin.php');
?>
