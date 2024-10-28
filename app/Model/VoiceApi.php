<?php
App::uses('Model', 'Model');

class VoiceApi extends AppModel {
	public $useTable = 'voice_api';
	public $audit_model = 'VoiceApi';
	public $audit_module = 'VoiceApi';
	public $audit_singular_alias = 'VoiceApi';
	public $audit_plural_alias = 'VoiceApis';
	
	public $virtualFields = array(
		'status_desc' => "CASE VoiceApi.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
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
			'validation 3' => array(
				'rule' => array('isUnique'),
				'message'	=> 'API name is already taken.'
			)
        ),
		'sid' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Account SID is required and must not be empty.'
			),
        ),
		'token' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Account token is required and must not be empty.'
			),
        ),
		'phone_number' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Phone number is required and must not be empty.'
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
	);
	public $hasMany = array(
		
	);
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['VoiceApi']['id'])) {
		   $this->data['VoiceApi']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['VoiceApi']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['VoiceApi']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
	
}