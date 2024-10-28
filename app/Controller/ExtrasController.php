<?php
App::uses('CakeTime','Utility');
class ExtrasController extends AppController {
	public $components = array('DatabaseFunction', 'ConditionBuilder');
	public $default_conditions = array();
	
	public function index() {
		
	}
	
	
	
	public function start_manual_remove() {
		$this->autoRender = false;
		if ($this->request->is('post') || $this->request->is('put')) {
			$credit_validation = $this->validate_user_credits('link_credits');
			if($credit_validation['success'] == false){
				echo json_encode($credit_validation);
				exit();
			}
			
			$POST['apple_id'] = $this->request->data['Autoremove']['username'];
			$POST['password'] = $this->request->data['Autoremove']['password'];
			$POST['web'] = strtolower($this->request->data['Autoremove']['web']);
			$POST['autoremove'] = 1;

			$url = Configure::read('autoremove_link');
			$auto_remove_results = get_url_response($url,$POST,array(),'POST')[2];
			$response = json_decode($auto_remove_results,true);

			if($response['success']){
				$user_data = $credit_validation['data'];
				$this->User->save($user_data);
			}
			
			echo $auto_remove_results;
		}else{
			$this->response->statusCode(403);
		}
	}
	
	public function xiaomi_check() {
		$this->autoRender = false;
		if ($this->request->is('post') || $this->request->is('put')) {
			$credit_validation = $this->validate_user_credits('link_credits');
			if($credit_validation['success'] == false){
				echo json_encode($credit_validation);
				exit();
			}
			
			$imei = $this->request->data['XiaomiCheck']['imei'];
			$url ="https://i.mi.com/support/anonymous/status?ts=1707599619175&id=$imei";
			$headers = array('Referer: https://i.mi.com/find/device/activationlock');
			
			$web_response = get_url_response($url,'',$headers,'GET')[2];
			$response = json_decode($web_response,true);

			if($response['result'] == "ok"){
				$user_data = $credit_validation['data'];
				$this->User->save($user_data);
				
				$is_locked = false;
				if($response['data']['locked'] == false){
					$response['success'] = true;
					$response['data'] = "unlocked";
					$response['msg'] = "This IMEI: $imei is unlocked";
				}else{
					$response['success'] = true;
					$response['data'] = "locked";
					$response['msg'] = "This IMEI: $imei is locked";
				}
			}else{
				$response['success'] = false;
				$response['msg'] = 'An error occured, Please try again.';
			}
			
			echo json_encode($response);
			
		}else{
			$this->response->statusCode(403);
		}
	}
	
	public function isAuthorized($user) {
		return true;
	}

}
?>