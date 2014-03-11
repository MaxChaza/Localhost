<?php
	header("Cache-Control: no-cache"); //vider le cache
	$default_lang = 'fr'; //langue par d�faut
	//$dir_lang = './langues/'; //r�pertoire des fichiers langues
	$extension = '.php'; //extension des fichiers langue
	
	/*
	 * liste des fichiers langue disponibles
	 * s'assurer que chacun de ces fichiers existe bien dans
	 * le r�pertoire
	*/
	$languages = array('en', 'fr');
	$lang = '';
	
	//Langue utilisateur
	$language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$language = $language{0}.$language{1};
	
	/*
	 * si le param�tre "lang" est d�fini dans l'url et s'il existe dans la liste
	 * $lang prend la valeur de $_GET['lang']
	 */
	if (isset($_GET['lang']) AND in_array($_GET['lang'], $languages)) {
		$lang = $_GET['lang'];
	}
	
	/*
	 * sinon v�rifier prendre la valeur du cookie $_COOKIE['lang'] (s'il est d�fini)
	 */
	else if (isset($_COOKIE['lang']) AND in_array($_COOKIE['lang'], $languages)) {
		$lang = $_COOKIE['lang'];
		
	}
	/*
	 * si le "language" de l'utilisateur existe dans la liste
	 * $lang prend la valeur de $language
	 */
	else if (isset($language) AND in_array($language, $languages)) {
		$lang = $language;
	}
	
	/*
	 * sauver la valeur de $lang dans le cookie $_COOKIE['lang']
	 */
	if (!empty($lang)) {
		setcookie('lang', $lang, time()+600,'/');
		setcookie('lang', $lang, time()+600,'/src/');
	}
	/*
	 * quelque soit la langue d'affichage s�lectionn�e
	 * inclure le fichier langue par d�faut pour ne manquer
	 * aucune variable 
	 */
	include($dir_lang . $default_lang . $page . $extension);
	include($dir_lang . $default_lang . 'headfeet' . $extension);
	
	/*
	 * seulement apr�s, v�rifier que le fichier langue
	 * d�fini dans $lang existe et l'inclure
	 */
	if (!empty($lang) && is_file($dir_lang. $lang . $page . $extension)) {
		include($dir_lang . $lang . $page . $extension);
		include($dir_lang . $lang . 'headfeet' . $extension);
	}
?>