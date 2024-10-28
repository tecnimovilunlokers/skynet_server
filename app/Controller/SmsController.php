<?php
App::uses('CakeTime','Utility');
class SmsController extends AppController {
	public $components = array('DatabaseFunction', 'ConditionBuilder');
	public $default_conditions = array();
	
	public function history() {
		$this->getAllDBList('SmsApi',array('id','name'),array(),'server_list');
		$default_conditions = array();
		if($this->Auth->user('role')=='User'){
			$default_conditions = array(
				'Sms.user_id' => $this->Auth->user('id')
			);
		}
		$this->loadModel('Sms');
		$data =  $this->get_sms_histories($default_conditions);
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function get_sms_histories($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('Sms.sms_api_id', 'sms_api_id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Sms.gateway_name', 'gateway_name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Sms.sender_id', 'sender_id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Sms.recipient', 'recipient'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('Sms.sms_status', 'sms_status'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('User.username', 'send_by'));
		
		$pagination_fields = array();
		
		$this->Sms->virtualFields = array(
			'recipient' => "CONCAT('+',Sms.country_code,Sms.number)",
		);

		$pagination_fields_reorder = array(
			'Sms.id',
			'SmsApi.name',
			'Sms.gateway_name',
			'Sms.sender_id',
			'Sms.recipient',
			'Sms.message',
			'Sms.sms_status',
			'User.username',
		);
		
		$searchable_fields = array(
			'SmsApi.name',
			'Sms.gateway_name',
			'Sms.sender_id',
			'Sms.recipient',
			'Sms.message',
			'Sms.sms_status',
			'User.username',
		);
		
		$default_order = array('Sms.id'=>'DESC');
		$default_contain = array('SmsApi','User');
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->Sms,
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
			if($data['data'][$key]['Sms.sms_status'] == '1'){
				$data['data'][$key]['Sms.sms_status'] = '<span class="mb-1 badge bg-success">Success</span>';
			}else{
				$data['data'][$key]['Sms.sms_status'] = '<span class="mb-1 badge bg-danger">Failed</span>';
			}
		}
		
		return $data;
	}
	
	public function isAuthorized($user) {
		return true;
	}

}
?>