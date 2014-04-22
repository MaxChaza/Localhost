<?php
//////////////////////////////////////////////////////////////
// THIS FILE CONTAINS FUNCTIONS RELATED TO ROLE MANAGEMENT //
//////////////////////////////////////////////////////////////
include_once('connectionBD.php');
include_once('utils.php');

/* Function to give rights to user 
Arg in : idUser, idCategory
Out : true if it right, false if it fails */
function giveRight($idUser, $idCategory, $role)
{
	$idUser=htmlentities($idUser);
	$idCategory=htmlentities($idCategory);
	$role=htmlentities($role);
	
	$users=array();
	$users=getAllUser();
	
	$categories=array();
	$categories=getAllCategories();
	$i=0;
	foreach($users as $aUser)
	{
		//If the user exists
		if($users[$i]['id']==$idUser)
		{
			foreach($categories as $aCategory)
			{
				//If the category exists
				if($aCategory['id']==$idCategory)
				{
					$link=connectDB();
					if($link)
					{
						//Secure input data before SQL query
						$idCategory=secureString($link, $idCategory);
						$idUser=secureString($link, $idUser);
						$role=secureString($link, $role);

						$stmt=mysqli_stmt_init($link);
						if(mysqli_stmt_prepare($stmt, 'INSERT INTO role (idCategory, idUser, role) VALUES(?, ?, ?)'))
						{
							mysqli_stmt_bind_param($stmt, 'iis', $aCategory['id'], $users[$i]['id'], $role);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_close($stmt);
							mysqli_close($link);
								
							return true;
						}
						
					}
					break;
				}
			}
			break;
		}
		$i=$i+1;
	}
}


/* Function to retrieve all roles from the database
Arg in : idUser, idCategory, role
Out : true if the role exist, false if not */
function roleExist($idUser, $idCategory, $role)
{
	$idRole=NULL; //Will contains the rights of the user
	//Connect to the DB
	$link=connectDB();
	if($link)
	{
		//Cleaning input entry
	
		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'SELECT idRole FROM role  WHERE idUser=? AND idCategory=? AND role=?'))
		{	
			mysqli_stmt_bind_param($stmt, 'iis', $idUser, $idCategory, $role);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $idRole);
			mysqli_stmt_fetch($stmt);
			
			if($idRole==NULL)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	}
}

/* Function to retrieve all roles from the database
Arg in : nothing
Out : an array with all roles, false if it fails */
function getAllRoles()
{
	$tabRoles=array(); 
	$role1 = "Write : Poster un message et pouvoir le modifier plus tard";
	$role2 = "Editor : Modifier n'importe quel message";
	$role3 = "Admin : Effacer n'importe quel message";

	$tabRoles[0]=$role1;
	$tabRoles[1]=$role2;
	$tabRoles[2]=$role3;

	return $tabRoles;		
}

function removeRoleByUser($idUser)
{
	$idUser=htmlentities($idUser);
	
	$users=array();
	$users=getAllUser();
	
	$i=0;
	
	foreach($users as $aUser)
	{
		//If the user exists
		if($users[$i]['id']==$idUser)
		{
			$link=connectDB();
			if($link)
			{
				//Secure input data before SQL query
				$idUser=secureString($link, $idUser);

				$stmt=mysqli_stmt_init($link);
				if(mysqli_stmt_prepare($stmt, 'DELETE FROM role WHERE idUser = ?'))
				{
					mysqli_stmt_bind_param($stmt, 'i', $users[$i]['id']);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
					mysqli_close($link);
						
					return true;
				}
			}
			break;
		}
		$i=$i+1;
	}
}

function removeRoleByUserCategory($idUser,$idCategory,$role)
{
	$idUser=htmlentities($idUser);
	$idCategory=htmlentities($idCategory);
	$role=htmlentities($role);
	
	$users=array();
	$users=getAllUser();
	
	$i=0;
	
	foreach($users as $aUser)
	{
		//If the user exists
		if($users[$i]['id']==$idUser)
		{
			$categories=array();
			$categories=getAllCategories();
			
			$j=0;
			foreach($categories as $aCategory)
			{
				//If the category exists
				if($categories[$j]['id']==$idCategory)
				{
				
						$link=connectDB();
						if($link)
						{
							//Secure input data before SQL query
							$idUser=secureString($link, $idUser);

							$stmt=mysqli_stmt_init($link);
							if(mysqli_stmt_prepare($stmt, 'DELETE FROM role WHERE idUser = ? AND idCategory = ? AND role = ?'))
							{
								mysqli_stmt_bind_param($stmt, 'iis',  $idUser,$idCategory,$role);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_close($stmt);
								mysqli_close($link);
									
								return true;
							}
						}
						break;
				}
				$j=$j+1;
			}
			break;
		}
		$i=$i+1;
	}
}

