<?php
////////////////////////////////////
// 	SOME USEFULL FUNCTIONS 	      //
////////////////////////////////////

/* This funtion permits tu secure data before put them in the database
Arg in : the string to secure
Returns : the string secured */
function secureString($string)
{
	if(ctype_digit($string))
		$string=intval($string);
	else
	{
		$string=mysql_real_escape_string($string);
		$string=addcslashes($string, '%_');
	}
	
	return $string;
}


/* This function permit us to create tokens in order to securise data from form and CSRF attacks
BE CARREFUL : you must have lunch a session before using this function
Arg in : the name of the token
Return : a token (string) */
function createToken($name)
{
	$token=NULL;
	$token=uniqid(rand(), true);
	$_SESSION[$name.'Token']=$token;
	$_SESSION[$name.'Token_time']=time();
	return $token;
}

/* This function permit to verify if a token is valid
BE CARREFUL : you must have lunch a session before using this function
Arg in : the name of the token, the referer (the page where the user must come from, the time before the token is invalid
Return : a token (string) */
function validToken($name, $referer, $time)
{
	if(isset($_SESSION[$name.'Token']) && isset($_SESSION[$name.'Token_time']) && isset($_POST['token']))
		if($_SESSION[$name.'Token']===$_POST['token'])
			if($_SESSION[$name.'Token_time']>=(time()-$time))
				if($_SERVER['HTTP_REFERER']==$referer)
					return true;
	return false;
}
?>
