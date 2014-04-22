<?php
session_start();
//Inclusions
require('../includes/userManagement.php');
require('../includes/categoryManagement.php');
require('../includes/roleManagement.php');
?>
<?php
include('headerAdmin.php');
include('menuAdmin.php');
?>

	<?php
	if(empty($_POST['category']) && empty($_POST['choix']) && empty($_POST['users']) && empty($_POST['roles']))
	{
	?>
	<div id="page_spec">
		<div id="centre">
			<form action="manageRoles.php" method="post" class="centre">
				<fieldset>
					<legend>Gerer les rôles des membres pour une catégorie</legend>
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
	</div>
	<?php
	}
	else
	{
		$idCategory = NULL;
		if(isset($_POST['category']))
		{
			$idCategory = $_POST['category'];
			$_SESSION['idCategory'] = $idCategory;
		}
		else
		{
			$idCategory=$_SESSION['idCategory'];
		}

	 ?>

		<div id="page_spec">
			<div id="centre">
				<form action="manageRoles.php" method="post" class="centre">
					<fieldset>
						<legend>Gérer les rôles</legend>
							<table>
								<tr>	
									<td>
										<p>&nbsp;&nbsp;&nbsp;
										<em class="etoile">*</em> 
															Choix :  
									</td>
									<td >
										<dl>
												<input type="radio" value="add" name="choix" >Ajouter un role<br/>
										
												<input type="radio" value="del" name="choix" >Supprimer un role
										</dl>
										</p>
									</td>
								</tr>
								<tr>
									<td>
										<p>&nbsp;&nbsp;&nbsp;
															Droit :  
									</td>
									<td>
											<select name="roles">
												<dl>
													<?php 
														$role = NULL;
														$roles=array();
														$roles=getAllRoles();
														$i=0;
														foreach($roles as $aRole)
														{
													?>
															<option value=<?php echo $aRole;?>><a> <?php echo htmlspecialchars($aRole); ?></a> </option>
													<?php 
														}
													?>
												</dl>
											</select>	
										</p>
									</td>
								</tr>
								<tr>	
									<td>
										<p>&nbsp;&nbsp;&nbsp;
										<em class="etoile">*</em> 
															Membres :  
									</td>
									<td >
										<dl>
												<?php
													$tabUsers = NULL;
													$tabUsers=array();
													$tabUsers=getAllUser();
													$i=0;
													foreach($tabUsers as $aUser)
													{
												?>
														<input type="checkbox" value=<?php echo htmlspecialchars($tabUsers[$i]['id']); ?> name="users[]" >
														
														<?php echo htmlspecialchars($tabUsers[$i]['name']); ?><br/>
												<?php
														$i=$i+1;
													}
												?>
											</dl>
										</p>
									</td>
								</tr>
								<tr>	
									<td>
										<p>&nbsp;&nbsp;&nbsp;
										<em class="etoile">*</em> 
															Role :  
									</td>
									<td >
										<table border="1" cellpadding="10">
												<tr>
													<th>
														Rôle
													</th>
													<th>
														User
													</th>
													<th>
														Category
													</th>
												<?php
												$tabRole=array();
												$tabRole=getRoleByIdCategory(1);
												foreach($tabRole as $aRole)
												{
												?>
												<tr>
													<td>
												<?php
													echo htmlspecialchars($aRole['role']);
													?>
													</td>
													<td>
												<?php
													echo htmlspecialchars($aRole['nameUser']);
													?>
													</td>
													<td>
												<?php
													echo htmlspecialchars($aRole['nameCategory']);
														$i=$i+1;
												?>
													</td>
												</tr>
												<?php
												}
												?>
										</table>
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
	
		if(isset($_POST['users']) && isset($_POST['roles'])&& isset($_POST['choix']))
		{
			$idUsers = NULL;
			$role = NULL;
			$idUsers = $_POST['users'];  
			$role = $_POST['roles'];
			
			if($_POST['choix']=="add")
			{
				$i=0;
				
				foreach( $idUsers as $aUser )
				{
					if(!roleExist($idUsers[$i], $idCategory, $role))
					{	
						giveRight($idUsers[$i], $idCategory, $role);
						$i++;
					}
				}	
	?>
				<div id="centre">
					<p> Role(s) créé(s).
				</div>
			</div>
	<?php
			}
			else
			{
					$i=0;
				
				foreach( $idUsers as $aUser )
				{
					if(roleExist($idUsers[$i], $idCategory, $role))
					{
						removeRoleByUserCategory($idUsers[$i],$idCategory,$role);
						$i++;
					}
				}	
	?>
				<div id="centre">
					<p> Role(s) suprimé(s).
				</div>
			</div>
	<?php
			}
		}
		else
		{
	?>
				<div id="centre">
					<p> Veuillez choisir au moins un membre.
				</div>
			</div>
	<?php
		}															
	}	
include('footAdmin.php');
?>