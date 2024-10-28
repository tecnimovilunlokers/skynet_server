<?php
$model = 'GeneratedLinkLog';
$controller = 'generated_links';
$action = Inflector::underscore($model);

echo $this->ModernizeComponent->create_card_container_start('<div class="btn-group btn-group" role="group"><a href="'.$link.'" target="_blank" class="btn waves-effect waves-light btn-outline-primary fs-3">'.$link.'</a>'.$status.'</div>');
echo $this->ModernizeComponent->create_table_view(array(
	'class' => 'table align-middle text-nowrap',
	'column-headers' => array(
		array('Date' => array()),
		array('Script' => array('style'=>'min-width: 270px;')),
		array('Action' => array('style'=>'min-width: 220px;')),
		array('Location' => array('style'=>'min-width: 200px;')),
		array('Browser' => array('style'=>'min-width: 130px;')),
	),
	'table-settings' => array(
		'model' => $model,
		'controller' => $controller,
		'prefix' => false,
		'action' => $action,
		'ajax'=>true,
		
		'include' => array(
			'search',
			// 'add'=>array('label'=>$link,'url'=>$link,'attributes'=>array('target'=>'_blank')),
		),
		
		'search_options' => array(
			array('name',12, array('label' => 'Script Name','required')),
			array('folder',12, array('label' => 'Folder Name','type'=>'text')),
			array('web',12, array('type'=>'select'),getSupportedWeb()),
			array('map',12, array('label'=>'Map Script','type'=>'switch_yes')),
			array('status',12, array('type'=>'select'),getStatusArray()),
		),
		'table-data' => $data ?? array(),
	),
	
));

echo $this->ModernizeComponent->create_form_action_start();
echo $this->Html->link('<i class="fa-solid fa-circle-chevron-left"></i>&nbsp; Back',$this->request->referer(),array('type'=>'submit','class'=>'btn btn-danger font-medium rounded-pill px-5 mt-2','escape'=>false));
echo $this->ModernizeComponent->create_form_action_end();

echo $this->ModernizeComponent->create_card_container_end();
?>

