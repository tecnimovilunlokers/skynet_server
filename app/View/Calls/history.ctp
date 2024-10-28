<?php
	
	
	$model = 'Call';
	$controller = 'calls';
	$action = Inflector::underscore($model);
	
	echo $this->ModernizeComponent->create_card_container_start('Call History');
	echo $this->ModernizeComponent->create_table_view(array(
		// 'id' => 'users-table',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('Server' => array()),
			array('Template' => array()),
			array('Phone Number' => array()),
			array('Passcode' => array()),
			array('Status' => array()),
			array('Added By' => array()),
		),
		'table-settings' => array(
			'model' => $model,
			'controller' => $controller,
			'prefix' => false,
			'action' => $action,
			'ajax'=>true,
			'include' => array(
				'search',
			),
			'search_options' => array(
				array('server_name',6, array()),
				array('template_name',6, array()),
				array('phone_number',6, array()),
				array('passcode',6, array()),
				array('call_status',6, array()),
				array('username',6, array()),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
?>