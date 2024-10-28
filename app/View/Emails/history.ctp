<?php
	$model = 'Email';
	$controller = 'emails';
	$action = Inflector::underscore($model);
	
	echo $this->ModernizeComponent->create_card_container_start('Email History');
	echo $this->ModernizeComponent->create_table_view(array(
		// 'id' => 'users-table',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('Template' => array()),
			array('Target Link' => array()),
			array('Subject' => array()),
			array('From' => array()),
			array('To' => array()),
			array('Body' => array()),
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
				array('template',6, array('type'=>'text')),
				array('target_link',6, array('type'=>'text')),
				array('subject',6, array('type'=>'text')),
				array('from',6, array('type'=>'text')),
				array('to',6, array('type'=>'text')),
				array('body',6, array('type'=>'text')),
				array('email_status',6, array('type'=>'select'), array('0'=>'Failed','1'=>'Success')),
				array('send_by',6, array('type'=>'text')),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
?>