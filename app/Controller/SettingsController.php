<?php
class SettingsController extends AppController {
	public $components = array('DatabaseFunction');
	public $default_conditions = array();
	
	public function index() {
		
	}
	
	public function get_language_voices($language_code){
		$this->autoRender = false;
		$this->loadModel('LanguageVoice');
		$this->LanguageVoice->virtualFields = array(
			'name' => "concat(LanguageVoice.voice_gender,' - ',LanguageVoice.voice_name)",
			'value' => "LanguageVoice.voice_name",
		);
		$data = $this->LanguageVoice->find('all',array(
			'fields'=>array(
				'LanguageVoice.name',
				'LanguageVoice.value'
			),
			'conditions'=>array(
				'LanguageVoice.language_code' => $language_code
			),
			'order'=>'LanguageVoice.voice_name ASC',
			'recursive'=>-1
		));
		$data = Set::extract($data, '{n}.LanguageVoice');
		echo json_encode($data);
	}
	
	public function sms_providers() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$this->getAllDBList('SmsProviderType',array('id','name'),array(),'provider_types');
		
		$data =  $this->get_sms_provider(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function add_sms_provider(){
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$domain = strtolower($this->request->data['SmsProvider']['url']);
			$domain = str_replace('https://','',$domain);
			$domain = str_replace('http://','',$domain);
			$domain = "https://$domain";
			
			if (substr($domain, -1) == '/'){			
				$domain = substr($domain, 0, -1);
			}
			$this->request->data['SmsProvider']['url'] = $domain;
		}
		
		$this->loadModel('SmsProvider');
		$this->DatabaseFunction->add_record(
			$this->SmsProvider, 
			true,
			'Sms Provider',
		);
	}
	
	public function edit_sms_provider(){
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['SmsProvider'] = $this->request->data['EditSmsProvider'];
			$domain = strtolower($this->request->data['SmsProvider']['url']);
			$domain = str_replace('https://','',$domain);
			$domain = str_replace('http://','',$domain);
			$domain = "https://$domain";
			
			if (substr($domain, -1) == '/'){			
				$domain = substr($domain, 0, -1);
			}
			$this->request->data['SmsProvider']['url'] = $domain;
		}
		
