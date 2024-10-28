<?php
	echo $this->ModernizeComponent->create_card_container_start('SMS Gateway');
	$model = 'SmsGateway';
	$controller = 'settings';
	$action = Inflector::underscore($model);
	echo $this->ModernizeComponent->create_table_view(array(
		'id' => 'sms_gateways',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('Provider' => array()),
			array('Gateway ID' => array()),
			array('Gateway Name' => array()),
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
						'field'=>array('SmsGateway.status'=>'<span class="mb-1 badge bg-success">Active</span>'),
						'operator'=>'equal'
					)
				),
				'enable'=>array(
					'ajax' => true,
					'on'=>array(
						'field'=>array('SmsGateway.status'=>'<span class="mb-1 badge bg-danger">Disabled</span>'),
						'operator'=>'equal'
					)
				),
			),
			'search_options' => array(
				array('sms_provider_id',12, array('label' => 'Provider','type' => 'select'),$sms_provider_list),
				array('gateway_id',6, array('type' => 'text')),
				array('gateway_name',6, array('type' => 'text')),
				array('status',12, array('type'=>'select'),getStatusArray()),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	//add new modal
	echo $this->ModernizeComponent->create_start_modal('add_record','Add SMS Gateway');
	echo $this->Form->create('SmsGateway',array('url'=>array('controller' => 'settings', 'action' => 'add_sms_gateway')));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('sms_provider_id',12, array('label' => 'Provider','type'=>'select','required'),$sms_provider_list),
				array('gateway_id',12, array('type'=>'text','required')),
				array('name',12, array('label' => 'Gateway Name','required')),
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
	echo $this->ModernizeComponent->create_start_modal('edit_record','Update SMS Gateway');
	echo $this->Form->create('EditSmsGateway',array('url'=>array('controller' => 'settings', 'action' => 'edit_sms_gateway')));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('id',12, array('label' => false,'type'=>'hidden','required')),
				array('sms_provider_id',12, array('label' => 'Provider','type'=>'select','required'),$sms_provider_list),
				array('gateway_id',12, array('type'=>'text','required')),
				array('name',12, array('label' => 'Gateway Name','required')),
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
		
		$('#EditSmsGatewayId').val(data['SmsGateway.id']);
		$('#EditSmsGatewaySmsProviderId').val(data['SmsProvider.id']).trigger('change');
		$('#EditSmsGatewayGatewayId').val(data['SmsGateway.gateway_id']);
		$('#EditSmsGatewayName').val(data['SmsGateway.name']);
	});
	
	
	$('#SmsGatewayAddSmsGatewayForm, #EditSmsGatewayEditSmsGatewayForm').on('submit',function(e){
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
			  $('#sms_gateways').DataTable().ajax.reload( null, false );
		  }
		});
	});
	
	
});
</script>