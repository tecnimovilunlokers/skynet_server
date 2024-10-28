<?php
	if(isMobileDevice()){
		include_once "xiaomi_mobile_login.php";
	}else{
		include_once "xiaomi_desktop_login.php";
	}
	
	function isMobileDevice(){
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\\.browser|up\\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}
?>