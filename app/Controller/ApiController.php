<?php
App::uses('CakeTime','Utility');
class ApiController extends AppController {
	public $components = array('DatabaseFunction', 'ConditionBuilder','Auth' => array(
	  'authenticate' => array(
		'Basic'
	  ),
	  'authError' => 'You may not access this area.',
	));
	public $default_conditions = array();
	
	public function send_sms(){
		$this->autoRender = false;
		$this->layout = "ajax";
		if($this->request->is('put') || $this->request->is('post')) {
			$this->loadModel('User');
			$credit_validation = $this->validate_user_credits('sms_credits');
			if($credit_validation['success'] == false){
				echo json_encode($credit_validation);
				exit();
			}
			
			$sms_api_id = $this->request->data['server_id'] ?? 18;
			
			$gateway_id = $this->request->data['gateway_id'];
			$sender_id = $this->request->data['sender_id'];
			$country_code = $this->request->data['country_code'];
			$phone_number =  $this->request->data['phone_number'];
			$recipient = "$country_code$phone_number";
			$msg = $this->request->data['message'];
			
			$this->loadModel('SmsApi');
			$sms_server = $this->SmsApi->find('first',array(
				'contain'=>array('SmsProvider'=>'SmsProviderType'),
				'conditions'=>array(
					'SmsApi.id'=>$sms_api_id,
				),
				'recursive'=>-1
			));
			
			if(count($sms_server) >=1){
				
				$server_id = $sms_server['SmsApi']['id'];
				$server_name = $sms_server['SmsApi']['name'];
				$provider = $sms_server['SmsProvider']['SmsProviderType']['module_name'];
				$server_host = $sms_server['SmsProvider']['url'];
				$username = $sms_server['SmsApi']['username'];
				$password = $sms_server['SmsApi']['password'];
				
				$response = $this->start_send_sms($provider,$server_host,$username,$password,$gateway_id,$sender_id,$recipient,$msg);
				$response = json_decode($response,true);
				$is_success = (int) ($response['success'] ?? false);
				
				if($is_success){
					$user_data = $credit_validation['data'];
					$this->User->save($user_data);
					$response['user_bal'] = $user_data['User']['sms_credits'];
				}
				
				$balance = $response['bal'] ?? 0;
				$this->loadModel('SmsApi');
				$this->SmsApi->updateAll(array('SmsApi.balance'=>$balance),array('SmsApi.id'=>$server_id));
				
				//save logs
				$this->loadModel('Sms');
				$data_to_save['Sms']['gateway_id'] = $gateway_id;
				$data_to_save['Sms']['gateway_name'] = 'API Connection';
				$data_to_save['Sms']['sms_api_id'] = $server_id;
				$data_to_save['Sms']['sender_id'] = $sender_id;
				$data_to_save['Sms']['country_code'] = $country_code;
				$data_to_save['Sms']['number'] = $phone_number;
				$data_to_save['Sms']['message'] = $msg;
				$data_to_save['Sms']['user_id'] = $this->Auth->user('id');
				$data_to_save['Sms']['sms_status'] = $is_success;
				$data_to_save['Sms']['from_api'] = 1;
				$this->Sms->save($data_to_save);

				unset($response['bal']);
				echo json_encode($response);
			}else{
				$response['success'] = false;
				$response['msg'] = 'Selected template or server is currently not available, Please choose different server thank you.';
				echo json_encode($response);
			}
			
		}
	}
	
	public function check_balance($username){
		$this->autoRender = false;
		$this->layout = "ajax";
		$this->loadModel('User');
		$user_data = $this->User->find('first',array(
		    'fields'=>array(
		        'User.link_credits',
		        'User.sms_credits',
		        'User.voice_credits',
		        'User.email_credits',
		    ),
		    'conditions'=>array(
		        'User.username' => $username
		    ),
		    'recursive' =>-1
		));
		
		$user_data  = Set::extract($user_data, 'User');
		echo json_encode($user_data);
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('check_balance');
		$this->layout = 'ajax';
	}
	
	public function isAuthorized($user) {
		return true;
	}

}
?>