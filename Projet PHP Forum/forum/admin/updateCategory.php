<?php
session_start();
?>
<?php
require('../includes/categoryManagement.php');
include('headerAdmin.php');
include('menuAdmin.php');
?>



<?php
////////////////////////////////////////////////////
// 1 / Choose the category
////////////////////////////////////////////////////

if(empty($_POST['category']) && empty($_POST['titre']) && empty($_POST['commentaire']))
{
?>
	<div id="page_spec">
		<div id="centre">
			<form action="updateCategory.php" method="post" class="centre">
				<fieldset>
					<legend>Choisir la categorie à modifier</legend>
						<table>
							<tr>	
								<td>
									<p>&nbsp;&nbsp;&nbsp;
									<em class="etoile">*</em> 
														Categories :  
								</td>
								<td >
									<dl>
											<?php
												$tabCategories = NULL;
												$tabCategories=array();
												$tabCategories=getAllCategories();
												$i=0;
												foreach($tabCategories as $aCategory)
												{
											?>
													<input type="radio" value=<?php echo htmlspecialchars($aCategory['id']); ?> name="category" >
													
													<?php echo htmlspecialchars($tabCategories[$i]['name']); ?><br/>
											<?php
													$i=$i+1;
												}
											?>
										</dl>
									</p>
								</td>
							</tr>
						</table>
						<p id="chp_obli">
							<em class="etoile">* Champs obligatoires</em>
						</p>								
						<input class="bouton" type="submit" id="envoyer" name="envoyer" value="OK"/>
				</fieldset>
			<form>
		</div>
<?php
}
else
{
////////////////////////////////////////////////////
// 2 / Update what i want (title or description)
////////////////////////////////////////////////////
//
	$idCategory = NULL;
	if(isset($_POST['category']))
	{
		$idCategory = $_POST['category'];
	}
	else
	{
		$idCategory=$_SESSION['idCategory'];
	}
	
	$tabCategories = NULL;
	$tabCategories=array();
	$tabCategories=getAllCategories();
	$i=0;
	foreach($tabCategories as $aCategory)
	{
		if($aCategory['id'] == $idCategory)
		{

			$_SESSION['idCategory']=$idCategory;
			
			$description = NULL;
			if(isset($_POST['commentaire']))
			{
				$description= $_POST['commentaire'];
			}
			else
			{
				$description= stripslashes ( $aCategory['description'] );
			}
			
?>			
			 <div id="page_spec">
				<div id="centre">
					<form action="updateCategory.php" method="post" class="centre">
								<fieldset>
									<legend>Modifier une categorie</legend>
												<table>	
													<tr colspan="2">	
											<td >
												<p>&nbsp;&nbsp;&nbsp;
												<em class="etoile">*</em> Titre :
											</td>

											<td>	
												<input type="text" id="titre" name="titre" value=<?php echo htmlspecialchars($aCategory['name']);?> />&nbsp;&nbsp;&nbsp;</p>  	
											</td>
										</tr>
										
										<tr colspan="2" >	
											<td>
												<p>&nbsp;&nbsp;&nbsp;
												<em class="etoile">*</em> Descriptif :
											</td>

											<td>	
												<TEXTAREA cols="60" rows="13" id="commentaire" name="commentaire"  /><?php echo htmlspecialchars($description);?></TEXTAREA>
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
		}
	}


////////////////////////////////////////////////////
// 3 / Update in the db
////////////////////////////////////////////////////

	if(empty($_POST['category']) && isset($_POST['titre']) && isset($_POST['commentaire'])&& $_POST['commentaire']!="" && $_POST['titre']!="")
	{
		$_SESSION['idCategory']=$idCategory;
		$name = NULL;
		$name = $_POST['titre'];
		$description = NULL;
		$description = $_POST['commentaire'];
		if(updateCategory($idCategory,$name, $description))
		{
	?>
			
			<div id="centre">
				<p> Categorie modifiéée.
				
			</div>
		</div>
<?php
		}
		else
		{
	?>
			<div id="centre">
				<p> Erreur lors de la modification.
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

	
}
include('footAdmin.php');
?>
