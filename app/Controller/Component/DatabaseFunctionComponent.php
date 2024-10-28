<?php
App::uses('Component', 'Controller');

class DatabaseFunctionComponent extends Component {
	public $controller;
	
	public $components = array('Alert');
	public function initialize(Controller $controller) {
		$this->controller = $controller;
	}
	public function startup(Controller $controller) {
		$this->controller = $controller;
	}
	
	public function get_records($model, $pagination_fields, $pagination_fields_reorder, $report_fields, $report_fields_reorder, $default_contain, $default_conditions, $default_order, $default_recursive, $is_paginated = true, $default_joins = array(),$pagination_limit=0,$default_group=array()) {
		$model->attach_model();
		
		if(isset($this->controller->request['url']['sort']) && $this->controller->request['url']['direction']) {
			$default_order = $this->controller->request['url']['sort'] . ' ' . $this->controller->request['url']['direction'];
		}
		
		if($pagination_limit==0){
			$pagination_limit = Configure::read('PAGE_LIMIT');
		}
		
		if($is_paginated) {
			$this->controller->Paginator->settings = array(
				'fields' => $pagination_fields,
				'contain' => $default_contain,
				'conditions' => $default_conditions,
				'group' => $default_group,
				'order' => $default_order,
				'limit' => $pagination_limit,
				'recursive' => $default_recursive,
				'joins' => $default_joins
			);
			
			try {
				$records = $this->controller->Paginator->paginate($model->name);
				// debug($records);exit();
				$records = reorder(array(
					'fields' => $pagination_fields_reorder,
					'data' => $records
				));
			}
			catch(NotFoundException $e) {
				$link_params = array_merge($this->controller->request->params['pass'], $this->controller->params['named'], array('?' => $this->controller->request['url']));
				unset($link_params['page']);

				return $this->controller->redirect($link_params);
			}
		}
		else {
			$records = $model->find('all', array(
				'fields' => $report_fields,
				'contain' => $default_contain,
				'conditions' => $default_conditions,
				'group' => $default_group,
				'order' => $default_order,
				'recursive' => $default_recursive,
				'joins' => $default_joins
			));
			
			$records = reorder(array(
				'fields' => $report_fields_reorder,
				'data' => $records
			));
		}
		
		return $records;
	}
	
	
	
	public function get_data_table_ajax_records($model,$pagination_fields,$pagination_fields_reorder,$searchable_fields,$report_fields, $report_fields_reorder, $default_contain, $default_conditions, $default_order, $default_recursive, $default_joins = array(),$default_group=array(),$ajax_data = false,$is_paginated=true,$pagination_limit=null) {
		
		$model->attach_model();
		
		if($pagination_limit==null){
			$pagination_limit = Configure::read('PAGE_LIMIT');
		}
		
		$offset = $this->controller->request->query['start'] ?? null;
		$global_search = $this->controller->request->query['search']['value'] ?? null;

		//global search
		if(strlen(trim($global_search))>=1 && count($searchable_fields)>=1){
			$global_search_condition['OR'] = array();
			foreach($searchable_fields as $key=>$value){
				$global_search_condition['OR'] = array_merge($global_search_condition['OR'],array($value .' LIKE '=>'%' . $global_search . '%'));
			}
			$default_conditions = array_merge($default_conditions,$global_search_condition);
		}
		
		//sorting
		if(isset($this->controller->request->query['order'])){
			$default_order_index = $this->controller->request->query['order'][0]['column'];
			$default_order_direction = $this->controller->request->query['order'][0]['dir'];
			
			if(count($pagination_fields_reorder) >=1){
				$default_order = array($pagination_fields_reorder[$default_order_index] => $default_order_direction);
			}else{
				$default_order = array($pagination_fields[$default_order_index] => $default_order_direction);
			}
		}
		
		$total_records = $model->find('count', array(
			'fields' => array($model->primaryKey),
			'contain' => $default_contain,
			'conditions' => $default_conditions,
			'group' => $default_group,
			'order' => $default_order,
			'recursive' => $default_recursive,
			'joins' => $default_joins
		));

		$records = $model->find('all', array(
			'fields' => $pagination_fields,
			'contain' => $default_contain,
			'conditions' => $default_conditions,
			'group' => $default_group,
			'order' => $default_order,
			'limit' => $pagination_limit,
			'offset' => $offset,
			'recursive' => $default_recursive,
			'joins' => $default_joins
		));
		
		//old reorder alternative much lighter loads
		$records = reorder2($records,$pagination_fields_reorder);
		
		$data['recordsTotal'] = $total_records;
		$data['recordsFiltered'] = $total_records;
		$data['data'] = $records;

		return $data;
	}
	
	
	public function delete_record(&$model,$id,$ajax=false,$msg = null,$return_address_on_success=array(), $return_address_on_fail=array(),$default_conditions=array()) {
		$ajax_response = array(
			'success' => false,
			'msg' => '',
			'data' => $id,
		);
		
		if($id) {
			$record = $model->find('count',array(
				'conditions'=>array(
					$model->name.'.id'=>$id,
					$default_conditions
				),
				'recursive'=>-1
			));
			
			if($record >=1) { 
			
				if($msg == null || trim($msg) === ''){
					$msg = $model->name;
				}
			
				$model->attach_model();
				if($model->delete($id)) { 
					$msg = $msg. ' has been successfully deleted.';
					
					if($ajax==true){
						$ajax_response['success'] = true;
						$ajax_response['msg'] = $msg;
						echo json_encode($ajax_response);
					}else{
						$this->controller->Session->setFlash($msg, 'alert.success'); 
						$this->controller->redirect($return_address_on_success);
					}
				}
				else {
					$msg = "Failed to delete ".strtolower($msg).".";
					
					if($ajax==true){
						$ajax_response['success'] = false;
						$ajax_response['msg'] = $msg;
						echo json_encode($ajax_response);
					}else{
						$this->controller->Session->setFlash($msg, 'alert.error'); 
						$this->controller->redirect($return_address_on_fail);
					}
					
				}
			}
			else {
				$msg = "Failed to delete data, No records found.";
				if($ajax==true){
					$ajax_response['success'] = false;
					$ajax_response['msg'] = $msg;
					echo json_encode($ajax_response);
				}else{
					$this->controller->Session->setFlash($msg, 'alert.error'); 
					$this->controller->redirect($return_address_on_fail);
				}
			}
		}
		else {
				$msg = "Failed to delete data, No records found.";
				if($ajax==true){
					$ajax_response['success'] = false;
					$ajax_response['msg'] = $msg;
					echo json_encode($ajax_response);
				}else{
					$this->controller->Session->setFlash($msg, 'alert.error'); 
					$this->controller->redirect($return_address_on_fail);
				}
		}
	}
	
