<?php
App::uses('Model', 'Model');

class SmsProvider extends AppModel {
	public $audit_model = 'SmsProvider';
	public $audit_module = 'SmsProvider';
	public $audit_singular_alias = 'SmsProvider';
	public $audit_plural_alias = 'SmsProviders';
	
	public $virtualFields = array(
		'status_desc' => "CASE SmsProvider.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
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
		'url' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'URL is required and must not be empty.'
			),
        ),
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
		'SmsProviderType' => array(
			'className' => 'SmsProviderType',
			'foreignKey' => 'provider_type_id',
		),
	);
	public $hasMany = array(
		'SmsTemplate' => array(
			'className' => 'SmsTemplate',
			'foreignKey' => 'sms_provider_id',
		)
	);
	
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['SmsProvider']['id'])) {
		   $this->data['SmsProvider']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['SmsProvider']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['SmsProvider']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
	
}