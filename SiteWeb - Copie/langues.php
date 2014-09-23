<?php
	header("Cache-Control: no-cache"); //vider le cache
	$default_lang = 'fr'; //langue par défaut
	//$dir_lang = './langues/'; //répertoire des fichiers langues
	$extension = '.php'; //extension des fichiers langue
	
	/*
	 * liste des fichiers langue disponibles
	 * s'assurer que chacun de ces fichiers existe bien dans
	 * le répertoire
	*/
	$languages = array('en', 'fr');
	$lang = '';
	
	//Langue utilisateur
	$language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$language = $language{0}.$language{1};
	
	/*
	 * si le paramètre "lang" est défini dans l'url et s'il existe dans la liste
	 * $lang prend la valeur de $_GET['lang']
	 */
	if (isset($_GET['lang']) AND in_array($_GET['lang'], $languages)) {
		$lang = $_GET['lang'];
	}
	
	/*
	 * sinon vérifier prendre la valeur du cookie $_COOKIE['lang'] (s'il est défini)
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
	 * quelque soit la langue d'affichage sélectionnée
	 * inclure le fichier langue par défaut pour ne manquer
	 * aucune variable 
	 */
	include($dir_lang . $default_lang . $page . $extension);
	include($dir_lang . $default_lang . 'headfeet' . $extension);
	
	/*
	 * seulement après, vérifier que le fichier langue
	 * défini dans $lang existe et l'inclure
	 */
	if (!empty($lang) && is_file($dir_lang. $lang . $page . $extension)) {
		include($dir_lang . $lang . $page . $extension);
		include($dir_lang . $lang . 'headfeet' . $extension);
	}
?>