function removeRoleByCategory($idCategory)
{
	$idUser=htmlentities($idCategory);
	
	$categories=array();
	$categories=getAllCategories();
	
	$i=0;
	
	foreach($categories as $aCategory)
	{
		//If the user exists
		if($categories[$i]['id']==$idCategory)
		{
			$link=connectDB();
			if($link)
			{
				$stmt=mysqli_stmt_init($link);
				if(mysqli_stmt_prepare($stmt, 'DELETE FROM role WHERE idCategory = ?'))
				{
					mysqli_stmt_bind_param($stmt, 'i', $categories[$i]['id']);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
					mysqli_close($link);
		
					return true;
				}
			}
			break;
		}
		$i=$i+1;
	}
}

/* This funtion permtis tu retrieve the kind of rights a user have on a topic (which belongs to a category)
Arg in : the id of the user, the category we want to have rights
Returns : a string with "Write", "Editor or "Admin" */ 
function getTopicRoleByUserId($idTopic, $idUser)
{
	$role=NULL; //Will contains the rights of the user
	//Connect to the DB
	$link=connectDB();
	if($link)
	{
		//Cleaning input entry
		$idUser=secureString($link, $idUser);
		$idTopic=secureString($link, $idTopic);
		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'SELECT r.role FROM role r
						INNER JOIN category c ON r.idCategory=c.idCategory
						INNER JOIN topic t ON  c.IdCategory=t.IdCategory
						WHERE r.idUser=? AND  t.idTopic=?'))
		{	
			mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idTopic);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $role);
			mysqli_stmt_fetch($stmt);
			return $role;
		}
	}
}

/* This funtion permtis tu retrieve the kind of rights a user have on a message.
It's usefull to manage the editor rights
Arg in : the id of the user, the category we want to have rights
Returns : a string with "Write", "Editor or "Admin" */ 
function getMessageRoleByUserId($idMessage, $idUser)
{
	$role=NULL; //Will contains the rights of the user
	//Connect to the DB
	$link=connectDB();
	if($link)
	{
		//Cleaning input entry
		$idUser=secureString($link, $idUser);
		$idMessage=secureString($link, $idMessage);
		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'SELECT r.role
						FROM role r
						INNER JOIN message m ON r.idUser = m.idUser
						WHERE r.idUser =?
						AND m.idMessage =?'))
		{	
			mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idMessage);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $role);
			mysqli_stmt_fetch($stmt);
			return $role;
		}
	}
}

/* This funtion permtis tu retrieve the kind of rights a user have on a category
Arg in : the id of the user, the category we want to have rights
Returns : a string with "Write", "Editor or "Admin" */ 
function getCategoryRoleByUserId($categoryId, $userId)
{
	$role=NULL; //Will contains the rights of the user
	//Connect to the DB
	$link=connectDB();
	if($link)
	{
		//Cleaning input entry
		$userId=secureString($link, $userId);
		$categoryId=secureString($link, $categoryId);

		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'SELECT r.role FROM role r WHERE r.idUser=? AND r.idCategory=?'))
		{	
			mysqli_stmt_bind_param($stmt, 'ii', $userId, $categoryId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $role);
			mysqli_stmt_fetch($stmt);
			return $role;
		}
	}
}

/* This funtion permtis tu retrieve the kind of rights a category have
Arg in : the id of the category 
Returns : a table with nameUser, nameCategory, role */ 
function getRoleByIdCategory($idCategory)
{

	$nameUser=NULL;//Will contains the name of the user
	$nameCategory=NULL;//Will contains the name of the category
	$role=NULL; //Will contains the rights of the user
	$tabRole=array();
	//Connect to the DB
	$link=connectDB();
	if($link)
	{
		//Cleaning input entry
		$idCategory=secureString($link, $idCategory);

		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'SELECT r.role,u.name,c.name FROM role r 
										INNER JOIN category c ON c.idCategory=r.idCategory
										INNER JOIN users u ON u.idUser=r.idUser
										WHERE r.idCategory=?'))
		{	
			mysqli_stmt_bind_param($stmt, 'i',$idCategory);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $role,$nameUser,$nameCategory);
			$i=0;
			while (mysqli_stmt_fetch($stmt)) {
						$tabRole[$i]['role']=$role;
						$tabRole[$i]['nameUser']=$nameUser;
						$tabRole[$i]['nameCategory']=$nameCategory;
						$i=$i+1;
			}
		
			return $tabRole;
		}
	}
}
?>