		$this->loadModel('SmsProvider');
		$this->DatabaseFunction->edit_record(
			$this->SmsProvider, 
			true,
			'Sms Provider',
		);
	}
	
	public function delete_sms_provider($id){

		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsProvider');
		$this->DatabaseFunction->delete_record(
			$this->SmsProvider, 
			$id,
			true
		);
	}

	public function disable_sms_provider($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsProvider');
		$this->DatabaseFunction->disable_record(
			$this->SmsProvider, 
			$id,
			true,
			'SMS Server'
		);
	}

	public function enable_sms_provider($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsProvider');
		$this->DatabaseFunction->enable_record(
			$this->SmsProvider, 
			$id,
			true,
			'SMS Server'
		);
	}

	public function delete_selected_sms_provider(){
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsProvider');
		$this->DatabaseFunction->delete_record(
			$this->SmsProvider, 
			$id,
			true,
			'SmsProvider'
		);
	}

	public function enable_selected_sms_provider(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsProvider');
		$this->DatabaseFunction->enable_record(
			$this->SmsProvider, 
			$id,
			true
		);
	}

	public function disable_selected_sms_provider(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsProvider');
		$this->DatabaseFunction->disable_record(
			$this->SmsProvider, 
			$id,
			true
		);
	}
	
	public function get_sms_provider($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('SmsProvider.name', 'name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('SmsProviderType.id', 'type'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('SmsProvider.url', 'url'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('SmsProvider.status', 'status'));
		

		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'SmsProvider.id',
			'SmsProvider.name',
			'SmsProviderType.id',
			'SmsProviderType.name',
			'SmsProvider.url',
			'SmsProvider.status',
		);
		
		$searchable_fields = array(
			'SmsProvider.name',
			'SmsProviderType.name',
			'SmsProvider.url',
			'SmsProvider.status_desc',
		);
		
		$default_order = array('SmsProvider.id'=>'DESC');
		$default_contain = array('SmsProviderType');
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$this->loadModel('SmsProvider');
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->SmsProvider,
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
			$data['data'][$key]['SmsProvider.status'] = getHtmlStatusArray($value['SmsProvider.status']);
			$data['data'][$key]['SmsProvider.name'] .= $update_data;
			unset($data['data'][$key]['SmsProviderType.id']);
		}
		
		return $data;
	}
	
	public function manage_voice_api() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$this->loadModel('VoiceApi');
		$data =  $this->get_voice_api(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function delete_selected_voice_api(){
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('VoiceApi');
		$this->DatabaseFunction->delete_record(
			$this->VoiceApi, 
			$id,
			true,
			'VoiceApi'
		);
	}

	public function enable_selected_voice_api(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('VoiceApi');
		$this->DatabaseFunction->enable_record(
			$this->VoiceApi, 
			$id,
			true
		);
	}

	public function disable_selected_voice_api(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('VoiceApi');
		$this->DatabaseFunction->disable_record(
			$this->VoiceApi, 
			$id,
			true
		);
	}
	
	public function manage_sms_api() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		

		$this->getAllDBList('SmsProvider',array('id','name'),array(),'sms_provider');
		
		$this->loadModel('SmsProvider');
		$sms_provider = $this->SmsProvider->find('all',array(
			'fields'=>array(
				'SmsProvider.id as value',
				'SmsProvider.name as name',
				'SmsProvider.url as host'
			),
			'conditions'=>array(
				'SmsProvider.status'=> 1,
			)
		));
		$sms_provider = Set::extract($sms_provider, '{n}.SmsProvider');
		$this->set('sms_provider',$sms_provider);
		
		$this->loadModel('SmsApi');
		$data =  $this->get_sms_api(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function sms_template() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$this->getAllDBList('SmsProvider',array('id','name'),array(),'sms_provider_list');
		$this->getAllDBList('SmsCountry',array('code','fullname'),array(),'country_list');
		
		$this->loadModel('SmsTemplate');
		$data =  $this->get_sms_template(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function sms_gateway() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$this->getAllDBList('SmsProvider',array('id','name'),array(),'sms_provider_list');
		$data =  $this->get_sms_gateway(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function email_api() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$data =  $this->get_email_api(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function add_email_api(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('EmailApi');
		$this->DatabaseFunction->add_record(
			$this->EmailApi, 
			true,
			'Email Server'
		);
	}

	public function edit_email_api(){
		$this->autoRender = false;
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['EmailApi'] = $this->request->data['EditEmailApi'];
			unset($this->request->data['EditEmailApi']);
		}
		
		$this->loadModel('EmailApi');
		$this->DatabaseFunction->edit_record(
			$this->EmailApi, 
			true,
			'Email Server'
		);
	}

	public function delete_email_api($id){

		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('EmailApi');
		$this->DatabaseFunction->delete_record(
			$this->EmailApi, 
			$id,
			true
		);
	}

	public function disable_email_api($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('EmailApi');
		$this->DatabaseFunction->disable_record(
			$this->EmailApi, 
			$id,
			true,
			'SMS Server'
		);
	}

	public function enable_email_api($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('EmailApi');
		$this->DatabaseFunction->enable_record(
			$this->EmailApi, 
			$id,
			true,
			'SMS Server'
		);
	}

	public function delete_selected_email_api(){
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('EmailApi');
		$this->DatabaseFunction->delete_record(
			$this->EmailApi, 
			$id,
			true,
			'EmailApi'
		);
	}

	public function enable_selected_email_api(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('EmailApi');
		$this->DatabaseFunction->enable_record(
			$this->EmailApi, 
			$id,
			true
		);
	}

	public function disable_selected_email_api(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('EmailApi');
		$this->DatabaseFunction->disable_record(
			$this->EmailApi, 
			$id,
			true
		);
	}
	
	public function delete_sms_api($id){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsApi');
		$this->DatabaseFunction->delete_record(
			$this->SmsApi, 
			$id,
			true
		);
	}
	
	public function disable_sms_api($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsApi');
		$this->DatabaseFunction->disable_record(
			$this->SmsApi, 
			$id,
			true,
			'SMS Server'
		);
	}
	
	public function disable_voice_api($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('VoiceApi');
		$this->DatabaseFunction->disable_record(
			$this->VoiceApi, 
			$id,
			true,
			'Voice Api'
		);
	}
	
	public function enable_voice_api($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('VoiceApi');
		$this->DatabaseFunction->enable_record(
			$this->VoiceApi, 
			$id,
			true,
			'Voice Api'
		);
	}
	
	public function enable_sms_api($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsApi');
		$this->DatabaseFunction->enable_record(
			$this->SmsApi, 
			$id,
			true,
			'SMS Server'
		);
	}
	
	public function delete_selected_sms_api(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsApi');
		$this->DatabaseFunction->delete_record(
			$this->SmsApi, 
			$id,
			true,
			'SmsApi'
		);
	}
	
	public function enable_selected_sms_api(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsApi');
		$this->DatabaseFunction->enable_record(
			$this->SmsApi, 
			$id,
			true
		);
	}
	
	public function disable_selected_sms_api(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsApi');
		$this->DatabaseFunction->disable_record(
			$this->SmsApi, 
			$id,
			true
		);
	}
	
	public function delete_sms_template($id){

		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsTemplate');
		$this->DatabaseFunction->delete_record(
			$this->SmsTemplate, 
			$id,
			true
		);
	}
	
	public function disable_sms_template($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsTemplate');
		$this->DatabaseFunction->disable_record(
			$this->SmsTemplate, 
			$id,
			true,
			'SMS Server'
		);
	}
	
	public function enable_sms_template($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsTemplate');
		$this->DatabaseFunction->enable_record(
			$this->SmsTemplate, 
			$id,
			true,
			'SMS Server'
		);
	}
	
	public function delete_selected_sms_template(){
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsTemplate');
		$this->DatabaseFunction->delete_record(
			$this->SmsTemplate, 
			$id,
			true,
			'SmsTemplate'
		);
	}
	
	public function enable_selected_sms_template(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsTemplate');
		$this->DatabaseFunction->enable_record(
			$this->SmsTemplate, 
			$id,
			true
		);
	}
	
	public function disable_selected_sms_template(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsTemplate');
		$this->DatabaseFunction->disable_record(
			$this->SmsTemplate, 
			$id,
			true
		);
	}
	
	public function delete_sms_gateway($id){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsGateway');
		$this->DatabaseFunction->delete_record(
			$this->SmsGateway, 
			$id,
			true
		);
	}
	
	public function disable_sms_gateway($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsGateway');
		$this->DatabaseFunction->disable_record(
			$this->SmsGateway, 
			$id,
			true,
			'SMS Gateway'
		);
	}
	
	public function enable_sms_gateway($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsGateway');
		$this->DatabaseFunction->enable_record(
			$this->SmsGateway, 
			$id,
			true,
			'SMS Gateway'
		);
	}
	
	public function delete_selected_sms_gateway(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsGateway');
		$this->DatabaseFunction->delete_record(
			$this->SmsGateway, 
			$id,
			true,
			'SmsGateway'
		);
	}
	
	public function enable_selected_sms_gateway(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsGateway');
		$this->DatabaseFunction->enable_record(
			$this->SmsGateway, 
			$id,
			true
		);
	}
	
	public function disable_selected_sms_gateway(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('SmsGateway');
		$this->DatabaseFunction->disable_record(
			$this->SmsGateway, 
			$id,
			true
		);
	}
	
	public function delete_voice_api($id){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('VoiceApi');
		$this->DatabaseFunction->delete_record(
			$this->VoiceApi, 
			$id,
			true
		);
	}
	
	public function enable_api($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('VoiceApi');
		$this->DatabaseFunction->enable_record(
			$this->VoiceApi, 
			$id,
			true
		);
	}
	
	public function disable_api($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('VoiceApi');
		$this->DatabaseFunction->disable_record(
			$this->VoiceApi, 
			$id,
			true
		);
	}
	
	public function delete_voice_template($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('VoiceTemplate');
		$this->DatabaseFunction->delete_record(
			$this->VoiceTemplate, 
			$id,
			true
		);
	}
	
	public function disable_voice_template($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('VoiceTemplate');
		$this->DatabaseFunction->disable_record(
			$this->VoiceTemplate, 
			$id,
			true
		);
	}
	
	public function enable_voice_template($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('VoiceTemplate');
		$this->DatabaseFunction->enable_record(
			$this->VoiceTemplate, 
			$id,
			true
		);
	}
	
	
	public function delete_selected_voice_template(){
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('VoiceTemplate');
		$this->DatabaseFunction->delete_record(
			$this->VoiceTemplate, 
			$id,
			true,
			'VoiceTemplate'
		);
	}

	public function enable_selected_voice_template(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('VoiceTemplate');
		$this->DatabaseFunction->enable_record(
			$this->VoiceTemplate, 
			$id,
			true
		);
	}

	public function disable_selected_voice_template(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('VoiceTemplate');
		$this->DatabaseFunction->disable_record(
			$this->VoiceTemplate, 
			$id,
			true
		);
	}
	
	public function add_voice_api() {
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->loadModel('VoiceApi');
		$this->DatabaseFunction->add_record(
			$this->VoiceApi, 
			true,
			'Voice Api',
		);
	}
	
	public function add_sms_gateway(){
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->loadModel('SmsGateway');
		$this->DatabaseFunction->add_record(
			$this->SmsGateway, 
			true,
			'SMS Gateway',
		);
	}
	
	public function edit_sms_gateway(){
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['SmsGateway'] = $this->request->data['EditSmsGateway'];
			unset($this->request->data['EditSmsGateway']);
		}
		
		$this->loadModel('SmsGateway');
		$this->DatabaseFunction->edit_record(
			$this->SmsGateway, 
			true,
			'SMS Gateway',
		);
	}
	
	public function edit_sms_template(){
		$this->autoRender = false;
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['SmsTemplate'] = $this->request->data['UpdateSmsTemplate'];
			unset($this->request->data['UpdateSmsTemplate']);
		}
		
		$this->loadModel('SmsTemplate');
		$this->DatabaseFunction->edit_record(
			$this->SmsTemplate, 
			true,
			'Template'
		);
	}
	
	public function add_sms_template(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('SmsTemplate');
		$this->DatabaseFunction->add_record(
			$this->SmsTemplate, 
			true,
			'Template'
		);
	}
	
	public function add_sms_api() {
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$provider = $this->request->data['SmsApi']['sms_provider_id'];
			
			$this->loadModel('SmsProvider');
			$sms_provider = $this->SmsProvider->findById($provider);
			$provider = $sms_provider['SmsProviderType']['module_name'];
			$server_host = $sms_provider['SmsProvider']['url'];
			
			$username = $this->request->data['SmsApi']['username'];
			$password = $this->request->data['SmsApi']['password'];
			
			$api_response = $this->check_sms_api_balance($provider,$server_host,$username,$password);
			$api_response = json_decode($api_response,true);
			
			if($api_response['success'] == true){
				$this->request->data['SmsApi']['balance'] = $api_response['bal'];
			}else{
				$response['success'] = false;
				$response['msg'] = $api_response['msg'];
				echo json_encode($response);
				exit();
			}
			
		}
		
		$this->loadModel('SmsApi');
		$this->DatabaseFunction->add_record(
			$this->SmsApi, 
			true,
			'SMS Server',
		);
	}
	
	public function edit_sms_api() {
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['SmsApi'] = $this->request->data['EditSmsApi'];
			unset($this->request->data['EditSmsApi']);
			
			$provider = $this->request->data['SmsApi']['sms_provider_id'];
			
			$this->loadModel('SmsProvider');
			$sms_provider = $this->SmsProvider->findById($provider);
			
			$server_host = $sms_provider['SmsProvider']['url'];
			$provider = $sms_provider['SmsProviderType']['module_name'];
			
			$username = $this->request->data['SmsApi']['username'];
			$password = $this->request->data['SmsApi']['password'];

			$api_response = $this->check_sms_api_balance($provider,$server_host,$username,$password);
			$api_response = json_decode($api_response,true);
			
			if($api_response['success'] == true){
				$this->request->data['SmsApi']['balance'] = $api_response['bal'];
			}else{
				$response['success'] = false;
				$response['msg'] = $api_response['msg'];
				echo json_encode($response);
				exit();
			}
			
		}
		
		$this->loadModel('SmsApi');
		$this->DatabaseFunction->edit_record(
			$this->SmsApi, 
			true,
			'SMS Server',
		);
	}
	
	
	public function edit_voice_api() {
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['VoiceApi'] = $this->request->data['EditVoiceApi'];
			unset($this->request->data['EditVoiceApi']);
		}

		$this->loadModel('VoiceApi');
		$this->DatabaseFunction->edit_record(
			$this->VoiceApi, 
			true,
			'Voice Api',
		);
	}
	
	
	public function voice_templates() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$this->loadModel('LanguageList');
		$languages = $this->LanguageList->find('list',array(
			'fields' => array(
				'LanguageList.language_code',
				'LanguageList.language',
			),
			'conditions'=>array(
				'LanguageList.status' => 1
			),
			'order'=> 'LanguageList.language ASC'
		));
		$this->set('languages',$languages);

		$this->loadModel('VoiceTemplate');
		$data =  $this->get_voice_template(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function add_voice_template(){
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			
		
			$file_name = $this->request->data['VoiceTemplate']['file_path']['name'];
			$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
			$origin_path = $this->request->data['VoiceTemplate']['file_path']['tmp_name'];
			$allowed_ext = array("wav", "mp3");
			
			$new_file_name = md5($this->Auth->user('id').'-'.time()).".$file_ext";
			$output_path = "files/voice/$new_file_name";
				
			if (!empty($file_name)){
				if(in_array($file_ext, $allowed_ext)){
					if(move_uploaded_file($origin_path, $output_path)){
						$this->request->data['VoiceTemplate']['path'] = $output_path;
					}else{
						$this->Session->setFlash("An error occured while uploading file. Please try again.", 'alert.error');
						return $this->redirect(array('controller' => 'settings', 'action' => 'voice_templates'));
					}
				}else{
					$this->Session->setFlash("Failed to upload file. Please upload a valid audio file.", 'alert.error');
					return $this->redirect(array('controller' => 'settings', 'action' => 'voice_templates'));
				}
			}else{
				$this->Session->setFlash("An error occured while uploading file. Please try again.", 'alert.error');
				return $this->redirect(array('controller' => 'settings', 'action' => 'voice_templates'));
			}
			
			
			
		}
		
		$redirect_url_success = array('controller' => 'settings', 'action' => 'voice_templates');
		$this->loadModel('VoiceTemplate');
		$this->DatabaseFunction->add_record(
			$this->VoiceTemplate, 
			false,
			'Voice Template',
			$redirect_url_success,
			$redirect_url_success
		);
		
	}
	
	public function edit_voice_template(){
		$this->autoRender = false;
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['VoiceTemplate'] = $this->request->data['EditVoiceTemplate'];
			unset($this->request->data['EditVoiceTemplate']);
		
			$file_name = $this->request->data['VoiceTemplate']['file_path']['name'];
			$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
			$origin_path = $this->request->data['VoiceTemplate']['file_path']['tmp_name'];
			$allowed_ext = array("wav", "mp3");
			
			$new_file_name = md5($this->Auth->user('id').'-'.time()).".$file_ext";
			$output_path = "files/voice/$new_file_name";
				
			if (!empty($file_name)){
				if(in_array($file_ext, $allowed_ext)){
					if(move_uploaded_file($origin_path, $output_path)){
						$this->request->data['VoiceTemplate']['path'] = $output_path;
					}else{
						$this->Session->setFlash("An error occured while uploading file. Please try again.", 'alert.error');
						return $this->redirect(array('controller' => 'settings', 'action' => 'voice_templates'));
					}
				}else{
					$this->Session->setFlash("Failed to upload file. Please upload a valid audio file.", 'alert.error');
					return $this->redirect(array('controller' => 'settings', 'action' => 'voice_templates'));
				}
			}else{
				unset($this->request->data['VoiceTemplate']['path']);
			}
	
		}
		
		$redirect_url_success = array('controller' => 'settings', 'action' => 'voice_templates');
		$this->loadModel('VoiceTemplate');
		$this->DatabaseFunction->edit_record(
			$this->VoiceTemplate, 
			false,
			'Voice Template',
			$redirect_url_success,
			$redirect_url_success
		);
		
	}
	
	public function get_voice_template($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('VoiceTemplate.name', 'name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('VoiceTemplate.type', 'type'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('VoiceTemplate.passcode_length', 'passcode_length'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('VoiceTemplate.status', 'status'));
		
		$pagination_fields = array();
		
		$base_folder = basename(Configure::read('BASE_URL'));
		$this->VoiceTemplate->virtualFields = array(
			'audio' => 'CONCAT(\'<audio src="\',\'/'.$base_folder.'/\',VoiceTemplate.path,\'" preload="none"></audio><button class="btn btn-primary rounded-circle btn-sm btn-play-voice"><i class="fa-solid fa-play"></i></button>\')',
			'status_desc' => "CASE VoiceTemplate.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
		);
		
		$pagination_fields_reorder = array(
			'VoiceTemplate.id',
			'VoiceTemplate.audio',
			'VoiceTemplate.name',
			'VoiceTemplate.type',
			'VoiceTemplate.passcode_length',
			'VoiceTemplate.language',
			'VoiceTemplate.voice_name',
			'VoiceTemplate.msg_before_input',
			'VoiceTemplate.msg_after_input',
			'VoiceTemplate.msg_no_input',
			'VoiceTemplate.msg_before_end',
			'VoiceTemplate.status',
		);
		
		$searchable_fields = array(
			'VoiceTemplate.name',
			'VoiceTemplate.type',
			'VoiceTemplate.passcode_length',
			'VoiceTemplate.status_desc',
		);
		
		$default_order = array();
		$default_contain = array('AddedBy');
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->VoiceTemplate,
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
			$data['data'][$key]['VoiceTemplate.status'] = getHtmlStatusArray($value['VoiceTemplate.status']);
		}
		
		return $data;
	}
	
	public function get_sms_api($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('SmsApi.id', 'id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('SmsProvider.id', 'provider'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('SmsApi.name', 'name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('SmsProvider.url', 'url'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('SmsApi.username', 'username'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('SmsApi.password', 'password'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('SmsApi.status', 'status'));
		
		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'SmsApi.id',
			'SmsApi.name',
			'SmsProvider.id',
			'SmsProvider.name',
			'SmsApi.balance',
			'SmsProvider.url',
			'SmsApi.username',
			'SmsApi.password',
			'SmsApi.status_desc',
			'SmsApi.status',
		);
		
		$searchable_fields = array(
			'SmsApi.name',
			'SmsProvider.name',
			'SmsApi.balance',
			'SmsProvider.url',
			'SmsApi.username',
			'SmsApi.password',
			'SmsApi.status_desc',
		);
		
		$default_order = array('SmsApi.name'=>'ASC');
		$default_contain = array('AddedBy','SmsProvider');
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->SmsApi,
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
			
			$data['data'][$key]['SmsApi.name'] .= $update_data;
			$data['data'][$key]['SmsApi.status_desc'] = getHtmlStatusArray($value['SmsApi.status']);
			unset($data['data'][$key]['SmsApi.status']);
			unset($data['data'][$key]['SmsProvider.id']);
		}
		return $data;
	}
	
	public function get_sms_template($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('SmsTemplate.sms_api_id', 'server_id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('SmsTemplate.country_code', 'country_code'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('SmsTemplate.sms_gateway_id', 'gateway_id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('SmsTemplate.sender_id', 'sender_id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('SmsTemplate.carrier_name', 'carrier_name'));

		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'SmsTemplate.id',
			'SmsCountry.code',
			'SmsCountry.fullname',
			'SmsProvider.id',
			'SmsProvider.name',
			'SmsGateway.id',
			'SmsGateway.name',
			'SmsTemplate.sender_id',
			'SmsTemplate.carrier_name',
			'SmsTemplate.template',
			'SmsTemplate.status',
		);
		
		$searchable_fields = array(
			'SmsCountry.name',
			'SmsCountry.code',
			'SmsProvider.name',
			'SmsGateway.name',
			'SmsTemplate.sender_id',
			'SmsTemplate.carrier_name',
			'SmsTemplate.template',
			'SmsTemplate.status',
		);
		
		$default_order = array('SmsCountry.name'=>'ASC');
		$default_contain = array('SmsProvider','SmsGateway','SmsCountry');
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$this->loadModel('SmsTemplate');
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->SmsTemplate,
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
			
			$data['data'][$key]['SmsTemplate.status'] = getHtmlStatusArray($value['SmsTemplate.status']);
			$data['data'][$key]['SmsTemplate.carrier_name'] .= $update_data;
			
			unset($data['data'][$key]['SmsCountry.code']);
			unset($data['data'][$key]['SmsProvider.id']);
			unset($data['data'][$key]['SmsGateway.id']);
		}
		
		return $data;
	}
	
	public function get_sms_gateway($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('SmsProvider.id', 'sms_provider_id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('SmsGateway.gateway_id', 'gateway_id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('SmsGateway.name', 'gateway_name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('SmsGateway.status', 'status'));

		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'SmsGateway.id',
			'SmsProvider.id',
			'SmsProvider.name',
			'SmsGateway.gateway_id',
			'SmsGateway.name',
			'SmsGateway.status',
		);
		
		$searchable_fields = array(
			'SmsProvider.name',
			'SmsGateway.gateway_id',
			'SmsGateway.name',
			'SmsGateway.status_desc',
		);
		
		$default_order = array(
		    'SmsProvider.name'=>'ASC',
		    'SmsGateway.gateway_id'=>'ASC',
		);
		
		$default_contain = array('SmsProvider');
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$this->loadModel('SmsGateway');
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->SmsGateway,
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
			
			$data['data'][$key]['SmsGateway.status'] = getHtmlStatusArray($value['SmsGateway.status']);
			
			$data['data'][$key]['SmsGateway.name'] .= $update_data;
			unset($data['data'][$key]['SmsProvider.id']);
		}
		
		// debug($data);
		// exit();
		
		return $data;
	}
	
	public function get_voice_api($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('VoiceApi.name', 'name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('VoiceApi.sid', 'sid'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('VoiceApi.token', 'token'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('VoiceApi.phone_number', 'phone_number'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('VoiceApi.status', 'status'));
		
		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'VoiceApi.id',
			'VoiceApi.name',
			'VoiceApi.sid',
			'VoiceApi.token',
			'VoiceApi.phone_number',
			'VoiceApi.status',
		);
		
		$searchable_fields = array(
			'VoiceApi.name',
			'VoiceApi.sid',
			'VoiceApi.token',
			'VoiceApi.phone_number',
			'VoiceApi.status_desc',
		);
		
		$default_order = array();
		$default_contain = array('AddedBy');
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->VoiceApi,
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
			$data['data'][$key]['VoiceApi.status'] = getHtmlStatusArray($value['VoiceApi.status']);
		}
		
		return $data;
	}
	
	
	
	public function get_email_api($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('EmailApi.host', 'host'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('EmailApi.port', 'port'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('EmailApi.username', 'username'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('EmailApi.password', 'password'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('EmailApi.status', 'status'));

		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'EmailApi.id',
			'EmailApi.host',
			'EmailApi.port',
			'EmailApi.username',
			'EmailApi.password',
			'EmailApi.status',
		);
		
		$searchable_fields = array(
			'EmailApi.host',
			'EmailApi.port',
			'EmailApi.username',
			'EmailApi.password',
			'EmailApi.status_desc',
		);
		
		$default_order = array();
		$default_contain = array();
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$this->loadModel('EmailApi');
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->EmailApi,
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
			$data['data'][$key]['EmailApi.status'] = getHtmlStatusArray($value['EmailApi.status']);
		}
		
		return $data;
	}
	
	
	public function get_email_template($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('EmailTemplate.name', 'name'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('EmailTemplate.status', 'status'));

		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'EmailTemplate.id',
			'EmailTemplate.name',
			'EmailTemplate.status',
		);
		
		$searchable_fields = array(
			'EmailTemplate.name',
			'EmailTemplate.status_desc',
		);
		
		$default_order = array();
		$default_contain = array();
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$this->loadModel('EmailTemplate');
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->EmailTemplate,
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
			$data['data'][$key]['EmailTemplate.status'] = getHtmlStatusArray($value['EmailTemplate.status']);
		}
		
		return $data;
	}
	
	public function email_templates() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$data =  $this->get_email_template(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function add_email_template(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$redirect_url_success = array('controller'=>'settings','action'=>'email_templates');
		
		$this->loadModel('EmailTemplate');
		$this->DatabaseFunction->add_record(
			$this->EmailTemplate, 
			false,
			'Email Template',
			$redirect_url_success,
		);
	}

	public function edit_email_template($id){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->loadModel('EmailTemplate');
		
		$email_template = $this->EmailTemplate->findById($id);
		
		
		if ($this->request->is('post') || $this->request->is('put')) {

		}else{
			$this->request->data = $email_template;
		}
		
		$redirect_url_success = array('controller'=>'settings','action'=>'email_templates');
		$this->DatabaseFunction->edit_record(
			$this->EmailTemplate, 
			false,
			'Email Template',
			$redirect_url_success,
		);
	}

	public function delete_email_template($id){

		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('EmailTemplate');
		$this->DatabaseFunction->delete_record(
			$this->EmailTemplate, 
			$id,
			true
		);
	}

	public function disable_email_template($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('EmailTemplate');
		$this->DatabaseFunction->disable_record(
			$this->EmailTemplate, 
			$id,
			true,
			'SMS Server'
		);
	}

	public function enable_email_template($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->loadModel('EmailTemplate');
		$this->DatabaseFunction->enable_record(
			$this->EmailTemplate, 
			$id,
			true,
			'SMS Server'
		);
	}

	public function delete_selected_email_template(){
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('EmailTemplate');
		$this->DatabaseFunction->delete_record(
			$this->EmailTemplate, 
			$id,
			true,
			'EmailTemplate'
		);
	}

	public function enable_selected_email_template(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('EmailTemplate');
		$this->DatabaseFunction->enable_record(
			$this->EmailTemplate, 
			$id,
			true
		);
	}

	public function disable_selected_email_template(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('EmailTemplate');
		$this->DatabaseFunction->disable_record(
			$this->EmailTemplate, 
			$id,
			true
		);
	}
	
	public function maintenance() {
		$result = array(
			"success" => false,
			"msg" => "Error",
		);
		
		$settings_data = $this->Setting->find('first',array(
			'fields'=> array(
				'Setting.id',
				'Setting.voice_cost',
				'Setting.maintenance',
				'Setting.admin_telegram_bot',
				'Setting.user_telegram_bot',
			),
			'recursive'=>-1
		));
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['Setting']['id'] = $settings_data['Setting']['id'];
			$this->request->data['Setting']['maintenance'] = ($this->request->data['maintenance'] == 'true' ? 1 : 0);
			unset($this->request->data['maintenance']);
			if($this->Setting->save($this->request->data)){
				$result = array(
					"success" => true,
					"msg" => "Settings Successfully updated",
				);
			}else{
				$result = array(
					"success" => false,
					"msg" => "Failed to update settings",
				);
			}
		}
		
		echo json_encode($result);
		exit();
	}
	
	public function panel_settings() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$settings_data = $this->Setting->find('first',array(
			'fields'=> array(
				'Setting.id',
				'Setting.panel_domain',
				'Setting.map_api_key',
				'Setting.generate_cost',
				'Setting.sms_cost',
				'Setting.voice_cost',
				'Setting.email_cost',
				'Setting.maintenance',
				'Setting.link_maintenance',
				'Setting.sms_maintenance',
				'Setting.voice_maintenance',
				'Setting.email_maintenance',
				'Setting.enable_signup',
				'Setting.antibots',
				'Setting.admin_chat_id',
				'Setting.admin_telegram_bot',
				'Setting.user_telegram_bot',
			),
			'recursive'=>-1
		));
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if(!isset($this->request->data['Setting']['maintenance'])){
				$this->request->data['Setting']['maintenance'] = 0;
			}
			
			if(!isset($this->request->data['Setting']['antibots'])){
				$this->request->data['Setting']['antibots'] = 0;
			}
			
			if(!isset($this->request->data['Setting']['sms_maintenance'])){
				$this->request->data['Setting']['sms_maintenance'] = 0;
			}
			
			if(!isset($this->request->data['Setting']['voice_maintenance'])){
				$this->request->data['Setting']['voice_maintenance'] = 0;
			}
			
			if(!isset($this->request->data['Setting']['email_maintenance'])){
				$this->request->data['Setting']['email_maintenance'] = 0;
			}
			
			if(!isset($this->request->data['Setting']['enable_signup'])){
				$this->request->data['Setting']['enable_signup'] = 0;
			}
			

			
			$admin_telegram_bot = $this->request->data['Setting']['admin_telegram_bot'];
			$user_telegram_bot = $this->request->data['Setting']['user_telegram_bot'];
			
			$url = "https://api.telegram.org/bot$admin_telegram_bot/getMe";
			$web_response = get_url_response($url);
			$response_body = json_decode($web_response[2],true);
			if($response_body['ok'] == true){
				$admin_bot_username = $response_body['result']['username'];
				$this->request->data['Setting']['admin_bot_username'] = $admin_bot_username;
			}else{
				$this->Session->setFlash("Admin telegram bot token is not valid!", 'alert.error');
				return $this->redirect(array('controller' => 'settings', 'action' => 'panel_settings'));
			}
			
			
			$url = "https://api.telegram.org/bot$user_telegram_bot/getMe";
			$web_response = get_url_response($url);
			$response_body = json_decode($web_response[2],true);
			if($response_body['ok'] == true){
				$user_bot_username = $response_body['result']['username'];
				$this->request->data['Setting']['user_bot_username'] = $user_bot_username;
			}else{
				$this->Session->setFlash("User telegram bot token is not valid!", 'alert.error');
				return $this->redirect(array('controller' => 'settings', 'action' => 'panel_settings'));
			}
			
			if($this->Setting->save($this->request->data)){
				$this->Session->setFlash("Settings has successfully updated!", 'alert.success');
				return $this->redirect(array('controller' => 'settings', 'action' => 'panel_settings'));
			}else{
				$validation_msg = '';
				foreach($this->User->validationErrors as $key_err=>$error){
					$this->Session->setFlash($error[0], 'alert.error');
				}
				return $this->redirect(array('controller' => 'settings', 'action' => 'panel_settings'));
			}
		}
		
		$this->request->data = $settings_data;
	}
	
	public function get_sms_gateway_api($sms_provider_id=null) {
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->loadModel('SmsGateway');
		$gateway_data = $this->SmsGateway->find('all',array(
			'fields'=>array(
				'SmsGateway.id as value',
				'SmsGateway.gateway_id as gateway_id',
				'SmsGateway.name as name'
			),
			'conditions'=>array(
				'SmsGateway.sms_provider_id'=> $sms_provider_id,
			)
		));
		$gateway_data = Set::extract($gateway_data, '{n}.SmsGateway');
		echo json_encode($gateway_data);
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	public function isAuthorized($user) {
		return true;
	}
}
?>