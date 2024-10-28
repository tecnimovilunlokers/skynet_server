<?php
	echo $this->ModernizeComponent->create_card_container_start('SMS Template');
	$model = 'SmsTemplate';
	$controller = 'settings';
	$action = Inflector::underscore($model);
	echo $this->ModernizeComponent->create_table_view(array(
		'id' => 'sms_template',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('Country' => array()),
			array('Provider' => array()),
			array('Gateway' => array()),
			array('Sender ID' => array()),
			array('Carrier' => array()),
			array('Template' => array()),
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
						'field'=>array('SmsTemplate.status'=>'<span class="mb-1 badge bg-success">Active</span>'),
						'operator'=>'equal'
					)
				),
				'enable'=>array(
					'ajax' => true,
					'on'=>array(
						'field'=>array('SmsTemplate.status'=>'<span class="mb-1 badge bg-danger">Disabled</span>'),
						'operator'=>'equal'
					)
				),
			),
			'search_options' => array(
				array('sms_provider_id',6, array('label' => 'Provider','type' => 'select','class'=>'sms_provider'),$sms_provider_list),
				array('country_code',6, array('label' => 'Country','type'=>'select','required'),$country_list),
				array('gateway_id',6, array('label' => 'Gateway','type'=>'select','class'=>'gateway'),array()),
				array('sender_id',6, array('type' => 'text')),
				array('carrier_name',6, array('type' => 'text')),
				array('status',6, array('type'=>'select'),getStatusArray()),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	//add new modal
	echo $this->ModernizeComponent->create_start_modal('add_record','Add New Template');
	echo $this->Form->create('SmsTemplate',array('url'=>array('controller' => 'settings', 'action' => 'add_sms_template')));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('sms_provider_id',12, array('label' => 'Provider','type'=>'select','required','class'=>'sms_provider'),$sms_provider_list),
				array('country_code',6, array('label' => 'Country','type'=>'select','required'),$country_list),
				array('sms_gateway_id',6, array('label' => 'Gateway','type'=>'select','class'=>'gateway'),array()),
				array('sender_id',6, array('label' => 'Sender ID','type'=>'text','required')),
				array('carrier_name',6, array('required')),
				array('template',12, array('type'=>'textarea')),
			)
		)
	));
	
	echo '<div class="modal-footer">';
	echo $this->Form->button('Add New', array('id'=>'save_sms_template','type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
	echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
	echo '</div>';
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_end_modal();
	
	//edit modal
	echo $this->ModernizeComponent->create_start_modal('edit_record','Update SMS API');
	echo $this->Form->create('UpdateSmsTemplate',array('url'=>array('controller' => 'settings', 'action' => 'edit_sms_template', 'prefix' => false)));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('id',12, array('label' => false,'type'=>'hidden','required')),
				array('sms_provider_id',12, array('label' => 'Provider','type'=>'select','required','class'=>'sms_provider'),$sms_provider_list),
				array('country_code',6, array('label' => 'Country','type'=>'select','required'),$country_list),
				array('sms_gateway_id',6, array('label' => 'Gateway','type'=>'select','class'=>'gateway'),array()),
				array('sender_id',6, array('label' => 'Sender ID','type'=>'text','required')),
				array('carrier_name',6, array('type'=>'text')),
				array('template',12, array('type'=>'textarea')),
			)
		)
	));
	
	echo '<div class="modal-footer">';
	echo $this->Form->button('Update', array('id'=>'edit_sms_template','type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start'));
	echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
	echo '</div>';
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_end_modal();
?>

<script>
$(document).ready(function(){
	$(document).on('change','.sms_provider',function(){
		var provider_id = $(this).val();
		var gateway_field = $(this).closest('.row').parent().parent().find('.gateway');
		
		$.ajax({
		  async: false,
		  type: "GET",
		  url: "<?php echo Configure::read('BASE_URL') ?>Settings/get_sms_gateway_api/" + provider_id,
		  dataType: "json",
		  success: function(data){
			  if(data !== null){
				  gateway_field.empty();
				  gateway_field.append('<option value="" >(Choose One)</option>');
				  
				  data.forEach((element) => {
					gateway_field.append('<option value="' + element.value + '" >' + element.name + '</option>');
				  });
				  
				  gateway_field.trigger('change');
			  }else{
				  gateway_field.empty();
				  gateway_field.append('<option value="" >(Choose One)</option>').trigger('change');
			  }

		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
		  },
		});
		
	});
	
	
	
	$(document).on('click','.edit_record',function(e){
		var id = $(this).attr('data-id');
		var data = JSON.parse($(this).closest('tr').find('.update_data').val());
		$('#UpdateSmsTemplateId').val(data['SmsTemplate.id']).trigger('change');
		$('#UpdateSmsTemplateSmsProviderId').val(data['SmsProvider.id']).trigger('change');
		$('#UpdateSmsTemplateCountryCode').val(data['SmsCountry.code']).trigger('change');
		$('#UpdateSmsTemplateSmsGatewayId').val(data['SmsGateway.id']).trigger('change');		
		$('#UpdateSmsTemplateSenderId').val(data['SmsTemplate.sender_id']);
		$('#UpdateSmsTemplateCarrierName').val(data['SmsTemplate.carrier_name']);
		$('#UpdateSmsTemplateTemplate').val(data['SmsTemplate.template']);
	});
	
	
	$('#SmsTemplateAddSmsTemplateForm, #UpdateSmsTemplateEditSmsTemplateForm').on('submit',function(e){
		var submit_button = $(this).find('button[type="submit"]');
		var old_submit_text = submit_button.text();
		
		submit_button.attr('disabled',true);
		submit_button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait...');
		
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
			  submit_button.text(old_submit_text);
			  
			  $('#add_record').modal('hide');
			  $('#edit_record').modal('hide');
			  $('#sms_template').DataTable().ajax.reload( null, false );
		  }
		});
	});
	
});
</script>