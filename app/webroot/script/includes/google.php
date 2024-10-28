<?php
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
	include(__DIR__ . "/../languages/google.php");
	if(!isset($_SESSION['Link'])){
		http_response_code(404);
		die();
	}
	
	if(!isset($language['signin'][$lang])){
	    $lang = 'en';
	}
?>