<?php
App::uses('Model', 'Model');

class VoiceTemplate extends AppModel {
	public $audit_model = 'VoiceTemplate';
	public $audit_module = 'VoiceTemplate';
	public $audit_singular_alias = 'VoiceTemplate';
	public $audit_plural_alias = 'VoiceTemplates';
	
	public $virtualFields = array(
		'status_desc' => "CASE VoiceTemplate.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
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
		'type' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Type is required and must not be empty.'
			),
        ),
		'path' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Path is required and must not be empty.'
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
	);
	public $hasMany = array(
		
	);
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['VoiceTemplate']['id'])) {
		   $this->data['VoiceTemplate']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['VoiceTemplate']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['VoiceTemplate']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
	
}