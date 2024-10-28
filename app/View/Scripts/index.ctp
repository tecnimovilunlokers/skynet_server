<?php
$model = 'Script';
$controller = 'scripts';
$action = Inflector::underscore($model);

echo $this->ModernizeComponent->create_card_container_start('Manage Scripts');
echo $this->ModernizeComponent->create_table_view(array(
	'id'=>'scripts',
	'class' => 'table align-middle text-nowrap',
	'column-headers' => array(
		array('Script Name' => array()),
		array('Folder Name' => array()),
		array('Web' => array()),
		array('Map' => array()),
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
			'enable',
			'disable',
		),
		'include' => array(
			'search',
			'add' => array('attributes'=>array('href'=>'#', 'data-bs-toggle'=>'modal','data-bs-target'=>'#add_record')),
			'edit'=>array('attributes'=>array('class'=>'edit_record','href'=>'#','data-bs-toggle'=>'modal','data-bs-target'=>'#edit_record')),
			'edit',
			'delete',
		),
		'include_controls' => array(
			'disable'=>array(
				'ajax' => true,
				'on'=>array(
					'field'=>array('Script.status_desc'=>'<span class="mb-1 badge bg-success">Active</span>'),
					'operator'=>'equal'
				)
			),
			'enable'=>array(
				'ajax' => true,
				'on'=>array(
					'field'=>array('Script.status_desc'=>'<span class="mb-1 badge bg-danger">Disabled</span>'),
					'operator'=>'equal'
				)
			),
		),
		'search_options' => array(
			array('name',12, array('label' => 'Script Name','required')),
			array('folder',12, array('label' => 'Folder Name','type'=>'text')),
			array('web',12, array('type'=>'select'),getSupportedWeb()),
			array('map',12, array('label'=>'Map Script','type'=>'select'),array('1'=>'Yes','0'=>'No')),
			array('status',12, array('type'=>'select'),getStatusArray()),
		),
		'table-data' => $data ?? array(),
	),
	
));
echo $this->ModernizeComponent->create_card_container_end();


//add new modal
echo $this->ModernizeComponent->create_start_modal('add_record','Add Script');
echo $this->Form->create('Script',array('url'=>array('controller' => 'scripts', 'action' => 'add_script'),'enctype'=>'multipart/form-data'));
echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
	array(
		'size' => 12,
		'orientation' => 'vertical',
		'contents' => array(
			array('name',12, array('label' => 'Script Name','required')),
			array('folder',12, array('label' => 'Folder Name','type'=>'text')),
			array('web',12, array('type'=>'select'),getSupportedWeb()),
			array('script_img',12, array('type'=>'file','required')),
			array('map',12, array('label'=>'Map Script','type'=>'switch_yes')),
		)
	)
));

echo '<div class="modal-footer">';
echo $this->Form->button('Save', array('id'=>'add_submit','type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
echo '</div>';
echo $this->Form->end();
echo $this->ModernizeComponent->create_end_modal();


//edit modal
echo $this->ModernizeComponent->create_start_modal('edit_record','Edit Script');
echo $this->Form->create('EditScript',array('url'=>array('controller' => 'scripts', 'action' => 'edit_script'),'enctype'=>'multipart/form-data'));
echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
	array(
		'size' => 12,
		'orientation' => 'vertical',
		'contents' => array(
			array('id',12, array('label' => false,'type'=>'hidden','required')),
			array('name',12, array('label' => 'Script Name','required')),
			array('folder',12, array('label' => 'Folder Name','type'=>'text')),
			array('web',12, array('type'=>'select'),getSupportedWeb()),
			array('script_img',12, array('type'=>'file')),
			array('map',12, array('label'=>'Map Script','type'=>'switch_yes')),
		)
	)
));

echo '<div class="modal-footer">';
echo $this->Form->button('Save', array('id'=>'edit_submit','type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
echo '</div>';
echo $this->Form->end();
echo $this->ModernizeComponent->create_end_modal();

?>

<script>
$(document).ready(function(){

	$(document).on('click','.edit_record',function(e){
		var id = $(this).attr('data-id');
		var data = JSON.parse($(this).closest('tr').find('.update_data').val());

		$('#EditScriptId').val(data['Script.id']);
		$('#EditScriptName').val(data['Script.name']);
		$('#EditScriptFolder').val(data['Script.folder']);
		$('#EditScriptWeb').val(data['Script.web']).trigger('change');
		$('#EditScriptMap').prop('checked', parseInt(data['Script.map'])).trigger('change');
	});
	
});
</script>