<?php
////////////////////////////////////////////////////////////////
// THIS FILE CONTAINS FUNCTIONS RELATED TO MESSAGE MANAGEMENT //
////////////////////////////////////////////////////////////////
include_once('connectionBD.php');
include_once('utils.php');

/* Function to register a MESSAGE. 
Arg in : the id of the topic of the message, the id of the creator of the message
Return : true if the message is registred successfully, false else */
function registerMessage($idTopic, $idUser, $message)
{
	//Cleaning input data
	$idTopic=htmlentities($idTopic);
	$idUser=htmlentities($idUser);
	$message=htmlentities($message);
	$message=trim($message);

	//The publication date is a timestamp
	$date=time();

	//Verifying input data IL FAUDRA VERIFIER LA VALIDITE DES ID
	if(strlen(trim($message))>0)
	{
		//Inject in the database
		$link=connectDB();
		if($link)
		{
			//Secure input data before SQL query
			$idTopic=secureString($link, $idTopic);
			$idUser=secureString($link, $idUser);
			$message=secureString($link, $message);

			$stmt=mysqli_stmt_init($link);
			if(mysqli_stmt_prepare($stmt, 'INSERT INTO message(idTopic, idUser, message, date) VALUES(?, ?, ?, ?)'))
			{
				mysqli_stmt_bind_param($stmt, 'iisi', $idTopic, $idUser, $message, $date);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				mysqli_close($link);
				return true;
			}
		}
		else
		{
			echo 'Erreur de connection a la BD';
			return false;
		}
	}
	else
	{
		echo 'Le titre ou la date de publication du message est invalide';
		return false;
	}
}

/* Function to update a MESSAGE. 
Arg in : the id of the message, the id of the topic of the message, the id of the creator of the message, and the message
Return : true if the message is registred successfully, false else */
function updateMessage($idMessage,$message)
{
	//Cleaning input data
	$message=htmlentities($message);
	$message=trim($message);
	
	//Inject in the database
	$link=connectDB();
	if($link)
	{
		//Secure input data before SQL query
		$idMessage=secureString($link, $idMessage);
		$message=secureString($link, $message);

		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'UPDATE message m SET m.message=? WHERE idMessage=?'))
		{
			mysqli_stmt_bind_param($stmt, 'si', $message, $idMessage);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($link);
			return true;
		}
	}
	else
	{
		echo 'Erreur de connection a la BD';
	}
	
}


/* Function to retrieve all messages from a topic
Arg in : the id of the topic
Out : an array with all messages, false if it fails */
function getAllMessage($idTopic)
{
	//Control the idTopic
	if(is_numeric($idTopic) && $idTopic>0)
	{
		$tabMessages=array(); //Will contains all the messages of the database
		$link=connectDB();
		if($link)
		{
			//Secure input data before SQL query
			$idTopic=secureString($link, $idTopic);

			$stmt=mysqli_stmt_init($link);
			if(mysqli_stmt_prepare($stmt, 'SELECT m.idMessage, u.idUser, u.name, m.message, m.date FROM message m
							INNER JOIN users u ON m.idUser=u.idUser
							WHERE idTopic= ?'))
			{
				mysqli_stmt_bind_param($stmt, 'i', $idTopic);			
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $idMessage, $userId, $name, $message, $date);
				mysqli_stmt_execute($stmt);
				
				$i=0;
				while(mysqli_stmt_fetch($stmt))
				{
					$tabMessages[$i]['idMessage']=$idMessage;
					$tabMessages[$i]['userId']=$userId;
					$tabMessages[$i]['name']=$name;
					$tabMessages[$i]['message']=$message;
					$tabMessages[$i]['date']=$date;
					$i++;
				}
				mysqli_stmt_close($stmt);
				mysqli_close($link);
				
				return $tabMessages;
			}
			else
			{
				echo 'Erreur de connection a la BD';
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}

/* Function to delete a Message. 
Arg in : the id of the Message
Arg out : nothing */
function removeMessage($idMessage)
{
	//remove in the database
	$link=connectDB();
	if($link)
	{
		//Secure input data before SQL query
		$idMessage=secureString($link, $idMessage);
		
		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'DELETE FROM message WHERE idMessage = ?'))
		{
			mysqli_stmt_bind_param($stmt, 'i', $idMessage);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($link);
			return true;
		}
	}
	else
	{
		echo 'Erreur de connection a la BD';
		return false;
	}
}

/* Function tu retrieve the body of a message
Arg in : the id of the message
Returns : a string with the message */
function getMessageBody($idMessage)
{
	$message=NULL; //Will contains the body of the message
	//Connect to the DB
	$link=connectDB();
	if($link)
	{
		//Cleaning input entry
		$idMessage=secureString($link, $idMessage);
		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'SELECT m.message FROM message m WHERE m.idMessage=?'))
		{	
			mysqli_stmt_bind_param($stmt, 'i', $idMessage);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $message);
			mysqli_stmt_fetch($stmt);
			return $message;
		}
	}
}

/* Funtion to retrieve the id of a topic with the id of a message
Arg in : th id of the message
Returns : the id of the topic that correspond to, else false */
function getTopicIdByMessageId($idMessage)
{
	$idTopic=NULL; //Will contains the body of the message
	//Connect to the DB
	$link=connectDB();
	if($link)
	{
		//Cleaning input entry
		$idMessage=secureString($link, $idMessage);
		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'SELECT m.idTopic FROM message m WHERE m.idMessage=?'))
		{	
			mysqli_stmt_bind_param($stmt, 'i', $idMessage);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $idTopic);
			mysqli_stmt_fetch($stmt);
			return $idTopic;
		}
	}
	else
	{
		echo 'Erreur de connection a la BD';
		return false;
	}
}
?>