	public function add_record(&$model,$ajax=false,$msg = null,$return_address_on_success=array(), $return_address_on_fail=array()) {
		$ajax_response = array(
			'success' => false,
			'msg' => '',
		);
	
		if($msg == null || trim($msg) === ''){
			$msg = $model->name;
		}
		
		if($this->controller->request->is('put') || $this->controller->request->is('post')) {
			if($model->save($this->controller->request->data)) { 
				$msg = $msg. ' has been successfully saved.';
				
				if($ajax==true){
					$ajax_response['success'] = true;
					$ajax_response['msg'] = $msg;
					echo json_encode($ajax_response);
				}else{
					$this->controller->Session->setFlash($msg, 'alert.success'); 
					$this->controller->redirect($return_address_on_success);
				}
			}else{
				$msg = "Failed to save ".strtolower($msg).".";
				
				if($ajax==true){
					$ajax_response['success'] = false;
					
					$validation_msg = '';
					foreach($model->validationErrors as $key_err=>$error){
						$validation_msg .= '<p class="text-danger mb-1">* '. $error[0].'</span>';
					}
					$ajax_response['msg'] = $validation_msg;
					echo json_encode($ajax_response);
				}else{
					foreach($model->validationErrors as $key_err=>$error){
						$this->controller->Session->setFlash($error[0], 'alert.error'); 
					}
					$this->controller->redirect($return_address_on_fail);
				}
				
			}
		}
	}
	
	
	public function edit_record(&$model,$ajax=false,$msg = null,$return_address_on_success=array(), $return_address_on_fail=array()) {
		$ajax_response = array(
			'success' => false,
			'msg' => '',
		);
	
		if($msg == null || trim($msg) === ''){
			$msg = $model->name;
		}
		
		if($this->controller->request->is('put') || $this->controller->request->is('post')) {
			if($model->save($this->controller->request->data)) { 
				$msg = $msg. ' has been successfully updated.';
				
				if($ajax==true){
					$ajax_response['success'] = true;
					$ajax_response['msg'] = $msg;
					echo json_encode($ajax_response);
				}else{
					$this->controller->Session->setFlash($msg, 'alert.success'); 
					$this->controller->redirect($return_address_on_success);
				}
			}else{
				$msg = "Failed to update ".strtolower($msg).".";
				
				if($ajax==true){
					$ajax_response['success'] = false;
					$validation_msg = '';
					foreach($model->validationErrors as $key_err=>$error){
						$validation_msg .= '<p class="text-danger mb-1">* '. $error[0].'</span>';
					}
					$ajax_response['msg'] = $validation_msg;
					echo json_encode($ajax_response);
				}else{
					foreach($model->validationErrors as $key_err=>$error){
						$this->controller->Session->setFlash($error[0], 'alert.error'); 
					}
					$this->controller->redirect($return_address_on_fail);
				}
				
			}
		}
	}
	
	
	public function enable_record(&$model,$id,$ajax=false,$msg = null,$return_address_on_success=array(), $return_address_on_fail=array(),$default_conditions=array()) {
		$ajax_response = array(
			'success' => false,
			'msg' => '',
			'data' => $id,
		);

		if($id) {
			$record = $model->find('list',array(
				'fields'=>array(
					$model->name.'.id',
				),
				'conditions'=>array(
					$model->name.'.id'=>$id,
					$default_conditions
				),
				'recursive'=>-1
			));
			
			if(count($record) >=1) { 
			
				if($msg == null || trim($msg) === ''){
					$msg = $model->name;
				}
				
				$id  = array_keys($record);
				if($model->updateAll(array('status'=>1),array($model->name.'.id'=>$id))) { 
					$msg = $msg. ' has been successfully enabled.';
					
					if($ajax==true){
						$ajax_response['success'] = true;
						$ajax_response['msg'] = $msg;
						echo json_encode($ajax_response);
					}else{
						$this->controller->Session->setFlash($msg, 'alert.success'); 
						$this->controller->redirect($return_address_on_success);
					}
				}
				else {
					$msg = "Failed to enable ".strtolower($msg).".";
					
					if($ajax==true){
						$ajax_response['success'] = false;
						$ajax_response['msg'] = $msg;
						echo json_encode($ajax_response);
					}else{
						$this->controller->Session->setFlash($msg, 'alert.error'); 
						$this->controller->redirect($return_address_on_fail);
					}
					
				}
			}
			else {
				$msg = "Failed to enable data, No records found.";
				if($ajax==true){
					$ajax_response['success'] = false;
					$ajax_response['msg'] = $msg;
					echo json_encode($ajax_response);
				}else{
					$this->controller->Session->setFlash($msg, 'alert.error'); 
					$this->controller->redirect($return_address_on_fail);
				}
			}
		}
		else {
				$msg = "Failed to enable data, No records found.";
				if($ajax==true){
					$ajax_response['success'] = false;
					$ajax_response['msg'] = $msg;
					echo json_encode($ajax_response);
				}else{
					$this->controller->Session->setFlash($msg, 'alert.error'); 
					$this->controller->redirect($return_address_on_fail);
				}
		}
	}
	
