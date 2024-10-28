<?php
App::uses('Model', 'Model');
class GeneratedLink extends AppModel {
	
	public $audit_model = 'GeneratedLink';
	public $audit_module = 'GeneratedLink';
	public $audit_singular_alias = 'GeneratedLink';
	public $audit_plural_alias = 'GeneratedLinks';
	
	public $virtualFields = array(
		'status_desc' => "CASE GeneratedLink.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
	);
	
	public $validate = array(
        
	);
	
	public $belongsTo = array(
		'Domain' => array(
			'className' => 'Domain',
			'type' => 'left',
			'foreignKey' => 'domain_id',
			'fields' => array(
				
			),
		),
		'Script' => array(
			'className' => 'Script',
			'type' => 'left',
			'foreignKey' => 'script_id',
			'fields' => array(
				
			),
		),
		'LinkOwner' => array(
			'className' => 'User',
			'type' => 'left',
			'foreignKey' => 'user_id',
			'fields' => array(
				'LinkOwner.id',
				'LinkOwner.username',
			),
		),
	);
	
	public $hasOne = array(
		
	);
	
	public $hasMany = array(
       'GeneratedLinkLog' => array(
			'className' => 'GeneratedLinkLog',
			'type' => 'left',
			'foreignKey' => 'link_id',
		),
    );
	
	public function beforeValidate($options = array()) {
		if(isset($_SESSION['Auth']['User']['id'])){
			if(!isset($this->data['GeneratedLink']['id'])) {
			   $this->data['GeneratedLink']['created_by'] = $_SESSION['Auth']['User']['id']; 
			   $this->data['GeneratedLink']['modified_by'] = $_SESSION['Auth']['User']['id']; 
			}else{
			   $this->data['GeneratedLink']['modified_by'] = $_SESSION['Auth']['User']['id']; 
			}
		}
		return true;
	}
	
}
?>