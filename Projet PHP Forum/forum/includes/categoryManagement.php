<?php
//////////////////////////////////////////////////////////////
// THIS FILE CONTAINS FUNCTIONS RELATED TO CATEGORY MANAGEMENT //
//////////////////////////////////////////////////////////////
include_once('connectionBD.php');
include_once('utils.php');

/* Function to register a CATEGORY. 
Arg in : the name of the category, the description of the category
Return : true if the category is registred successfully, false else */
function registerCategory($name, $description)
{
	//Cleaning input data
	$name=htmlentities($name);
	$name=trim($name);

	$description=htmlentities($description);
	$description=trim($description);

	//Verifying input data
	if(strlen(trim($name))>0)
	{
		//Inject in the database
		$link=connectDB();
		if($link)
		{
			//Secure input data before SQL query
			$name=secureString($link, $name);
			$description=secureString($link, $description);

			$stmt=mysqli_stmt_init($link);
			if(mysqli_stmt_prepare($stmt, 'INSERT INTO category(name,description) VALUES( ?, ?)'))
			{
				mysqli_stmt_bind_param($stmt, 'ss', $name, $description);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				mysqli_close($link);
				return true;
			}
		}
		else
		{
			echo 'Erreur de connection a la BD <br />';
		}
	}
	else
	{
		echo 'Le nom de la description et/ou la description est invalide <br />';
		return false;
	}
}

/* Function to update a CATEGORY. 
Arg in : the name of the category, the description of the category
Return : true if the category is registred successfully, false else */
function updateCategory($idCategory, $name, $description)
{
	
	//Cleaning input data
	$idCategory=htmlentities($idCategory);
	$description=htmlentities($description);
	$description=trim($description);

	//Verifying input data
	if(strlen(trim($description))>0)
	{
		//Inject in the database
		$link=connectDB();
		if($link)
		{
			//Secure input data before SQL query
			$idCategory=secureString($link, $idCategory);
			$name=secureString($link, $name);
			$description=secureString($link, $description);

			$stmt=mysqli_stmt_init($link);
			if(mysqli_stmt_prepare($stmt, 'UPDATE category SET description=?, name=? WHERE idCategory=?'))
			{
				mysqli_stmt_bind_param($stmt, 'ssi', $description, $name, $idCategory);
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

/* Function to retrieve all categories from the database
Arg in : nothing
Out : an array with all categories, false if it fails */
function getAllCategories()
{
	$tabCategories=array(); //Will contains all the categories of the database
	
	$link=connectDB();
	if($link)
	{
		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'SELECT idCategory, name,description FROM category'))
		{
			$i=0;
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $id, $name, $description );
			mysqli_stmt_execute($stmt);

			while(mysqli_stmt_fetch($stmt))
			{
				$tabCategories[$i]['id']=$id;
				$tabCategories[$i]['name']=$name;
				$tabCategories[$i]['description']=$description;
				$i++;
			}
			mysqli_stmt_close($stmt);
			mysqli_close($link);
			return $tabCategories;
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


/* Function to delete a Category. 
Arg in : the id of the Category
Arg out : nothing */
function removeCategory($idCategory)
{
	//remove in the database
	$link=connectDB();
	if($link)
	{
		//Secure input data before SQL query
		$idCategory=secureString($link, $idCategory);

		$stmt=mysqli_stmt_init($link);
		if(mysqli_stmt_prepare($stmt, 'DELETE FROM category WHERE idCategory = ?'))
		{
			mysqli_stmt_bind_param($stmt, 'i', $idCategory);
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
