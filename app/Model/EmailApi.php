<?php
App::uses('Model', 'Model');

class EmailApi extends AppModel {
	public $useTable = 'email_api';
	public $audit_model = 'EmailApi';
	public $audit_module = 'EmailApi';
	public $audit_singular_alias = 'EmailApi';
	public $audit_plural_alias = 'EmailApis';
	
	public $virtualFields = array(
		'status_desc' => "CASE EmailApi.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
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
		'host' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Host is required and must not be empty.'
			),
			'validation 2' => array(
				'required' => 'update',
				'rule' => array('notBlank'),
				'message'	=> 'Host is required and must not be empty.'
			),
        ),
		'port' => array(
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
				'required' => 'update',
				'rule' => array('notBlank'),
				'message'	=> 'Port is required and must not be empty.'
			),
        ),
		'username' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'username is required and must not be empty.'
			),
			'validation 2' => array(
				'rule' => array('isUnique'),
				'message'	=> 'username is already taken.'
			),
			'validation 3' => array(
				'required' => 'update',
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
			'validation 2' => array(
				'required' => 'update',
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
	);
	
	public $hasMany = array(
		
	);
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['EmailApi']['id'])) {
		   $this->data['EmailApi']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['EmailApi']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['EmailApi']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
	
}