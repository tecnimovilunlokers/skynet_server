<?php
$model = 'Domain';
$controller = 'base';
$action = Inflector::underscore($model);

echo $this->ModernizeComponent->create_card_container_start('Manage Domains');
echo $this->ModernizeComponent->create_table_view(array(
	'id' => 'domains',
	'class' => 'table align-middle text-nowrap',
	'column-headers' => array(
		array('Domain' => array()),
		array('Shared' => array()),
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
			'add' => array('attributes'=>array('href'=>'#', 'data-bs-toggle'=>'modal','data-bs-target'=>'#add_record')),
			'edit'=>array('attributes'=>array('class'=>'edit_record','href'=>'#','data-bs-toggle'=>'modal','data-bs-target'=>'#edit_record')),
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
					'field'=>array('Domain.status_desc'=>'<span class="mb-1 badge bg-success">Active</span>'),
					'operator'=>'equal'
				)
			),
			'enable'=>array(
				'ajax' => true,
				'on'=>array(
					'field'=>array('Domain.status_desc'=>'<span class="mb-1 badge bg-danger">Disabled</span>'),
					'operator'=>'equal'
				)
			),
		),
		'search_options' => array(
			array('name',12, array('label' => 'Domain')),
			array('is_for_all',12, array('label'=>'Public Domain','type'=>'select'),array('1'=>'Yes','0'=>'No')),
			array('status',12, array('label'=>'Status','type'=>'select'),array('1'=>'Yes','0'=>'No')),
		),
		'table-data' => $data ?? array(),
	),
	
));
echo $this->ModernizeComponent->create_card_container_end();


//add new modal
echo $this->ModernizeComponent->create_start_modal('add_record','Add Domain');
echo $this->Form->create('Domain',array('url'=>array('controller' => 'base', 'action' => 'add_domain')));
echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
	array(
		'size' => 12,
		'orientation' => 'vertical',
		'contents' => array(
			array('name',12, array('label' => 'Domain','required')),
			array('is_for_all',12, array('label'=>'Public Domain <small class="text-muted">(if yes the domain will be shared to all of users)</small>','type'=>'switch_yes')),
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
echo $this->ModernizeComponent->create_start_modal('edit_record','Edit Domain');
echo $this->Form->create('EditDomain',array('url'=>array('controller' => 'base', 'action' => 'edit_domain')));
echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
	array(
		'size' => 12,
		'orientation' => 'vertical',
		'contents' => array(
			array('id',12, array('label' => false,'type'=>'hidden','required')),
			array('name',12, array('label' => 'Domain','required')),
			array('is_for_all',12, array('label'=>'Public Domain <small class="text-muted">(if yes the domain will be shared to all of users)</small>','type'=>'switch_yes')),
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
	$('#DomainAddDomainForm').on('submit',function(e){
		$('#add_submit').attr('disabled',true);
		e.preventDefault();
		$.ajax({
		  type: "POST",
		  url: $(this).attr('action'),
		  data: $(this).serialize(),
		  dataType: "json",
		  success: function(data){
			  if(data.success){
				  swal.fire("Success", data.msg, "success");
			  }else{
				  swal.fire("Error", data.msg, "error");
			  }
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
		  },
		  complete: function(data) {
			  $('#add_submit').removeAttr('disabled');
			  $('#add_record').modal('hide');
			  $('#domains').DataTable().ajax.reload( null, false );
		  }
		});
	});
	
	$(document).on('click','.edit_record',function(e){
		var id = $(this).attr('data-id');
		var data = JSON.parse($(this).closest('tr').find('.update_data').val());

		$('#EditDomainId').val(data['Domain.id']);
		$('#EditDomainName').val(data['Domain.name']);
		$('#EditDomainIsForAll').prop('checked', parseInt(data['Domain.is_for_all'])).trigger('change');
	});
	
	$('#EditDomainEditDomainForm').on('submit',function(e){
		$('#edit_submit').attr('disabled',true);
		e.preventDefault();
		$.ajax({
		  type: "POST",
		  url: $(this).attr('action'),
		  data: $(this).serialize(),
		  dataType: "json",
		  success: function(data){
			  if(data.success){
				  swal.fire("Success", data.msg, "success");
			  }else{
				  swal.fire("Error", data.msg, "error");
			  }
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
		  },
		  complete: function(data) {
			  $('#edit_submit').removeAttr('disabled');
			  $('#edit_record').modal('hide');
			  $('#domains').DataTable().ajax.reload( null, false );
		  }
		});
	});
	
	
});
</script>