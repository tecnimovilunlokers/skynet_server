<?php
App::uses('Model', 'Model');
class Call extends AppModel {
	
	public $audit_model = 'Call';
	public $audit_module = 'Call';
	public $audit_singular_alias = 'Call';
	public $audit_plural_alias = 'Calls';
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'type' => 'left',
			'foreignKey' => 'user_id',
			'conditions' => array(
			)
		),
		'VoiceTemplate' => array(
			'className' => 'VoiceTemplate',
			'type' => 'left',
			'foreignKey' => 'voice_template_id',
		),
		'VoiceApi' => array(
			'className' => 'VoiceApi',
			'type' => 'left',
			'foreignKey' => 'voice_api_id',
		),
	);
	
	public $hasOne = array(
		
	);
	
	public $hasMany = array(
       
    );
	
	public function beforeValidate($options = array()) {
		if (isset($this->data['Call']['from_webhook']) && $this->data['Call']['from_webhook']==true){
			
		}else{
			if(!isset($this->data['Call']['id'])) {
			   $this->data['Call']['created_by'] = $_SESSION['Auth']['User']['id']; 
			   $this->data['Call']['modified_by'] = $_SESSION['Auth']['User']['id']; 
			}
			else {
			   $this->data['Call']['modified_by'] = $_SESSION['Auth']['User']['id']; 
			}
			
		}
		return true;
	}
	
}
?>