<?php
//Inclusions
require('../includes/userManagement.php');
?>
<?php
if(isset($_POST['user']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['email']))
{
	if(registerUser($_POST['email'],$_POST['user'], $_POST['password']))
	{
		echo 'Création du compte réalisée avec succès ! Vous pouvez dès à présent vous connecter <br />';
		global $URL_SITE;
		header('Location: '.$URL_SITE);
	}
	else
	{
		header('Location: '.$URL_SITE.'/src/ajouterCompte.php');
	}
}		
else				
{					
include('header.php');
?>
	
	
	<div id="page_spec">
		<div id="centre">
		
		<?php
		//Dans le cas où les identifiants n'ont pas été rentrés
		if(empty($_POST['user']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['email']))
		{
		
		?>
			<form action="ajouterCompte.php" method="post" class="centre">
				<fieldset>
					<legend>Créer son Compte</legend>
                    			<table>	
                    				<tr colspan="2">	
							<td >
								<p>&nbsp;&nbsp;&nbsp;
								<em class="etoile">*</em> Login :
							</td>

							<td>	
								<input type="text" id="user" name="user" />&nbsp;&nbsp;&nbsp;</p>  	
							</td>
						</tr>
						<tr colspan="2">
							<td>
								<p>&nbsp;&nbsp;&nbsp;
						 		<em class="etoile">*</em> Mot de passe :
							</td>
							<td>	
								<input type="password" id="password" name="password" />&nbsp;&nbsp;&nbsp;</p>
							</td>
						</tr>
						<tr colspan="2">	
							<td>
								<p>&nbsp;&nbsp;&nbsp;
								<em class="etoile">*</em> Répéter le mot de passe :
							</td>
							<td>	
								<input type="password" id="password2" name="password2" />&nbsp;&nbsp;&nbsp;&nbsp;</p>
							</td>
						</tr>
						<tr colspan="2" title="Exemple : laPtite@etu.unilim.fr">	
							<td>
								<p>&nbsp;&nbsp;&nbsp;
								<em class="etoile">*</em> Email :
							</td>

							<td>	
								<input type="text" id="email" name="email" />&nbsp;&nbsp;&nbsp;&nbsp;</p>
							</td>
						</tr>
					</table>
					<p id="chp_obli">
						<em class="etoile">* Champs obligatoires</em>
					</p>
					<input class="bouton1" type="submit" id="envoyer0" name="envoyer0" value="OK"/>
				</fieldset>
			</form>
			
		<?php
		}
		else
		{
		//fonction 2 fois mm id
			if($_POST['password'] != $_POST['password2'])
			{
				//controle password
				?>
		
			<form action="ajouterCompte.php" method="post" class="centre">
				<fieldset>
					<legend>Créer son Compte</legend>
                    			<table>	
                    				<tr colspan="2">	
							<td >
								<p>&nbsp;&nbsp;&nbsp;
								<em class="etoile">*</em> Login :
							</td>

							<td>	
								<input type="text" id="user" name="user" />&nbsp;&nbsp;&nbsp;</p>  	
							</td>
						</tr>
						<tr colspan="2">
							<td>
								<p>&nbsp;&nbsp;&nbsp;
						 		<em class="etoile">*</em> Mot de passe :
							</td>
							<td>	
								<input type="password" id="password" name="password" />&nbsp;&nbsp;&nbsp;</p>
							</td>
						</tr>
						<tr colspan="2">	
							<td>
								<p>&nbsp;&nbsp;&nbsp;
								<em class="etoile">*</em> Répéter le mot de passe :
							</td>
							<td>	
								<input type="password" id="password2" name="password2" />&nbsp;&nbsp;&nbsp;&nbsp;</p>
							</td>
							
							
						</tr>
						<tr colspan="2" title="Exemple : laPtite@etu.unilim.fr">	
							<td>
								<p>&nbsp;&nbsp;&nbsp;
								<em class="etoile">*</em> Email :
							</td>

							<td>	
								<input type="text" id="email" name="email" />&nbsp;&nbsp;&nbsp;&nbsp;</p>
							</td>
						</tr>
					</table>
					<p id="chp_obli">
						<em class="etoile">* Champs obligatoires</em>
					</p>
					<input class="bouton1" type="submit" id="envoyer0" name="envoyer0" value="OK"/>
				</fieldset>
			</form>
			<rouge>&nbsp;&nbsp;&nbsp;
									Erreur lors de la saisie du mot de passe.
			</rouge>
			
		
		<?php
			}
		}

		?>
		
		</div>
	 </div>
	<?php
include('foot.php');
}
?>