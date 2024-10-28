<?php
class DaiAuditTrailCallbackBehavior extends ModelBehavior {
	public $audit_details_initialized = false;
	public $audit_username = null;
	
	public $audit_trail_id = null;
	public $audit_controller = null;
	public $audit_action = null;
	public $audit_query = null;
	public $audit_data_from = null;
	public $audit_data_to = null;
	
	public $audit_user_id = null;
	public $audit_event = null;
	public $audit_description = null;
	public $audit_source_id = null;
	
	public $audit_model = null;
	public $audit_module = null;
	public $audit_singular_alias = null;
	public $audit_plural_alias = null;
	
	public $audit_object_name = null;
	public $audit_trail_data = null;
	public $audit_trail_details_data = null;

	
	
	public $audit_events = array(
		'ADD' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: added a new ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'ADD MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: added new ::[audit_plural_alias]::.'
		),
		'EXPORT CSV' => array(
			'save_on' => 'afterFind',
			'description' => '::[audit_username]:: exported selected / filtered ::[audit_plural_alias]:: to CSV.'
		),
		'EXPORT EXCEL' => array(
			'save_on' => 'afterFind',
			'description' => '::[audit_username]:: exported selected / filtered ::[audit_plural_alias]:: to EXCEL.'
		),
		'EXPORT PDF' => array(
			'save_on' => 'afterFind',
			'description' => '::[audit_username]:: exported selected / filtered ::[audit_plural_alias]:: to PDF.'
		),
		'VIEW' => array(
			'save_on' => 'afterFind',
			'description' => '::[audit_username]:: viewed the selected ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'VIEW MANY' => array(
			'save_on' => 'afterFind',
			'description' => '::[audit_username]:: viewed selected / filtered ::[audit_plural_alias]::.'
		),
		'EDIT' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: edited the ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'EDIT MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: edited selected / filtered ::[audit_plural_alias]::.'
		),
		'UPDATE' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: updated the ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'UPDATE MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: updated selected / filtered ::[audit_plural_alias]::.'
		),
		'DELETE' => array(
			'save_on' => 'afterDelete',
			'description' => '::[audit_username]:: deleted the ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'DELETE MANY' => array(
			'save_on' => 'afterDelete',
			'description' => '::[audit_username]:: deleted selected / filtered ::[audit_plural_alias]::.'
		),
		'POST' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: posted the ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'POST MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: posted selected / filtered ::[audit_plural_alias]::.'
		),
		'ENABLE' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: enabled the ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'ENABLE MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: enabled selected / filtered ::[audit_plural_alias]::.'
		),
		'DISABLE' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: disabled the ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'DISABLE MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: disabled selected / filtered ::[audit_plural_alias]::.'
		),
		'LOCK' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: locked the ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'LOCK MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: locked selected / filtered ::[audit_plural_alias]::.'
		),
		'UNLOCK' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: unlocked the ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'UNLOCK MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: unlocked selected / filtered ::[audit_plural_alias]::.'
		),
		'MONITOR' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: monitered the ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'MONITOR MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: monitored selected / filtered ::[audit_plural_alias]::.'
		),
		'UNMONITOR' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: unmonitored the ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		'UNMONITOR MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: unmonitored selected / filtered ::[audit_plural_alias]::.'
		),
		'INCLUDE IN ALERT' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: included the ::[audit_singular_alias]::: ::[audit_object_name]:: in the alerts.'
		),
		'INCLUDE IN ALERT MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: included selected / filtered ::[audit_plural_alias]:: in the alerts.'
		),
		'UNINCLUDE IN ALERT' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: unincluded the ::[audit_singular_alias]::: ::[audit_object_name]:: in the alerts.'
		),
		'UNINCLUDE IN ALERT MANY' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: unincluded selected / filtered ::[audit_plural_alias]:: in the alerts.'
		),
		'OVERRIDE PASSWORD' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: overridden the ::[audit_singular_alias]:: details.'
		),
		'CHANGE PASSWORD' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: changed his / her password.'
		),
		'EXCEL REPORT' => array(
			'save_on' => 'afterFind',
			'description' => '::[audit_username]:: exported the selected ::[audit_singular_alias]:: ::[audit_object_name]:: to Excel.'
		),
		'PROCESS ITEM' => array(
			'save_on' => 'afterFind',
			'description' => '::[audit_username]:: process the selected ::[audit_singular_alias]:: ::[audit_object_name]::.'
		),
		'ISSUED' => array(
			'save_on' => 'afterSave',
			'description' => '::[audit_username]:: issued the ::[audit_singular_alias]::: ::[audit_object_name]::.'
		),
		
	);

	public function beforeFind(Model $model, $query) {
		$this->set_default_audit_details($model);
		
		$this->set_audit_query($model, json_encode($query));
		
		$this->check_final_trigger_and_save($model, __FUNCTION__);
	}
	
	public function afterFind(Model $model, $results, $primary = false) {
		if($primary) {
			$this->set_default_audit_details($model);
			
			if(isset($model->audit_override_model) && isset($model->audit_override_display_field) && isset($results[0][$model->audit_override_model][$model->audit_override_display_field])) {
				$this->set_audit_description($model, $results[0][$model->audit_override_model][$model->audit_override_display_field]);
			}
			else if(isset($results[0][$model->name][$model->displayField])) {
				$this->set_audit_description($model, $results[0][$model->name][$model->displayField]);
			}
			else {
				$this->set_audit_description($model);
			}
			 
			$this->set_audit_data_from($model, json_encode($results));
			
			$this->set_audit_trails($model);
			$this->set_audit_trail_details_after_find($model);
			
			$this->check_final_trigger_and_save($model, __FUNCTION__);
		}
	}
	
	public function beforeSave(Model $model, $options = array()) {
		$this->set_default_audit_details($model);
		
		$this->check_final_trigger_and_save($model, __FUNCTION__);
	}
	
	public function afterSave(Model $model, $created, $options = array()) {
		if(isset($model->audit_override_model) && isset($model->audit_override_display_field) && isset($model->data[$model->audit_override_model][$model->audit_override_display_field])) {
			$this->set_audit_description($model, $model->data[$model->audit_override_model][$model->audit_override_display_field]);
		}
		else if(isset($model->data[$model->name][$model->displayField])) {
			$this->set_audit_description($model, $model->data[$model->name][$model->displayField]);
		}
		else {
			$this->set_audit_description($model);
		}
		
		$this->set_audit_data_to($model, json_encode($model->data));
		$this->set_audit_trails($model);
		$this->set_audit_trail_details_after_save($model);
		
		$this->check_final_trigger_and_save($model, __FUNCTION__);
	}
	
	public function afterDelete(Model $model) {
		$this->check_final_trigger_and_save($model, __FUNCTION__);
	}
	
	public function check_final_trigger_and_save(&$model, $source_function = '') {
		if($this->audit_events[$this->audit_event]['save_on'] == $source_function) {
			// $this->audit_trail_data['AuditTrailDetail'] = $this->audit_trail_details_data;
			$AuditTrail = ClassRegistry::init('AuditTrail');
			$AuditTrail->saveAssociated($this->audit_trail_data, array('deep' => true)); 
		}
	}
	
	public function reset_audit_query(&$model){
		$this->set_audit_query($model, null);
	}
	
	public function set_audit_query(&$model, $audit_query){
		$this->audit_query = $audit_query;
	}
	
	public function reset_audit_data_from(&$model){
		$this->set_audit_data_from($model, null);
	}
	
	public function set_audit_data_from(&$model, $audit_data_from){
		
		if($audit_data_from !== '[[{"count":"0"}]]') {
			$this->audit_data_from = $audit_data_from;
		}
	}
	
	public function reset_audit_data_to(&$model){
		$this->set_audit_data_to($model, null);
	}
	
	public function set_audit_data_to(&$model, $audit_data_to){
		$this->audit_data_to = $audit_data_to;
	}
	
	public function set_default_audit_details(&$model) {
		if(!$this->audit_details_initialized) {
			$this->audit_user_id = $_SESSION['Auth']['User']['id'];
			
			if(isset($_SESSION['Auth']['User']['EndUser']['display_name'])) {
				$this->audit_username = $_SESSION['Auth']['User']['EndUser']['display_name'];
			}
			else {
				$this->audit_username = $_SESSION['Auth']['User']['username'];
			}
			
			$this->audit_model = $model->audit_model;
			$this->audit_module = $model->audit_module;
			$this->audit_event = $model->audit_event;
			$this->audit_controller = $model->audit_controller;
			$this->audit_action = $model->audit_action;
			$this->audit_singular_alias = $model->audit_singular_alias;
			$this->audit_plural_alias = $model->audit_plural_alias;
			
			$this->audit_details_initialized = true;
		}
	}
	
	public function set_audit_trails(&$model) {
		$this->audit_trail_data = array(
			'AuditTrail' => array(
				'user_id' => $this->audit_user_id,
				'source_id' => $this->audit_source_id,
				'module' => $this->audit_module,
				'event' => $this->audit_event,
				'description' => $this->audit_description
			)
		);
	}
	
	public function set_audit_trail_details(&$model) {
		$this->audit_trail_details_data[] = array(
			'model' => $this->audit_model,
			'controller' => $this->audit_controller,
			'action' => $this->audit_action,
			'query' => $this->audit_query,
			'data_from' => $this->audit_data_from,
			'data_to' => $this->audit_data_to
		);
	}
	
	public function set_audit_trail_details_after_find(&$model) {
		$this->audit_trail_details_data[] = array(
			'model' => $this->audit_model,
			'controller' => $this->audit_controller,
			'action' => $this->audit_action,
			'query' => $this->audit_query,
			'data_from' => $this->audit_data_from
		);
	}
	
	public function set_audit_trail_details_after_save(&$model) {
		$this->audit_trail_details_data[] = array(
			'model' => $this->audit_model,
			'controller' => $this->audit_controller,
			'action' => $this->audit_action,
			'data_from' => $this->audit_data_from,
			'data_to' => $this->audit_data_to
		);
	}
	
	public function set_audit_description(&$model, $audit_object_name = null) {
		if(!isset($this->audit_object_name)) {
			$this->audit_object_name = $audit_object_name;
		}
 
		if(isset($this->audit_description)) {
			$this->audit_description = $this->replace_aliases($model, $this->audit_description);
		}
		else {
			$this->audit_description = $this->replace_aliases($model, $this->audit_events[$this->audit_event]['description']);
		}
	}
	
	public function replace_aliases(&$model, $phrase) {
		if(isset($this->audit_username)) {
			$phrase = str_replace('::[audit_username]::', $this->audit_username, $phrase);
		}
		
		if(isset($this->audit_singular_alias)) {
			$phrase = str_replace('::[audit_singular_alias]::', $this->audit_singular_alias, $phrase);
		}
		
		if(isset($this->audit_plural_alias)) {
			$phrase = str_replace('::[audit_plural_alias]::', $this->audit_plural_alias, $phrase);
		}
		if(isset($this->audit_object_name)) {
			$phrase = str_replace('::[audit_object_name]::', $this->audit_object_name, $phrase);
		}

		return $phrase;
	}
}
?>