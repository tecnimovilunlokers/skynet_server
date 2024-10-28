<?php
App::uses('CakeTime','Utility');
class EmailsController extends AppController {
	public $components = array('DatabaseFunction', 'ConditionBuilder');
	public $default_conditions = array();
	
	public function history() {
		// $this->getAllDBList('SmsApi',array('id','name'),array(),'server_list');
		$default_conditions = array();
		if($this->Auth->user('role')=='User'){
			$default_conditions = array(
				'Email.created_by' => $this->Auth->user('id')
			);
		}
		$this->loadModel('Email');
		$data =  $this->get_email_histories($default_conditions);
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function get_email_histories($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('EmailTemplate.name', 'template'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Email.target_link', 'target_link'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Email.subject', 'subject'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('EmailApi.username', 'from'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Email.mail_to', 'to'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Email.body', 'body'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('Email.email_status', 'email_status'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('AddedBy.username', 'send_by'));
		
		$pagination_fields = array();
		
		$pagination_fields_reorder = array(
			'Email.id',
			'EmailTemplate.name',
			'Email.target_link',
			'Email.subject',
			'EmailApi.username',
			'Email.mail_to',
			'Email.body',
			'Email.email_status',
			'AddedBy.username',
		);
		
		$searchable_fields = array(
			'EmailTemplate.name',
			'Email.target_link',
			'Email.subject',
			'EmailApi.username',
			'Email.mail_to',
			'Email.body',
			'Email.status_desc',
			'AddedBy.username',
		);
		
		$default_order = array('Email.id'=>'DESC');
		$default_contain = array('EmailApi','EmailTemplate','AddedBy');
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->Email,
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
			if($data['data'][$key]['Email.email_status'] == '1'){
				$data['data'][$key]['Email.email_status'] = '<span class="mb-1 badge bg-success">Success</span>';
			}else{
				$data['data'][$key]['Email.email_status'] = '<span class="mb-1 badge bg-danger">Failed</span>';
			}
			
			$data['data'][$key]['Email.body'] = '<div style="max-width: 200px; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">'. trim(strip_tags($value['Email.body'])) .'</div>';
			
		}
		
		return $data;
	}
	
	public function isAuthorized($user) {
		return true;
	}

}
?>