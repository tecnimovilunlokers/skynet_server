<?php
	
	
	$model = 'Sms';
	$controller = 'Sms';
	$action = Inflector::underscore($model);
	
	echo $this->ModernizeComponent->create_card_container_start('SMS History');
	echo $this->ModernizeComponent->create_table_view(array(
		// 'id' => 'users-table',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('Server' => array()),
			array('Gateway' => array()),
			array('Sender ID' => array()),
			array('Recipient' => array()),
			array('Message' => array()),
			array('Status' => array()),
			array('Send By' => array()),
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
				array('sms_api_id',6, array('label'=>'Server','type'=>'select'),$server_list),
				array('gateway_name',6, array('label'=>'Gateway')),
				array('sender_id',6, array('type'=>'text')),
				array('recipient',6, array('type'=>'text')),
				array('sms_status',6, array('type'=>'select'), array('0'=>'Failed','1'=>'Success')),
				array('send_by',6, array('type'=>'text')),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
?>