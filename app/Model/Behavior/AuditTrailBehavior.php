<?php
class AuditTrailBehavior extends ModelBehavior {
	public function update_model_details(&$model, $model_name, $controller_name, $action_name, $event, $description = null) {
		$model->audit_model = $model_name;
		$model->audit_controller = $controller_name;
		$model->audit_action = $action_name;
		$model->audit_event = $event;
		$model->audit_description = $description;
		$model->audit_isset = true;
		
		if($model->audit_event == 'LOGIN'){
			$this->save_audit_trail($model);
		}
		if($model->audit_event == 'LOGOUT'){
			$this->save_audit_trail($model);
		}
	}
	
	public function attach_model(&$model, $attached_model_name = 'AuditTrailCallback') {
		if($model->audit_isset) {
			$model->Behaviors->attach($attached_model_name);
		}
	}
	
	public function record_login($event) {
		$display = '';
		if($event == 'LOGIN'){
			$audit_trail_display = 'User: ' . $_SESSION['Auth']['User']['username'] . ' has logged in.';
		}else{
			$audit_trail_display = 'User: ' . $_SESSION['Auth']['User']['username']. ' has logged out.';
		}
		$audit_trail_data = array(
			'AuditTrail' => array(
				'user_id' => $_SESSION['Auth']['User']['id'],
				'source_id' => '',
				'module' => $event,
				'event' => $event,
				'description' => $audit_trail_display,
			)
		);
		return $audit_trail_data;
	}
	
	public function save_audit_trail($model) {
		$audit_trail = $this->record_login($model->audit_event);
		$AuditTrail = ClassRegistry::init('AuditTrail');
		$AuditTrail->saveAssociated($audit_trail, array('deep' => true)); 
	}
}
?>