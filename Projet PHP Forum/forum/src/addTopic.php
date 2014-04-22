<?php
session_start();
include('header.php');
require('../includes/config.php');
require('../includes/topicManagement.php');
require('../includes/roleManagement.php');
require('../includes/messageManagement.php');
global $URL_SITE;

if(isset($_SESSION['user']) && getTopicRoleByUserId($_POST['idCategory'], $_SESSION['idUser'])==("write" || "editor" || "admin"))
{
	//Verify token
	if(validToken('createTopic', $URL_SITE.'?viewCategory='.$_POST['idCategory'], 600))
	{
		//Second token to edit messages
		$createTopicToken2=NULL;
		$createTopicToken2=createToken('createTopic2');
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
					<input type="hidden" id="token" name="token" value="<?php echo $createTopicToken2 ;?>">
					<input type="hidden" id="idCategory" name="idCategory" value="<?php echo $_POST['idCategory'] ;?>">
					<fieldset>
						<legend>Titre du topic</legend>
							<table>	
							<tr colspan="2" >	
								<td>
									<em class="etoile">*</em>Titre :
								</td>
								<td>	
									<textarea cols="50" rows="1" id="topicTitle" name="topicTitle" /></textarea>
								</td>
							</tr>
							</table>
					</fieldset>					
					<fieldset>
						<legend>Ajouter un message</legend>
						<table>	
							<tr colspan="2" >	
								<td>
									<em class="etoile">*</em> Message :
								</td>
								<td>	
									<textarea cols="60" rows="13" id="topicMessage" name="topicMessage" /></textarea>
								</td>
							</tr>
						</table>
						<p id="chp_obli">
							<em class="etoile">* Champs obligatoires</em>
						</p>
						<input class="bouton1" type="submit" id="createTopic" name="createTopic" value="Créer topic"/>
					</fieldset>
				</form>
			</div>
		</div> <?php
	}
	else if(isset($_POST['topicTitle']) && isset($_POST['topicMessage']))
	{
		if(validToken('createTopic2', $URL_SITE.'src/addTopic.php', 600))
		{
			$idTopic=NULL;
			$idTopic=registerTopic($_POST['topicTitle'], $_SESSION['idUser'], $_POST['idCategory']);
			registerMessage($idTopic, $_SESSION['idUser'], $_POST['topicMessage']);
			echo htmlspecialchars('Creation du topic avec succès');
		}
		else
			echo htmlspecialchars('Jeton de session2 invalide. Veuillez renouveler l\'opération');
	}
	else
		echo htmlspecialchars('Jeton de session invalide. Veuillez renouveler l\'opération');
}
else
	echo 'Vous devez être identifié et avoir les droits suffisants pour créer un topic <br />';

include('foot.php');
?>
	
