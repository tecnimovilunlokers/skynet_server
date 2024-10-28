<?php
App::uses('Model', 'Model');
class GeneratedLinkLog extends AppModel {
	
	public $audit_model = 'GeneratedLinkLog';
	public $audit_module = 'GeneratedLinkLog';
	public $audit_singular_alias = 'GeneratedLinkLog';
	public $audit_plural_alias = 'GeneratedLinkLogs';
	
	public $validate = array(
        
	);
	
	public $belongsTo = array(
		'Domain' => array(
			'className' => 'Domain',
			'foreignKey' => 'domain_id',
			'fields' => array(
				
			),
		),
		'Script' => array(
			'className' => 'Script',
			'foreignKey' => 'script_id',
			'fields' => array(
				
			),
		),
		'GeneratedLink' => array(
			'className' => 'GeneratedLink',
			'type' => 'left',
			'foreignKey' => 'link_id',
		),
	);
	
	public $hasOne = array(
		
	);
	
	public $hasMany = array(
       
    );
	
}
?>