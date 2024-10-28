<?php
	echo $this->ModernizeComponent->create_card_container_start('SMS Providers');
	$model = 'SmsProvider';
	$controller = 'settings';
	$action = Inflector::underscore($model);
	echo $this->ModernizeComponent->create_table_view(array(
		'id' => 'sms_providers',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('Name' => array()),
			array('Type' => array()),
			array('URL' => array()),
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
						'field'=>array('SmsProvider.status'=>'<span class="mb-1 badge bg-success">Active</span>'),
						'operator'=>'equal'
					)
				),
				'enable'=>array(
					'ajax' => true,
					'on'=>array(
						'field'=>array('SmsProvider.status'=>'<span class="mb-1 badge bg-danger">Disabled</span>'),
						'operator'=>'equal'
					)
				),
			),
			'search_options' => array(
				array('type',6, array('label' => 'Provider Type','type' => 'select'),$provider_types),
				array('name',6, array('type' => 'text')),
				array('url',12, array('label' => 'URL','type' => 'text')),
				array('status',12, array('type'=>'select'),getStatusArray()),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	//add new modal
	echo $this->ModernizeComponent->create_start_modal('add_record','Add Provider');
	echo $this->Form->create('SmsProvider',array('url'=>array('controller' => 'settings', 'action' => 'add_sms_provider')));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('provider_type_id',12, array('label' => 'Provider Type','type' => 'select'),$provider_types),
				array('name',12, array('type' => 'text')),
				array('url',12, array('label' => 'URL','type' => 'text')),
			)
		)
	));
	
	echo '<div class="modal-footer">';
	echo $this->Form->button('Add New', array('type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
	echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
	echo '</div>';
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_end_modal();
	
	//edit modal
	echo $this->ModernizeComponent->create_start_modal('edit_record','Update Provider');
	echo $this->Form->create('EditSmsProvider',array('url'=>array('controller' => 'settings', 'action' => 'edit_sms_provider')));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('id',12, array('label' => false,'type'=>'hidden','required')),
				array('type',12, array('label' => 'Provider Type','type' => 'select'),$provider_types),
				array('name',12, array('type' => 'text')),
				array('url',12, array('label' => 'URL','type' => 'text')),
			)
		)
	));
	
	echo '<div class="modal-footer">';
	echo $this->Form->button('Update', array('type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
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
		
		$('#EditSmsProviderId').val(data['SmsProvider.id']);
		$('#EditSmsProviderType').val(data['SmsProviderType.id']).trigger('change');
		$('#EditSmsProviderName').val(data['SmsProvider.name']);
		$('#EditSmsProviderUrl').val(data['SmsProvider.url']);
	});
	
	
	$('#SmsProviderAddSmsProviderForm, #EditSmsProviderEditSmsProviderForm').on('submit',function(e){
		var submit_button = $(this).find('button[type="submit"]');
		submit_button.attr('disabled',true);
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
			  submit_button.removeAttr('disabled');
			  $('#add_record').modal('hide');
			  $('#edit_record').modal('hide');
			  $('#sms_providers').DataTable().ajax.reload( null, false );
		  }
		});
	});
	
	
});
</script>