<?php
App::uses('Model', 'Model');

class Email extends AppModel {
	public $audit_model = 'Email';
	public $audit_module = 'Email';
	public $audit_singular_alias = 'Email';
	public $audit_plural_alias = 'Emails';
	
	public $virtualFields = array(
		'status_desc' => "CASE Email.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
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
		'EmailApi' => array(
			'className' => 'EmailApi',
			'foreignKey' => 'email_api_id',
		),
		'EmailTemplate' => array(
			'className' => 'EmailTemplate',
			'foreignKey' => 'email_template_id',
		),
	);
	public $hasMany = array(
		
	);
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['Email']['id'])) {
		   $this->data['Email']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['Email']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['Email']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
	
}