<?php
App::uses('Model', 'Model');
class UserDomain extends AppModel {
	
	public $audit_model = 'UserDomain';
	public $audit_module = 'UserDomain';
	public $audit_singular_alias = 'UserDomain';
	public $audit_plural_alias = 'UserDomains';
	
	public $virtualFields = array(
		// 'shared' => "CASE UserDomain.is_for_all WHEN 1 THEN 'Yes' ELSE 'No' END",
		// 'status_desc' => "CASE UserDomain.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
	);
	
	public $validate = array(
        'domain_id' => array(
			'validation 1' => array(
				'required' => 'update',
				'rule' => array('notBlank'),
				'message'	=> 'Domain is required and must not be empty.'
			),
			'validation 2' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Domain is required and must not be empty.'
			),
        ),
	);
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'fields' => array(
				'User.id',
				'User.username', 
				'User.role', 
			),
		),
		'Domain' => array(
			'className' => 'Domain',
			'foreignKey' => 'domain_id',
			'fields' => array(
				'Domain.id',
				'Domain.name', 
				'Domain.status', 
			),
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
	
	public $hasOne = array(
		
	);
	
	public $hasMany = array(
       
    );
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['UserDomain']['id'])) {
		   $this->data['UserDomain']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['UserDomain']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['UserDomain']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
}
?>