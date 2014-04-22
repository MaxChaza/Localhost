<?php
//////////////////////////////////////////////////////////////
// THIS FILE CONTAINS FUNCTIONS RELATED TO TOPIC MANAGEMENT //
//////////////////////////////////////////////////////////////
include_once('connectionBD.php');
include_once('utils.php');

/* Function to register a TOPIC. 
Arg in :  the id of his category, the id of his creator, the title of the topic
Arg out : nothing */
function registerTopic($title, $idUser, $idCategory)
{
	//Cleaning input data
	$idCategory=htmlentities($idCategory);
	$idUser=htmlentities($idUser);
	$title=htmlentities($title);
	$title=trim($title);

	//Using timestamp for the date
	$date=time();
	$editDate=$date;
	
	//Verifying input data
	if(strlen(trim($title))>0)
	{
		//Inject in the database
		$link=connectDB();
		if($link)
		{
			//Secure input data before SQL query
			$idCategory=secureString($link, $idCategory);
			$idUser=secureString($link, $idUser);
			$date=secureString($link, $date);
			$editDate=secureString($link, $editDate);
			$title=secureString($link, $title);

			$stmt=mysqli_stmt_init($link);
			if(mysqli_stmt_prepare($stmt, 'INSERT INTO topic(idCategory, idUser, title, date, editDate) VALUES(?, ?, ?, ?, ?)'))
			{
				mysqli_stmt_bind_param($stmt, 'iisii', $idCategory, $idUser, $title, $date, $editDate);
				mysqli_stmt_execute($stmt);
				$topicId=NULL;
				$topicId=mysqli_insert_id($link);
				mysqli_stmt_close($stmt);
				mysqli_close($link);
				return $topicId;
			}
			else
				return false;
		}
		else
		{
			echo 'Erreur de connection a la BD';
			return false;
		}
	}
	else
	{
		echo 'Le paramètre name saisi est invalide';
		return false;
	}
}


/* Function to update a Topic. 
Arg in : the id of the topic ,the title of the topic
Return : true if the Topic is registred successfully, false else */
function updateTopic($idTopic, $title, $editDate)
{
	$regexTitle="/^[a-zA-Z0-9]+([a-zA-Z0-9](_|-| )[a-zA-Z0-9])*[a-zA-Z0-9]+$/";

	//Cleaning input data
	$idTopic=htmlentities($idTopic);
	$title=htmlentities($title);
	$title=trim($title);

	$editDate=time();

	//Verifying input data
	if(preg_match($regexTitle, $title))
	{
		//Inject in the database
		$link=connectDB();
		if($link)
		{
			//Secure input data before SQL query
			$idTopic=secureString($link, $idTopic);
			$title=secureString($link, $title);

			$stmt=mysqli_stmt_init($link);
			if(mysqli_stmt_prepare($stmt, 'UPDATE topic SET title="?", editDate=? WHERE idTopic=?'))
			{
				mysqli_stmt_bind_param($stmt, 'sii', $title, $editDate, $idTopic);
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
	else
	{
		echo 'Le nom de la description et/ou la description est invalide';
		return false;
	}
}

/* Function to retrieve all topics from the database
Arg in : the number of the category that contains the topic
Out : an array with all topics */
function getAllTopics($idCategory)
{
	//Cleaning input data (idCategory)
	if(is_numeric($idCategory) && $idCategory>0)
	{
		$tabTopics=array(array()); //Will contains the topics
		$link=connectDB();
		if($link)
		{
			//Secure input data before SQL query
			$idCategory=secureString($link, $idCategory);

			$stmt=mysqli_stmt_init($link);
			if(mysqli_stmt_prepare($stmt, 'SELECT idTopic, title, date, editDate FROM topic WHERE idCategory = ?'))
			{	
				mysqli_stmt_bind_param($stmt, 'i', $idCategory);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $idTopic, $title, $date, $editDate);
				
				$i=0;
				while(mysqli_stmt_fetch($stmt))
				{
					$tabTopics[$i]['idTopic']=$idTopic;
					$tabTopics[$i]['title']=$title;
					$tabTopics[$i]['date']=$date;
					$tabTopics[$i]['editDate']=$editDate;
					$i++;
				}

				mysqli_stmt_close($stmt);
				mysqli_close($link);
				return $tabTopics;
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
	else
	{
		echo 'Catégorie inexistante<br />';
		return false;
	}
}


/* Function to retrieve all topics ID's from the database
Arg in : nothing
Out : an array with all topics ID's*/
function getAllTopicId()
{
	$tabTopics=array(); //Will contains the topics ID's
	$link=connectDB();
	if($link)
	{
		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'SELECT idTopic FROM topic'))
		{	
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $idTopic);
			
			$i=0;
			while(mysqli_stmt_fetch($stmt))
			{
				$tabTopics[$i]=$idTopic;
				$i++;
			}

			mysqli_stmt_close($stmt);
			mysqli_close($link);
			return $tabTopics;
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

/* Function to test if a topic exists
It is to test if a topic exists in the case of the user try to change manually the $_GET values
Arg in : a positive int
Out : true if the topic exists, false else */
function isAValidTopic($topicId)
{
	if(is_numeric($topicId) && $topicId>0)
	{
		$tabTopic=array();
		$tabTopic=getAllTopicId();
		if(in_array($topicId, $tabTopic))
			return true;
		else
			return false;
	}
	else
		return false;
}

/* Function to delete a TOPIC. 
Arg in : the id of the topic
Arg out : nothing */
function removeTopic($idTopic)
{
	$link=connectDB();
	if($link)
	{
		//Secure input data before SQL query
		$idTopic=secureString($link, $idTopic);

		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'DELETE FROM Topic WHERE idTopic = "?"'))
		{
			mysqli_stmt_bind_param($stmt, $idTopic);
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
?>
