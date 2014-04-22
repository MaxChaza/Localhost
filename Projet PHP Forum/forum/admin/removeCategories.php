<?php
//Inclusions
require('../includes/categoryManagement.php');
require('../includes/roleManagement.php');

?>

	
<?php
include('headerAdmin.php');
include('menuAdmin.php');
?>
	
		<div id="page_spec">
			<div id="centre">
				<form action="removeCategories.php" method="post" class="centre">
					<fieldset>
						<legend>Supprimer des categories</legend>
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
														<input type="checkbox" value=<?php echo htmlspecialchars($tabCategories[$i]['id']); ?> name="categorys[]" >
														
														<?php echo htmlspecialchars($tabCategories[$i]['name']) ;?><br/>
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
		if(isset($_POST['categorys']) )
		{
			$idCategories = NULL;
			$idCategories = $_POST['categorys'];  
			$i=0;
			foreach( $idCategories as $aCategory )
			{
				removeRoleByCategory($idCategories[$i]);
				removeCategory($idCategories[$i]);
				$i++;
			}	
	?>
		<div id="centre">
			<p> Compte(s) supprimé(s).
		</div>
	</div>
		
	<?php
	}
include('footAdmin.php');
?>