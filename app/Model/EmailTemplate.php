<?php
App::uses('Model', 'Model');

class EmailTemplate extends AppModel {
	public $audit_model = 'EmailTemplate';
	public $audit_module = 'EmailTemplate';
	public $audit_singular_alias = 'EmailTemplate';
	public $audit_plural_alias = 'EmailTemplates';
	
	public $virtualFields = array(
		'status_desc' => "CASE EmailTemplate.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
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
	);
	public $hasMany = array(
		
	);
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['EmailTemplate']['id'])) {
		   $this->data['EmailTemplate']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['EmailTemplate']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['EmailTemplate']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
	
}