<?php

/////////////////////////////////////////////////////////////////
// THIS FILE CONTAINS FUNCTIONS RELATED TO PASSWORD MANAGEMENT //
//////////////////////////////////////////////////////////////

//This is a static seed for the hash
$staticSalt='superfouine';

/* Function to hash the password with a static salt and a random salt with SHA1
Arg in : the password, a salt
Arg out : the hash of the password */
function hashPassword($password, $salt)
{
	//Get the three first char of the password
	$debutPassword=substr($password, 0, 3);
	//Get the end of the password
	$finPassword=substr($password, -strlen($password)+3);
	//Make an hash of the password with the salt
	global $staticSalt;
	return sha1($debutPassword.$staticSalt.$salt.$finPassword);
}

/* Function to compare the hash
Arg in : the hash1
Arg out : true if the hashes are equals, false in the other case */
function compareHash($password, $hash, $aleaSalt)
{
	$password=hashPassword($password, $aleaSalt);
	if($password==$hash)
		return true;
	else
		return false;
}