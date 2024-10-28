<?php
App::uses('Model', 'Model');
class LanguageVoice extends AppModel {
	
	public $audit_model = 'LanguageVoice';
	public $audit_module = 'LanguageVoice';
	public $audit_singular_alias = 'LanguageVoice';
	public $audit_plural_alias = 'LanguageVoices';
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'type' => 'left',
			'foreignKey' => 'created_by',
			'conditions' => array(
			)
		),
	);
	
	public $hasOne = array(
		
	);
	
	public $hasMany = array(
       
    );
	
	 public function beforeSave($options = array()) {
      // debug($this->data);
	  // exit();
      return true;
    }
	
	public function beforeValidate($options = array()) {
		if (isset($this->data['LanguageVoice']['from_webhook']) && $this->data['LanguageVoice']['from_webhook']==true){
			
		}else{
			if(!isset($this->data['LanguageVoice']['id'])) {
			   $this->data['LanguageVoice']['created_by'] = $_SESSION['Auth']['User']['id']; 
			   $this->data['LanguageVoice']['modified_by'] = $_SESSION['Auth']['User']['id']; 
			}
			else {
			   $this->data['LanguageVoice']['modified_by'] = $_SESSION['Auth']['User']['id']; 
			}
			
		}
		return true;
	}
	
	public function afterFind($results, $primary = false) { 
		foreach($results as $results_key => $results_value) { 
		
			if (isset($results_value['LanguageVoice']['status'])) {
				$results[$results_key]['LanguageVoice']['status'] = Configure::read('STATUS')[$results_value['LanguageVoice']['status']]; 
			}
		} 
		
		return $results;
	}
}
?>