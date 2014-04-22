<?php
session_start();
include('header.php');
require('../includes/config.php');
require('../includes/utils.php');
require('../includes/messageManagement.php');
require('../includes/roleManagement.php');
global $URL_SITE;

//To access to this page, the user must be connected
if(isset($_SESSION['user']) && isset($_POST['idMessage']) && (getMessageRoleByUserId($_POST['idMessage'], $_SESSION['idUser'])==("write" || "editor" || "admin")))
{	
	//If the token is valid
	if(validToken('editMessage', $URL_SITE.'?viewTopic='.getTopicIdByMessageId($_POST['idMessage']), 600))
	{
		//Second token to edit messages
		$editMessageToken2=NULL;
		$editMessageToken2=createToken('editMessage2');
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
						<input type="hidden" id="token" name="token" value="<?php echo $editMessageToken2 ;?>">
						<input type="hidden" id="idMessage" name="idMessage" value="<?php echo $_POST['idMessage'] ;?>">
							<fieldset>
								<legend>Editer un message</legend>
								<table>	
									<tr colspan="2" >	
										<td>
											<p>Message actuel :</p>
										</td>

										<td>	
											<textarea cols="60" rows="13" id="message" name="message" />
											<?php echo getMessageBody($_POST['idMessage']) ?></textarea>
										</td>
									</tr>
								</table>
								<br /> <br />
								<input class="bouton1" type="submit" id="updateMessage" name="updateMessage" value="Update message"/>
							</fieldset>
					</form>
				</div>
		</div> <?php	
	}
	//Update the message
	else if(!empty($_POST))
	{
		//Update the message if the second token is valid
		if(validToken('editMessage2', $URL_SITE.'src/editMessage.php', 600))
		{
			if(!empty($_POST['message']))
			{
				updateMessage($_POST['idMessage'], $_POST['message']);
				echo htmlspecialchars('Message mis à jour avec succès');
			}
		}
		else
			echo htmlspecialchars('Jeton de session invalide. Veuillez renouveler l\'opération');
	}	
	else
		echo htmlspecialchars('Jeton de session invalide. Veuillez renouveler l\'opération');
}
else
	echo 'Vous devez être identifié et avoir les droits suffisants pour éditer un message <br />';

include('foot.php');
?>
