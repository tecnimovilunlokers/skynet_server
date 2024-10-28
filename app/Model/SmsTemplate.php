<?php
App::uses('Model', 'Model');

class SmsTemplate extends AppModel {
	public $audit_model = 'SmsTemplate';
	public $audit_module = 'SmsTemplate';
	public $audit_singular_alias = 'SmsTemplate';
	public $audit_plural_alias = 'SmsTemplates';
	
	public $virtualFields = array(
		'status_desc' => "CASE SmsTemplate.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
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
		'SmsCountry' => array(
			'className' => 'SmsCountry',
			'foreignKey' => false,
			'conditions'=>array(
				'SmsCountry.code = SmsTemplate.country_code'
			)
		),
		'SmsProvider' => array(
			'className' => 'SmsProvider',
			'foreignKey' => 'sms_provider_id',
		),
		'SmsGateway' => array(
			'className' => 'SmsGateway',
			'foreignKey' => 'sms_gateway_id',
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
		if(!isset($this->data['SmsTemplate']['id'])) {
		   $this->data['SmsTemplate']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['SmsTemplate']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['SmsTemplate']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
	
}