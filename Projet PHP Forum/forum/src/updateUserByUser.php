<?php
session_start();
//Inclusions
require('../includes/userManagement.php');

?>
<?php
include('header.php');

?>
	<?php
	

	//If the user submit the form
	if(!empty($_POST))
	{
		if(!empty($_POST['message']))
		{
			global $URL_SITE;
			registerMessage($_SESSION['currentTopicId'], $_SESSION['idUser'], $_POST['message']);
			header('Location: '.$URL_SITE.'?viewTopic='.$_SESSION["currentTopicId"]);
			exit();
		}
	}?>
	
		<div id="top_admin">
			<?php
			if(!isset($_SESSION['user'])) 
				echo '<a href="identification.php">Connection</a>';
			else
				echo 'Connection sous <b><a href="updateUserByUser.php">'.$_SESSION['user'].'</a></b>'; ?>
		</div>
	<?php
////////////////////////////////////////////////////
// 2 / Update what i want 
////////////////////////////////////////////////////
//	
	$idUser=NULL;
	$idUser= $_SESSION['idUser'];
	
	$user = NULL;
	$user=array();
	$user=getUser();
	$nameUser = NULL;
	$nameUser=$user['name'];
	
	$mailUser = NULL;
	$_SESSION['mail']=stripslashes ( $user['mail']);
	if(isset($_POST['mail']))
	{
			$mailUser= $_POST['mail'];
	}
	else
	{
			$mailUser= stripslashes ( $user['mail'] );
	}
	
	
	?>
	<div id="page_spec">
		<form action="updateUserByUser.php" method="post" class="centre">
			<fieldset>
				<legend>Modification du Compte de <?php echo htmlspecialchars($nameUser); ?></legend>
				<table>
					<tr colspan="2">
						<td >
							<p>&nbsp;&nbsp; E-mail:
						</td>
						<td>
							<input type="text" size="30" id="mail" name="mail" value=<?php echo htmlspecialchars($mailUser); ?>></p>
						</td>
					</tr>	
					<tr colspan="2">
						<td >
							<p>&nbsp;&nbsp; Ancien mot de passe :
						</td>
						<td>
							<input type="password" id="password1" name="password1" /></p>
						</td>
					</tr>					
					
					<tr colspan="2">
						<td>
							<p>&nbsp;&nbsp; Nouveau mot de passe :
						</td>
						<td>
							<input type="password" id="password2" name="password2" /></p>
						</td>
					</tr>
					<tr colspan="2">
						<td>
							<p>&nbsp;&nbsp; Répéter nouveau le mot de passe :
						</td>
						<td>
							<input type="password" id="password3" name="password3" /></p>
						</td>
					</tr>
				</table>
				<input class="bouton2" type="submit" id="envoyer0" name="envoyer0" value="OK"/>
			</fieldset>
		</form>
	

	<?php
	if(!empty($_POST['mail']))
	{
		
		
		/////////////////////////////////////
		// Update password and mail
		/////////////////////////////////////
		if(!empty($_POST['password1'])&& !empty($_POST['password2'])&& !empty($_POST['password3'])&& !empty($_POST['mail']) && $_SESSION['mail']!=$_POST['mail'] )
		{
				//If the user and password are valid
				$idUser = NULL;
				$idUser=validId($nameUser, $_POST['password1']);
				if($idUser)
				{
					if($_POST['password3'] == $_POST['password2'])
					{
						$email = NULL;
						$email=$_POST['mail'];
						$password = NULL;
						$password=$_POST['password2'];
						//update password & mail
						if(updateUserEmailPassword($idUser, $email, $password))
						{
					?>
								<div id="centre">
									<p> User modifiéée.
								</div>
							</div>
					<?php
						}
					}
				}
				else
					$errorMessage='Login et/ou mot de passe invalides';
		}
		else 
		{

		/////////////////////////////////////
		// Update password
		/////////////////////////////////////
			if(!empty($_POST['password1'])&& !empty($_POST['password2'])&& !empty($_POST['password3'])&& ($_SESSION['mail']==$_POST['mail'] || $_POST['mail']==""))
			{
				//If the user and password are valid
				$idUser = NULL;
				$idUser=validId($nameUser, $_POST['password1']);
				if($idUser)
				{
					if($_POST['password3'] == $_POST['password2'])
					{
						//update password
						$password = NULL;
						$password=$_POST['password2'];
						if(updateUserPassword($idUser, $password))
						{
					?>
								<div id="centre">
									<p> User modifiéée.
								</div>
							</div>
					<?php
						}
						
					}
				}
				else
					$errorMessage='Login et/ou mot de passe invalides';
			}
			else
			{
			
		/////////////////////////////////////
		// Update mail
		/////////////////////////////////////
				if(!empty($_POST['mail']) && $_POST['mail']!='' && $_SESSION['mail']!=$_POST['mail'] )
				{			
					$email = NULL;
					$email=$_POST['mail'];
					
					//update mail
					if(updateUserEmail($idUser, $email))
					{
					?>
						<div id="centre">
							<p> User modifiéée.
							
						</div>
					</div>
					<?php
					}
				}
			}
		}
	}

include('foot.php');
?>
