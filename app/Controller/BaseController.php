<?php
App::uses('CakeTime','Utility');
class BaseController extends AppController {
	public $components = array('DatabaseFunction', 'ConditionBuilder');
	public $default_conditions = array();
	
	public function index() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$data =  $this->get_domains(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function delete_domain($id){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('Domain');
		$this->DatabaseFunction->delete_record(
			$this->Domain, 
			$id,
			true,
			'Domain'
		);
	}
	
	public function disable_domain($id){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('Domain');
		$this->DatabaseFunction->disable_record(
			$this->Domain, 
			$id,
			true
		);
	}
	
	public function enable_domain($id){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('Domain');
		$this->DatabaseFunction->enable_record(
			$this->Domain, 
			$id,
			true
		);
	}
	
	public function delete_selected_domain(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('Domain');
		$this->DatabaseFunction->delete_record(
			$this->Domain, 
			$id,
			true,
			'Domain'
		);
	}
	
	public function enable_selected_domain(){
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('Domain');
		$this->DatabaseFunction->enable_record(
			$this->Domain, 
			$id,
			true
		);
	}
	
	public function disable_selected_domain(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('Domain');
		$this->DatabaseFunction->disable_record(
			$this->Domain, 
			$id,
			true
		);
	}
	
	public function edit_domain(){
		$this->autoRender = false;
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Domain'] = $this->request->data['EditDomain'];
			unset($this->request->data['EditDomain']);
			
			$domain = strtolower($this->request->data['Domain']['name']);
			$domain = str_replace('https://','',$domain);
			$domain = str_replace('http://','',$domain);
			$domain = "https://$domain";
			
			if (substr($domain, -1) == '/'){			
				$domain = substr($domain, 0, -1);
			}
			
			$this->request->data['Domain']['name'] = $domain;
			// $this->request->data['Domain']['status'] = 1;
			
			if(!isset($this->request->data['Domain']['is_for_all'])){
			    $this->request->data['Domain']['is_for_all'] = 0;
			}
			
		}
		
		$this->loadModel('Domain');
		$this->DatabaseFunction->edit_record(
			$this->Domain, 
			true,
			'Domain'
		);
	}
	
	public function add_domain(){
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$domain = strtolower($this->request->data['Domain']['name']);
			$domain = str_replace('https://','',$domain);
			$domain = str_replace('http://','',$domain);
			$domain = "https://$domain";
			
			if (substr($domain, -1) == '/'){			
				$domain = substr($domain, 0, -1);
			}
			
			$this->request->data['Domain']['name'] = $domain;
			$this->request->data['Domain']['status'] = 1;
		}
		
		$this->loadModel('Domain');
		$this->DatabaseFunction->add_record(
			$this->Domain, 
			true,
			'Domain',
		);
		
		
	}
	
	
	private function get_domains($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Domain.name', 'name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Domain.is_for_all', 'is_for_all'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Domain.status', 'status'));
		
		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'Domain.id',
			'Domain.name',
			'Domain.is_for_all',
			'Domain.shared',
			'Domain.status',
			'Domain.status_desc',
		);
		
		$searchable_fields = array(
			'Domain.name',
			'Domain.shared',
			'Domain.status_desc',
		);
		
		$default_order = array();
		$default_contain = array();
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$this->loadModel('Domain');
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->Domain,
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
			$update_data = htmlspecialchars(json_encode($value));
			$update_data = "<input class=\"update_data\" type=\"hidden\" value=\"$update_data\"/>";
			
			$data['data'][$key]['Domain.status_desc'] = getHtmlStatusArray($value['Domain.status']);
			$data['data'][$key]['Domain.shared'] = getHtmlBooleanStatusArray($value['Domain.is_for_all']);
			
			$data['data'][$key]['Domain.name'] .= $update_data;
			unset($data['data'][$key]['Domain.status']);
			unset($data['data'][$key]['Domain.is_for_all']);
		}
		
		return $data;

	}
	
	

	
	public function isAuthorized($user) {
		return true;
	}

}
?>