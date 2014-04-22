<?php
session_start();
include('header.php');
require('../includes/config.php');
require('../includes/messageManagement.php');
require('../includes/roleManagement.php');
global $URL_SITE;

//To access to this page, the user must be connected and have rights
if(isset($_SESSION['user']) && getTopicRoleByUserId($_POST['idTopic'], $_SESSION['idUser'])==("write" || "editor" || "admin"))
{
	//Verify token
	if(validToken('postMessage', $URL_SITE.'?viewTopic='.$_POST['idTopic'], 600))
	{
		//Second token to edit messages
		$postMessageToken2=NULL;
		$postMessageToken2=createToken('postMessage2');
		?>
		<div id="top_admin">
			<?php
			if(!isset($_SESSION['user'])) 
				echo '<a href="identification.php">Connection</a>';
			else
				echo 'Connection sous <b>'.$_SESSION['user'].'</b>'; ?>
		</div>

		 <div id="page_spec">
			<div id="centre">
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="centre">
					<input type="hidden" id="token" name="token" value="<?php echo $postMessageToken2 ;?>">
					<input type="hidden" id="idTopic" name="idTopic" value="<?php echo $_POST['idTopic'] ;?>">
					<fieldset>
						<legend>Ajouter un message</legend>
						<table>	
							<tr colspan="2" >	
								<td>
									<em class="etoile">*</em> Message :
								</td>

								<td>	
									<textarea cols="60" rows="13" id="message" name="message" /></textarea>
								</td>
							</tr>
						</table>
						<p id="chp_obli">
							<em class="etoile">* Champs obligatoires</em>
						</p>
						<input class="bouton1" type="submit" id="envoyer0" name="envoyer0" value="Poster"/>
					</fieldset>
				</form>
			</div>
		</div>
	<?php
	}
	//Update the message
	else if(!empty($_POST))
	{
		if(!empty($_POST['idTopic']))
		{
			//Update the message if the second token is valid
			if(validToken('postMessage2', $URL_SITE.'src/addMessage.php', 600))
			{
				if(!empty($_POST['message']))
				{
					registerMessage($_POST['idTopic'], $_SESSION['idUser'], $_POST['message']);
					echo utf8_encode('Message ajouté avec succès');
				}
			}
			else
				echo htmlspecialchars('Jeton de session invalide. Veuillez renouveler l\'opération');
		}
	}
	else
		echo 'Jeton de session invalide. Veuillez renouveler l\'opération';
}
else
	echo 'Vous devez être identifié et avoir les droits suffisants pour éditer un message <br />';

include('foot.php');
?>
