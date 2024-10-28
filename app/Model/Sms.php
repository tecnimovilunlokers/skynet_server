<?php
App::uses('Model', 'Model');
class Sms extends AppModel {
	public $useTable = 'sms';
	public $audit_model = 'Sms';
	public $audit_module = 'Sms';
	public $audit_singular_alias = 'Sms';
	public $audit_plural_alias = 'Sms';
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'type' => 'left',
			'foreignKey' => 'created_by',
			'conditions' => array(
			)
		),
		'SmsApi' => array(
			'className' => 'SmsApi',
			'type' => 'left',
			'foreignKey' => 'sms_api_id',
		),
	);
	
	public $hasOne = array(
		
	);
	
	public $hasMany = array(
       
    );
	
	
	public function beforeValidate($options = array()) {
	    if(isset($this->data['Sms']['from_api']) && $this->data['Sms']['from_api']==1){
	        
	    }else{
	        if(!isset($this->data['Sms']['id'])) {
    		   $this->data['Sms']['created_by'] = $_SESSION['Auth']['User']['id']; 
    		   $this->data['Sms']['modified_by'] = $_SESSION['Auth']['User']['id']; 
    		}else {
    		   $this->data['Sms']['modified_by'] = $_SESSION['Auth']['User']['id']; 
    		}
	    }
		
		return true;
	}
}
?>