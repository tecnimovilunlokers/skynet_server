<?php
App::uses('Model', 'Model');
class LanguageList extends AppModel {
	
	public $audit_model = 'LanguageList';
	public $audit_module = 'LanguageList';
	public $audit_singular_alias = 'LanguageList';
	public $audit_plural_alias = 'LanguageList';
	public $primaryKey = 'language_code';
	
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
       'LanguageVoice' => array(
			'className' => 'LanguageVoice',
			'type' => 'left',
			'foreignKey' => false,
			'conditions' => array(
				'LanguageList.language_code = LanguageVoice.language_code'
			)
		),
    );
	
	 public function beforeSave($options = array()) {
      // debug($this->data);
	  // exit();
      return true;
    }
	
	public function beforeValidate($options = array()) {
		if (isset($this->data['LanguageList']['from_webhook']) && $this->data['LanguageList']['from_webhook']==true){
			
		}else{
			if(!isset($this->data['LanguageList']['id'])) {
			   $this->data['LanguageList']['created_by'] = $_SESSION['Auth']['User']['id']; 
			   $this->data['LanguageList']['modified_by'] = $_SESSION['Auth']['User']['id']; 
			}
			else {
			   $this->data['LanguageList']['modified_by'] = $_SESSION['Auth']['User']['id']; 
			}
			
		}
		return true;
	}
	
	public function afterFind($results, $primary = false) { 
		foreach($results as $results_key => $results_value) { 
		
			if (isset($results_value['LanguageList']['status'])) {
				$results[$results_key]['LanguageList']['status'] = Configure::read('STATUS')[$results_value['LanguageList']['status']]; 
			}
		} 
		
		return $results;
	}
}
?>