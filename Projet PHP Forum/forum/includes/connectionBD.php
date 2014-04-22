<?php
//Configuration file of the database
include_once('config.php');

/* Function to connect to the database and select the database
 * Return -1 if it fails, the number of the connection if it's ok */
function connectDB()
{
	global $DB_HOST, $DB_NAME, $DB_PASS;
	$link=mysqli_connect($DB_HOST, $DB_NAME, $DB_PASS); //Virer le MYSQL_CLIENT_SSL
	$select=mysqli_select_db($link, "forum");
	if($link && $select)
		return $link;
	else
		return -1;
}
?>
