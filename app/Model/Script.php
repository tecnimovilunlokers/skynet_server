<?php
App::uses('Model', 'Model');
class Script extends AppModel {
	
	public $audit_model = 'Script';
	public $audit_module = 'Script';
	public $audit_singular_alias = 'Script';
	public $audit_plural_alias = 'Scripts';
	
	public $virtualFields = array(
		'map_desc' => "CASE Script.map WHEN 1 THEN 'Yes' ELSE 'No' END",
		'status_desc' => "CASE Script.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
	);
	
	public $validate = array(
        'name' => array(
			'validation 1' => array(
				'required' => 'update',
				'rule' => array('notBlank'),
				'message'	=> 'Script is required and must not be empty.'
			),
			'validation 2' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Script is required and must not be empty.'
			),
			'validation 3' => array(
				'rule' => array('isUnique'),
				'message'	=> 'Script already exists.'
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
		if(!isset($this->data['Script']['id'])) {
		   $this->data['Script']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['Script']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['Script']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
}
?>