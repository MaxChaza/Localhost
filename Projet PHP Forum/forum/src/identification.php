<?php
//Inclusions
require('../includes/userManagement.php');
require('../includes/categoryManagement.php');
require('../includes/roleManagement.php');
require('../includes/config.php');

//Session management
$errorMessage=NULL;

//If the user submit the form
if(!empty($_POST))
{
	if(!empty($_POST['user']) && !empty($_POST['password']))
	{
		// On initialise $existence_ft
		$existance_ft = NULL;
		$existence_ft = '';
		// Si le fichier existe, on le lit
		if(file_exists('../antibrute/'.$_POST['user'].'.tmp'))
		{
			// On ouvre le fichier
			$fichier_tentatives = NULL;
			$fichier_tentatives = fopen('../antibrute/'.$_POST['user'].'.tmp', 'r+');
	 
			// On récupère son contenu dans la variable $infos_tentatives
			$contenu_tentatives = NULL;
			$contenu_tentatives = fgets($fichier_tentatives);
			
			// On découpe le contenu du fichier pour récupérer les informations
			$infos_tentatives = NULL;
			$infos_tentatives = explode(';', $contenu_tentatives);

			// Si la date du fichier est celle d'aujourd'hui, on récupère le nombre de tentatives
			if($infos_tentatives[0] == date('d/m/Y'))
			{
				$tentatives = NULL;
				$tentatives = $infos_tentatives[1];
			}
			// Si la date du fichier est dépassée, on met le nombre de tentatives à 0 et $existence_ft à 2
			else
			{
				$existence_ft = NULL;
				$existence_ft = 2;
				$tentatives = NULL;
				$tentatives = 0; // On met la variable $tentatives à 0
			}

		}
		// Si le fichier n'existe pas encore, on met la variable $existence_ft à 1 et on met les $tentatives à 0
		else
		{
			$existance_ft = NULL;
			$existence_ft = 1;
			$tentatives = NULL;
			$tentatives = 0;
		}
		// S'il y a eu moins de 15 identifications ratées dans la journée, on laisse passer
		if($tentatives < 15)
		{
			//If the user and password are valid
			$idUser = NULL;
			$idUser=validId($_POST['user'], $_POST['password']);
			if($idUser)
			{
				session_start();
				$_SESSION['idUser']=$idUser; //Get the ID
				$_SESSION['user']=$_POST['user']; //Get the username
				$_SESSION['currentPage']="identification"; //Set the current page
				$data_verif = NULL;
				$data_verif=$_POST['user']; //Get the username
				//Redirect to home page
				global $URL_SITE;
				header('Location: '.$URL_SITE);
				exit();
			}
			else
			{ 
				$data_verif = NULL;
				$data_verif=$_POST['user']; //Get the username
				// Si le fichier n'existe pas encore, on le créer
               if($existence_ft == 1)
               {
					$creation_fichier = NULL;
                   $creation_fichier = fopen('../antibrute/'.$data_verif.'.tmp', 'a+'); // On créer le fichier puis on l'ouvre
                   fputs($creation_fichier, date('d/m/Y').';1'); // On écrit à l'intérieur la date du jour et on met le nombre de tentatives à 1
                   fclose($creation_fichier); // On referme
               }
               // Si la date n'est plus a jour
               elseif($existence_ft == 2)
               {
                   fseek($fichier_tentatives, 0); // On remet le curseur au début du fichier
                   fputs($fichier_tentatives, date('d/m/Y').';1'); // On met à jour le contenu du fichier (date du jour;1 tentatives)
               }
               else
               {
					/*// Si la variable $tentatives est sur le point de passer à 30, on en informe l'administrateur du site
                   if($tentatives == 7)
                   {
                       $email_administrateur = 'le_chaz_9@hotmail.fr';
 
                       $sujet_notification = '[Site] Un compte membre a atteint son quota';
 
                       $message_notification = 'Un des comptes a atteint le quota de mauvais mots de passe journalier :';
                       $message_notification .= $data_verif.' - '.$_SERVER['REMOTE_ADDR'].' - '.gethostbyaddr($_SERVER['REMOTE_ADDR']);
 
                       mail($email_administrateur, $sujet_notification, $message_notification);
                   }*/

                   fseek($fichier_tentatives, 11); // On place le curseur juste devant le nombre de tentatives
                   fputs($fichier_tentatives, $tentatives + 1); // On ajoute 1 au nombre de tentatives
               }

				$errorMessage='Login et/ou mot de passe invalides';
			}
		}
		// S'il y a déjà eu 30 tentatives dans la journée, on affiche un message d'erreur
		else
		{
			echo 'Trop de tentatives d\'authentification aujourd\'hui';
		}
		// Si on a ouvert un fichier, on le referme (eh oui, il ne faut pas l'oublier)
		if($existence_ft != 1)
		{
		fclose($fichier_tentatives);
		}

	}
}

include('header.php'); ?>
	<div id="page_spec">
		<?php
		//Verifying if the user is not already connected
		session_start();
		if(!isset($_SESSION['user']))
		{		
		?>
			<form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method="post" class="formulaire">
				<fieldset>
				<?php
				if(!empty($errorMessage))
					echo '<p>', htmlspecialchars($errorMessage) ,'</p>';
				?>
					<legend>Connection</legend>
					<p class="gche" >
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Login :
						<input type="text" id="user" name="user" />&nbsp;&nbsp;&nbsp;</p>					
					<p class="gche" >
						Mot de passe :
						<input type="password" id="password" name="password" />&nbsp;&nbsp;&nbsp;
					</p>					
					<input class="bouton3" type="submit" id="envoyer0" name="envoyer0" value="Se connecter"/>
				</fieldset>
			</form>
		<?php
		}
		else
			echo htmlspecialchars('Vous êtes déjà connecté. Si ce n\'est pas votre identité, déconnectez vous et reconnectez vous avec VOS identifiants.');
		?>
	</div>	
<div id="page">
	<br />
	<br />
	<a href="addUser.php">S'inscrire</a>
</div>
<?php
include('foot.php');
?>
