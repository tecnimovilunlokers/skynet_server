<?php
	echo $this->ModernizeComponent->create_card_container_start('Email Templates');
	$model = 'EmailTemplate';
	$controller = 'settings';
	$action = Inflector::underscore($model);
	echo $this->ModernizeComponent->create_table_view(array(
		'id'=> 'email_templates',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('Name' => array()),
			array('Status' => array()),
		),
		'table-settings' => array(
			'model' => $model,
			'controller' => $controller,
			'prefix' => false,
			'action' => $action,
			'ajax'=>true,
			'multiselect'=>array(
				'delete',
				'disable',
				'enable',
			),
			'include' => array(
				'search',
				'add',
				'edit',
				'delete' => array(
					'ajax'=>array(
						'title' => 'Are you sure?',
						'description' => 'You won\'t be able to revert this!!'
					)
				)
			),
			'include_controls' => array(
				'disable'=>array(
					'ajax' => true,
					'on'=>array(
						'field'=>array('EmailTemplate.status'=>'<span class="mb-1 badge bg-success">Active</span>'),
						'operator'=>'equal'
					)
				),
				'enable'=>array(
					'ajax' => true,
					'on'=>array(
						'field'=>array('EmailTemplate.status'=>'<span class="mb-1 badge bg-danger">Disabled</span>'),
						'operator'=>'equal'
					)
				),
			),
			'search_options' => array(
				array('name',12, array('type' => 'text')),
				array('status',12, array('type'=>'select'),getStatusArray()),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
?>