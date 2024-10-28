<?php
App::uses('Model', 'Model');

class SmsCountry extends AppModel {
	// public $useTable = 'sms_api';
	public $audit_model = 'SmsCountry';
	public $audit_module = 'SmsCountry';
	public $audit_singular_alias = 'SmsCountry';
	public $audit_plural_alias = 'SmsCountrys';
	
	public $virtualFields = array(
		'fullname' => "CONCAT(SmsCountry.name,' (+',SmsCountry.code,')')",
		'status_desc' => "CASE SmsCountry.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
	);
	
	public $hasOne = array(
	  
	);
	
	public $belongsTo = array(
		
	);
	public $hasMany = array(
		
	);
	
	public function afterFind($results, $primary = false) { 
		foreach($results as $results_key => $results_value) { 
			if (isset($results_value['SmsCountry']['status'])) {
				$results[$results_key]['SmsCountry']['status'] = Configure::read('STATUS')[$results_value['SmsCountry']['status']]; 
			}
		}
		return $results;
	}
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['SmsCountry']['id'])) {
		   $this->data['SmsCountry']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['SmsCountry']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['SmsCountry']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
	
}