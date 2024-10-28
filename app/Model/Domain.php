<?php
App::uses('Model', 'Model');
class Domain extends AppModel {
	
	public $audit_model = 'Domain';
	public $audit_module = 'Domain';
	public $audit_singular_alias = 'Domain';
	public $audit_plural_alias = 'Domains';
	
	public $virtualFields = array(
		'shared' => "CASE Domain.is_for_all WHEN 1 THEN 'Yes' ELSE 'No' END",
		'status_desc' => "CASE Domain.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
	);
	
	public $validate = array(
        'name' => array(
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
			'validation 3' => array(
				'rule' => array('isUnique'),
				'message'	=> 'Domain already exists.'
			)
        ),
	);
	
	public $belongsTo = array(
		
	);
	
	public $hasOne = array(
		
	);
	
	public $hasMany = array(
       
    );
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['Domain']['id'])) {
		   $this->data['Domain']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['Domain']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['Domain']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
}
?>