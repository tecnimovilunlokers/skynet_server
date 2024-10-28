<?php
	error_reporting(0);
	$script_location = "script/$script_folder/";
	$script_path = $script_location."index.php";
	
	if (file_exists($script_path)) {
		echo "<head><base href=\"$script_location\"></head>";
		include $script_path;
	}else{
		http_response_code(404);
		die("<h1 style=\"margin:0px;\">Script not found!</h1><p style=\"margin:0px;\">webroot/$script_path</p>");
	}
	
?>