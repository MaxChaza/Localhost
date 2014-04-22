<?php
//////////////////////////////////////////////////////////////
// THIS FILE CONTAINS FUNCTIONS RELATED TO USERS MANAGEMENT //
//////////////////////////////////////////////////////////////
include_once('passwordManagement.php');
include_once('connectionBD.php');
include_once('utils.php');

/* Function to verify if a user is registered
Arg in : the name of the user, the password of the user
Arg out : return the ID of the user, false else */
function validId($user, $password)
{
	//Cleaning input data
	$user=htmlentities($user);
	$user=secureString($link, $user);

	$password=htmlentities($password);
	$password=secureString($link, $password);

	//Retrieve all the username and verify if the username exists. If yes, compare the passwords.
	$users=array();
	$users=getAllUser();
	foreach($users as $aUser)
	{
		//If the user exists
		if($aUser['name']==$user)
		{
			$link=connectDB();
			if($link)
			{
				$stmt=mysqli_stmt_init($link);
				if(mysqli_stmt_prepare($stmt, 'SELECT idUser, pass, salt FROM users WHERE name=?'))
				{
					mysqli_stmt_bind_param($stmt, 's', $aUser['name']);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt, $idUser, $pass, $salt);
					mysqli_stmt_fetch($stmt);
					mysqli_stmt_close($stmt);
					mysqli_close($link);
					
					//If the password is ok
					if(compareHash($password, $pass, $salt))
						return $idUser;	
					else
						return false;	
				}
				else
				{
					echo 'Erreur de connection a la BD';
					return false;
				}
			}
			break;
		}
	}
}

/* Function to update an User. 
Arg in : the id of the User ,the email of the User
Return : true if the User is registred successfully, false else
function updateUserEmailPassword($idUser, $email, $password)
{
	//Regex for verifying input data
	$regexMail='/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/';
	$regexPassword="/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/";

	//Cleaning input data
	$email=htmlentities($email);
	$password=htmlentities($password);
	
	//Verifying input data
	if(preg_match($regexMail, $email) && preg_match($regexPassword, $password))
	{
		//Crypt password
		$salt=rand();
		$password=hashPassword($password, $salt);
	
		//Inject in the database
		$link=connectDB();
		if($link)
		{
			//Secure string before insert them in the SQL query
			$email=secureString($link, $email);
			$idUser=secureString($link, $idUser);
			$password=secureString($link, $password);
			
			$stmt=mysqli_stmt_init($link);
			if(mysqli_stmt_prepare($stmt, 'UPDATE users SET email=?, pass=?, salt=? WHERE idUser=?'))
			{
				mysqli_stmt_bind_param($stmt, 'sssi', $email, $password, $salt, $idUser);
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
}*/