	public function disable_record(&$model,$id,$ajax=false,$msg = null,$return_address_on_success=array(), $return_address_on_fail=array(),$default_conditions=array()) {
		$ajax_response = array(
			'success' => false,
			'msg' => '',
			'data' => $id,
		);

		if($id) {
			$record = $model->find('list',array(
				'fields'=>array(
					$model->name.'.id',
				),
				'conditions'=>array(
					$model->name.'.id'=>$id,
					$default_conditions
				),
				'recursive'=>-1
			));
			
			if(count($record) >=1) { 
			
				if($msg == null || trim($msg) === ''){
					$msg = $model->name;
				}
			
				$id  = array_keys($record);
				if($model->updateAll(array('status'=>0),array($model->name.'.id'=>$id))) { 
					$msg = $msg. ' has been successfully disabled.';
					
					if($ajax==true){
						$ajax_response['success'] = true;
						$ajax_response['msg'] = $msg;
						echo json_encode($ajax_response);
					}else{
						$this->controller->Session->setFlash($msg, 'alert.success'); 
						$this->controller->redirect($return_address_on_success);
					}
				}else{
					
					$msg = "Failed to disable ".strtolower($msg).".";
					if($ajax==true){
						$ajax_response['success'] = false;
						$ajax_response['msg'] = $msg;
						echo json_encode($ajax_response);
					}else{
						$this->controller->Session->setFlash($msg, 'alert.error'); 
						$this->controller->redirect($return_address_on_fail);
					}
					
				}
			}else{
				$msg = "Failed to disable data, No records found.";
				if($ajax==true){
					$ajax_response['success'] = false;
					$ajax_response['msg'] = $msg;
					echo json_encode($ajax_response);
				}else{
					$this->controller->Session->setFlash($msg, 'alert.error'); 
					$this->controller->redirect($return_address_on_fail);
				}
			}
		}
		else {
				$msg = "Failed to disable data, No records found.";
				if($ajax==true){
					$ajax_response['success'] = false;
					$ajax_response['msg'] = $msg;
					echo json_encode($ajax_response);
				}else{
					$this->controller->Session->setFlash($msg, 'alert.error'); 
					$this->controller->redirect($return_address_on_fail);
				}
		}
	}
	
	
	
	
}
?>