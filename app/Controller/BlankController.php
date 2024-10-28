<?php
App::uses('CakeTime','Utility');
class BaseController extends AppController {
	public $components = array('DatabaseFunction', 'ConditionBuilder');
	public $default_conditions = array();
	
	public function index() {
		
	}
	
	public function isAuthorized($user) {
		return true;
	}

}
?>