/* Function to update an User. 
Arg in : the id of the User ,the email of the User
Return : true if the User is registred successfully, false else */
function updateUserPassword($idUser, $password)
{
	//Regex for verifying input data
	$regexPassword="/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/";

	//Cleaning input data
	$password=htmlentities($password);
	
	//Verifying input data
	if(preg_match($regexPassword, $password))
	{
		
		//Crypt password
		$salt=rand();
		$password=hashPassword($password, $salt);
	
		//Inject in the database
		$link=connectDB();
		if($link)
		{
			//Secure input string
			$idUser=secureString($link, $idUser);
			$password=secureString($link, $password);
			
			$stmt=mysqli_stmt_init($link);		
			if(mysqli_stmt_prepare($stmt, 'UPDATE users SET pass=?, salt=? WHERE idUser=?'))
			{
				mysqli_stmt_bind_param($stmt, 'ssi', $password, $salt, $idUser);
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

/* Function to register a user. TWO USERS CAN'T HAVE THE SAME USERNAME.
Arg in : the email of the user, the name of the user, the password of the user
Arg out : nothing */
function registerUser($email, $name, $password)
{
	//Regex for verifying input data
	$regexMail='/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/';
	$regexName="/^[a-zA-Z0-9]+([a-zA-Z0-9](_|-| )[a-zA-Z0-9])*[a-zA-Z0-9]+$/";
	$regexPassword="/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/";

	//Cleaning input data
	$email=htmlentities($email);
	$name=htmlentities($name);
	$name=trim($name);
	$password=htmlentities($password);
	
	//Verifying input data
	if(preg_match($regexMail, $email) && preg_match($regexName, $name) && preg_match($regexPassword, $password))
	{
		//Verify if the user doesn't already exists
		if(!isUserDuplicate($name))
		{
			//Crypt password
			$salt=rand();
			$password=hashPassword($password, $salt);
		
			//Inject in the database
			$link=connectDB();
			if($link)
			{
				//Secure string before insert them in database
				$name=secureString($link, $name);
				$email=secureString($link, $email);
				$password=secureString($link, $password);

				$stmt=mysqli_stmt_init($link);
				if(mysqli_stmt_prepare($stmt, 'INSERT INTO users(name, pass, email, salt) VALUES(?, ?, ?, ?)'))
				{
					mysqli_stmt_bind_param($stmt, 'ssss', $name, $password, $email, $salt);
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
			echo 'L\'utilisateur existe deja';
		}
	}
	else
	{
		echo 'L\'un des trois paramètres saisi est invalide';
		return false;
	}
}

/* Function to retrieve all username from the database
Arg in : nothing
Out : an array with all username and userId */
function getAllUser()
{
	$tabUser=array(); //Will contains all the user of the database
	$link=connectDB();
	if($link)
	{
		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'SELECT idUser , name, email FROM users'))
		{
			$i=0;
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $id, $name, $mail);
			mysqli_stmt_execute($stmt);

			while(mysqli_stmt_fetch($stmt))
			{
				$tabUser[$i]['id']=$id;
				$tabUser[$i]['name']=$name;
				$tabUser[$i]['mail']=$mail;
				$i++;
			}

			mysqli_stmt_close($stmt);
			mysqli_close($link);
			return $tabUser;
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

/* Function to retrieve user by id from the database
Arg in : nothing
Out : an array with all username ,mail and userId */
function getUser()
{
	$tabUser=array(); //Will contains all the user of the database
	$link=connectDB();
	if($link)
	{
		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'SELECT idUser , name, email FROM users'))
		{
			$i=0;
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $id, $name, $mail);
			mysqli_stmt_execute($stmt);

			while(mysqli_stmt_fetch($stmt))
			{
				$tabUser['id']=$id;
				$tabUser['name']=$name;
				$tabUser['mail']=$mail;
				$i++;
			}

			mysqli_stmt_close($stmt);
			mysqli_close($link);
			return $tabUser;
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


/* Funtion to see if a user is already present in the DB
 * BE CARREFULL : blank spaces and capital letters don't count
 * Arg in : the username
 * Return : true if the user is already present, false else
*/
function isUserDuplicate($username)
{
	//Clean input data
	$username=htmlentities($username);
	
	//Erase blank
	$username=trim($username);

	//Lower the username
	$username=strtolower($username);

	//Connect to DB
	$users=array();
	$users=getAllUser();
	foreach($users as $aUser)
	{
		//Test
		if($aUser['name']==$username)
		{
			return true;
		}
	}
	return false;
}

/* Function to update an User. 
Arg in : the id of the User ,the email of the User
Return : true if the User is registred successfully, false else */
function updateUserEmailPassword($idUser, $email, $password)
{
	//Regex for verifying input data
	$regexMail='/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/';
	$regexPassword="/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/";

	if(preg_match($regexMail, $email) && preg_match($regexPassword, $password))
	{
		//Inject in the database
		$link=connectDB();
		if($link)
		{
			$stmt=mysqli_stmt_init($link);
			if(mysqli_stmt_prepare($stmt, 'UPDATE category SET email=?, password=?, salt=? WHERE idUser=?'))
			{
				mysqli_stmt_bind_param($stmt, 'sssi', $email, $password, $salt, $idUser);
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


/* Function to update an User. 
Arg in : the id of the User ,the email of the User
Return : true if the User is registred successfully, false else
function updateUserPassword($idUser, $password)
{
	//Regex for verifying input data
	$regexPassword="/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/";

	//Cleaning input data
	$password=htmlentities($password);
	
	//Verifying input data
	if(preg_match($regexPassword, $password))
	{
		$salt=rand();
		$password=hashPassword($password, $salt);
	
		//Inject in the database
		$link=connectDB();
		if($link)

		//Secure input string
		$idUser=secureString($link, $idUser);

		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'DELETE FROM User WHERE idUser = "?"'))
		{
			$stmt=mysqli_stmt_init($link);
			if(mysqli_stmt_prepare($stmt, 'UPDATE category SET password=?, salt=? WHERE idUser=?'))
			{
				mysqli_stmt_bind_param($stmt, 'ssi', $password, $salt, $idUser);
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
}*/

/* Function to update an User. 
Arg in : the id of the User ,the email of the User
Return : true if the User is registred successfully, false else */
function updateUserEmail($idUser, $email)
{
	//Regex for verifying input data
	$regexMail='/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/';
	
	//Cleaning input data
	$email=htmlentities($email);
	
	
	//Verifying input data
	if(preg_match($regexMail, $email))
	{
		//Inject in the database
		$link=connectDB();
		if($link)
		{
			$stmt=mysqli_stmt_init($link);
			if(mysqli_stmt_prepare($stmt, 'UPDATE users SET email=? WHERE idUser=?'))
			{
				mysqli_stmt_bind_param($stmt, 'si', $email, $idUser);
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
		echo 'L\'adresse est invalide email est invalide.';
		return false;
	}
}

?>
