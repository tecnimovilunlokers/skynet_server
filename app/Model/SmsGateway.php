<?php
App::uses('Model', 'Model');

class SmsGateway extends AppModel {
	// public $useTable = 'sms_api';
	public $audit_model = 'SmsGateway';
	public $audit_module = 'SmsGateway';
	public $audit_singular_alias = 'SmsGateway';
	public $audit_plural_alias = 'SmsGateways';
	
	public $virtualFields = array(
		'status_desc' => "CASE SmsGateway.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
	);
	
	public $validate = array(
        'id' => array(
			'validation 1' => array(
				'required' => 'update',
				'rule' => array('notBlank'),
				'message'	=> 'ID is required and must not be empty.'
			),
			'validation 2' => array(
				'rule' => array('naturalNumber'),
				'message'	=> 'ID must be a non-decimal number that is greater than zero.'
			),
			'validation 3' => array(
				'rule' => array('isUnique'),
				'message'	=> 'ID is already existing.'
			)
        ),
		'name' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'API name is required and must not be empty.'
			),
        ),
		'gateway_id' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Gateway is required and must not be empty.'
			),
        ),
		'sms_provider_id' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Provider is required and must not be empty.'
			),
			'validation 2' => array(
				'rule' => array('naturalNumber'),
				'message'	=> 'Provider must be a non-decimal number that is greater than zero.'
			)
        ),
		
	);
	
	public $hasOne = array(
	  
	);
	
	public $belongsTo = array(
		'SmsProvider' => array(
			'className' => 'SmsProvider',
			'foreignKey' => 'sms_provider_id',
		),
		'AddedBy' => array(
			'className' => 'User',
			'foreignKey' => 'created_by',
			'fields' => array(
				'AddedBy.id',
				'AddedBy.username', 
				'AddedBy.role', 
			),
		),
	);
	public $hasMany = array(
		
	);
	
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['SmsGateway']['id'])) {
		   $this->data['SmsGateway']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['SmsGateway']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['SmsGateway']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
	
}