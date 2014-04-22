<?php
session_start();
include('header.php');
require('../includes/config.php');
require('../includes/utils.php');
require('../includes/messageManagement.php');
require('../includes/roleManagement.php');
global $URL_SITE;

//To access to this page, the user must be connected
if(isset($_SESSION['user']) && getMessageRoleByUserId($_POST['idMessage'], $_SESSION['idUser'])=="admin")
{	
	//If the variable GET exists, it's the first call of the page (the call before save the new message)
	if(isset($_POST['idMessage']))
	{
		//If the token is valid
		if(validToken('deleteMessage', $URL_SITE.'?viewTopic='.getTopicIdByMessageId($_POST['idMessage']), 600))
		{
			//Second token to edit messages
			$deleteMessageToken2=NULL;
			$deleteMessageToken2=createToken('deleteMessage2');
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
						<input type="hidden" id="token" name="token" value="<?php echo  $deleteMessageToken2 ;?>">
						<input type="hidden" id="idMessage" name="idMessage" value="<?php echo $_POST['idMessage'] ;?>">
							<fieldset>
								<legend>Supprimer ce message ?</legend>
								<table>	
									<tr colspan="2" >	
										<td>
											<p>Message actuel :</p>
										</td>

										<td>	
											<p><?php echo getMessageBody($_POST['idMessage']) ?></p>
										</td>
									</tr>
								</table>
								<br /> <br />
								<input class="bouton1" type="submit" id="deleteMessage" name="deleteMessage" value="Delete message"/>
							</fieldset>
					</form>
				</div>
			</div>
			<?php	
		}
		//Delete the message
		else if(!empty($_POST))
		{
			//Update the message if the second token is valid
			if(validToken('deleteMessage2', $URL_SITE.'src/deleteMessage.php', 600))
			{
				removeMessage($_POST['idMessage']);
				echo htmlspecialchars('Message supprimé avec succès');
			}
			else
			{
				echo 'Referer : '.$_SERVER['HTTP_REFERER'].'<br />';
				echo 'Forgee : '.$URL_SITE.'src/deleteMessage.php'.'<br />';
				echo htmlspecialchars('Jeton de session invalide. Veuillez renouveler l\'opération');
			}
		}
		else
			echo htmlspecialchars('Jeton de session invalide. Veuillez renouveler l\'opération');
	}
	else
		echo 'Jeton de session invalide. Veuillez renouveler l\'opération';
}
else
	echo 'Vous devez être identifié et avoir les droits suffisants pour supprimer un message <br />';

include('foot.php');
?>
