
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
	<title>The Fouine Survivor Guide</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/index.css" />
        
</head>
<body>
	<div id="edt">	
		<a href='<?php echo $URL_SITE; ?>'><img src="image/bann.gif" /></a>
	</div>

	<div id="logo">
		<a href='<?php echo $URL_SITE; ?>'><img src="image/illus-fouine.gif" /></a>
	</div>
	
	<div id="top_admin">
		<?php
		/////////////////////////////////////////////////////////////////////////////
		//			CONNECTION MANAGEMENT				   //
		/////////////////////////////////////////////////////////////////////////////
		if(!isset($_SESSION['user'])) 
			echo '<a href="src/identification.php">Se connecter/S\'inscrire</a>';
		else
			echo 'Connection sous <b>'.$_SESSION['user'].'</b>'; ?>
	</div>	
	<div id="menu">
		<div id="centre">
				<fieldset>
				<dl>
					<dd>Lien 1</dd>
					<dd>Lien 2</dd>
					<dd>Lien 3</dd>
				</dl>
				</fieldset>
			</form>
		</div>
	 </div>
	
	<?php
	////////////////////////////////////////////////////////////////////
	//               SHOW ALL TOPICS RELEATED TO A CATEGORY		  //
	////////////////////////////////////////////////////////////////////
	//Verifying if the user was a the index page before
	if(isset($_GET['viewCategory']))
	{?>
		<div id="topic">
		<?php
			$tabTopics=array();
			if($tabTopics=getAllTopics($_GET['viewCategory']))
			{
				foreach($tabTopics as $topic)
				{?>
					<ul>
						<li><a href='<?php echo $URL_SITE.'?viewTopic='.$topic['idTopic']; ?>'><?php echo utf8_encode($topic['title']); ?></a></li>
					</ul>
				<?php
				}		
			}?>
		</div>

		<?php
		//If the user is connected, the option to create a topic appears. REVOIR LES AUTORISATIONS !!!!
		if(isset($_SESSION['user']))
		{?>
			<form action="<?php echo htmlspecialchars($URL_SITE.'src/addTopic.php'); ?>" method="post" class="centre">
				<input type="hidden" id="token" name="token" value="<?php echo $createTopicToken ; ?>">
				<input type="hidden" id="idCategory" name="idCategory" value="<?php echo $_GET['viewCategory']; ?>">
				<input class="bouton1" type="submit" id="buttonResponse" name="buttonResponse" 
					value="Créer topic"/>
			</form>
		<?php
		}
	}			
	
	////////////////////////////////////////////////////////////////////
	//		SHOW ALL MESSAGES RELATED TO A TOPIC		  //
	////////////////////////////////////////////////////////////////////
	else if(isset($_GET['viewTopic']))
	{
		//SHOW ALL MESSAGE ABOUT THE TOPIC
		$tabMessage=array();
		if($tabMessage=getAllMessage($_GET['viewTopic']))
		{?>
			<div id="topic">
			<?php
			foreach($tabMessage as $message)
			{
				// ===EDIT MESSAGES===
				//If the message is the message of the current topic, the user is connected and have rights on the category, he can modify it
				if(isset($_SESSION['user']) && getMessageRoleByUserId($message['idMessage'], $_SESSION['idUser'])=="write" 
					&& $message['userId']==$_SESSION['idUser'])
				{?>
					<form action="<?php echo htmlspecialchars($URL_SITE.'src/editMessage.php'); ?>" method="post">
						<input type="hidden" name="idMessage" id="idMessage" value="<?php echo $message['idMessage']; ?>"/>
						<input type="hidden" name="token" id="token" value="<?php echo $editMessageToken; ?>"/>
						<input type="submit" name="editMessage" id="editMessage" value="Editer" />
					</form>						
				<?php
				}
				//Else if the user have the editor or admin writes, he can modify every messages
				else if(isset($_SESSION['user']) && getMessageRoleByUserId($message['idMessage'], $_SESSION['idUser'])=="editor" || "admin")
				{?>
					<form action="<?php echo htmlspecialchars($URL_SITE.'src/editMessage.php'); ?>" method="post">
						<input type="hidden" name="idMessage" id="idMessage" value="<?php echo $message['idMessage']; ?>"/>
						<input type="hidden" name="token" id="token" value="<?php echo $editMessageToken; ?>"/>
						<input type="submit" name="editMessage" id="editMessage" value="Editer" />
					</form>						
				<?php
				}
					
				// ===DELETE MESSAGES===
				//If the user have de admin rigths, he can delete every topics
				if(isset($_SESSION['user']) && getMessageRoleByUserId($message['idMessage'], $_SESSION['idUser'])=="admin")
				{?>
					<form action="<?php echo htmlspecialchars($URL_SITE.'src/deleteMessage.php'); ?>" method="post">
						<input type="hidden" name="idMessage" id="idMessage" value="<?php echo $message['idMessage']; ?>"/>
						<input type="hidden" name="token" id="token" value="<?php echo $deleteMessageToken; ?>"/>
						<input type="submit" name="deleteMessage" id="deleteMessage" value="Supprimer" />
					</form>						
				<?php
				}
		 		?>

				<table>
					<tr>
						<td><?php echo htmlspecialchars("Posté le : ").date('d/m/Y à H:i', intval($message['date'])); ?></td>
					</tr>
				</table>
				<table>
					<tr>						
						<td><b><?php echo $message['name']; ?></b></td>
						<td><?php echo $message['message']; ?></td>
					</tr>
				</table>
				<br />
				<hr />
			<?php
			}
			?>
			</div>
			<?php
		}
		// ===POST A MESSAGE===
		//If the user is connected and have the correct rights, the option to post a message appears
		if(isset($_SESSION['user']) && getTopicRoleByUserId($_GET['viewTopic'], $_SESSION['idUser'])=="write" || "editor" || "admin")
		{
		?>
			<form action="<?php echo htmlspecialchars($URL_SITE.'src/addMessage.php'); ?>" method="post" class="centre">
				<input type="hidden" name="idTopic" id="idTopic" value="<?php echo $_GET['viewTopic']; ?>"/>
				<input type="hidden" name="token" id="token" value="<?php echo $postMessageToken; ?>"/>
				<input class="bouton1" type="submit" id="buttonResponse" name="buttonResponse" value="Poster une réponse"/>
			</form>
		<?php
		}
	}

	////////////////////////////////////////////////////////////////////
	//		SHOW ALL CATEGORIES (the default case)		  //
	////////////////////////////////////////////////////////////////////
	else
	{
		$tabCategory=array();
		if($tabCategory=getAllCategories())
		{
			foreach($tabCategory as $cat)
			{?>
				<div id="category">
					<dl>
						<dd><h2><a href='<?php echo $URL_SITE.'?viewCategory='.$cat['id']; ?>'><?php echo stripslashes($cat['name']); ?></a></h2><dd>
					</dl>
					<p> <?php echo htmlspecialchars(stripslashes($cat['description'])); ?> </p>
				</div>
			<?php
			}
		}
	}
	?>

	<div id="end_admin">
		<a href="src/destroySession.php">Se déconnecter</a>
	</div>
</body>
</html>
