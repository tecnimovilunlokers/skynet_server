<?php
App::uses('Model', 'Model');

class SmsApi extends AppModel {
	public $useTable = 'sms_api';
	public $audit_model = 'SmsApi';
	public $audit_module = 'SmsApi';
	public $audit_singular_alias = 'SmsApi';
	public $audit_plural_alias = 'SmsApis';
	
	public $virtualFields = array(
		'status_desc' => "CASE SmsApi.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
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
			'validation 2' => array(
				'rule' => array('isUnique'),
				'message'	=> 'API name is already taken.'
			)
        ),
		'username' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Username is required and must not be empty.'
			),
        ),
		'password' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Password is required and must not be empty.'
			),
        )
	);
	
	public $hasOne = array(
	  
	);
	
	public $belongsTo = array(
		'AddedBy' => array(
			'className' => 'User',
			'foreignKey' => 'created_by',
			'fields' => array(
				'AddedBy.id',
				'AddedBy.username', 
				'AddedBy.role', 
			),
		),
		'SmsProvider' => array(
			'className' => 'SmsProvider',
			'foreignKey' => 'sms_provider_id',
		),
	);
	public $hasMany = array(
		
	);
	
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['SmsApi']['id'])) {
		   $this->data['SmsApi']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['SmsApi']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['SmsApi']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
	
}