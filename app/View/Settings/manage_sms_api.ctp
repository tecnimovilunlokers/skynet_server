<?php
	echo $this->ModernizeComponent->create_card_container_start('Manage SMS Server');
	$model = 'SmsApi';
	$controller = 'settings';
	$action = Inflector::underscore($model);
	echo $this->ModernizeComponent->create_table_view(array(
		'id' => 'sms_servers',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('API Name' => array()),
			array('Provider' => array()),
			array('Balance' => array()),
			array('API URL' => array()),
			array('Username' => array()),
			array('Password' => array()),
			array('API Key' => array()),
			array('API Token' => array()),
			array('API ID' => array()),
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
						'field'=>array('SmsApi.status_desc'=>'<span class="mb-1 badge bg-success">Active</span>'),
						'operator'=>'equal'
					)
				),
				'enable'=>array(
					'ajax' => true,
					'on'=>array(
						'field'=>array('SmsApi.status_desc'=>'<span class="mb-1 badge bg-danger">Disabled</span>'),
						'operator'=>'equal'
					)
				),
			),
			'search_options' => array(
				array('provider',6, array('type'=>'select','class'=>'server_provider'),$sms_provider),
				array('name',6, array('label' => 'API Name','type' => 'text')),
				array('url',12, array('label' => 'API URL','type' => 'text','class'=>'server_url form-control')),
				array('username',6, array('type' => 'text')),
				array('password',6, array('type' => 'text')),
				array('status',12, array('type'=>'select'),getStatusArray()),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	//add new modal
	echo $this->ModernizeComponent->create_start_modal('add_record','Add New API');
	echo $this->Form->create('SmsApi',array('url'=>array('controller' => 'settings', 'action' => 'add_sms_api', 'prefix' => false)));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('sms_provider_id',6, array('required','type'=>'select','class'=>'server_provider'),$sms_provider),
				array('name',6, array('label' => 'API Name','required')),
				array('url',12, array('label' => 'URL','required','class'=>'server_url form-control','readonly','disabled')),
				array('username',6, array('required')),
				array('password',6, array('required','type'=>'text')),
			)
		)
	));
	
	echo '<div class="modal-footer">';
	echo $this->Form->button('Add New', array('id'=>'add_submit','type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
	echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
	echo '</div>';
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_end_modal();
	
	//edit modal
	echo $this->ModernizeComponent->create_start_modal('edit_record','Update SMS API');
	echo $this->Form->create('EditSmsApi',array('url'=>array('controller' => 'settings', 'action' => 'edit_sms_api', 'prefix' => false)));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('id',12, array('label' => false,'type'=>'hidden','required')),
				array('sms_provider_id',6, array('required','type'=>'select','class'=>'server_provider'),$sms_provider),
				array('name',6, array('label' => 'API Name','required')),
				array('url',12, array('label' => 'URL','required','class'=>'server_url form-control','readonly','disabled')),
				array('username',6, array('required')),
				array('password',6, array('required','type'=>'text')),
			)
		)
	));
	
	echo '<div class="modal-footer">';
	echo $this->Form->button('Update', array('id'=>'edit_submit','type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
	echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
	echo '</div>';
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_end_modal();
?>

<script>
$(document).ready(function(){
	
	$('.server_provider').on('change',function(){
		var parent = $(this).parent().parent().parent().parent();
		if($(this).val()!==''){
			var provider_url = $(this).find('option:selected').attr('host');
			var provider_description = $(this).find('option:selected').text();
			
			parent.find('.server_url').val(provider_url);
			parent.find('.server_description').val(provider_description);
		}else{
			parent.find('.server_url').val('');
			parent.find('.server_description').val('');
		}
	});
	
	$(document).on('click','.edit_record',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		var data = JSON.parse($(this).closest('tr').find('.update_data').val());
		
		$('#EditSmsApiId').val(id);
		$('#EditSmsApiSmsProviderId').val(data['SmsProvider.id']).trigger('change');
		$('#EditSmsApiName').val(data['SmsApi.name']);
		$('#EditSmsApiDescription').val(data['SmsApi.description']);
		$('#EditSmsApiUrl').val(data['SmsProvider.url']);
		$('#EditSmsApiUsername').val(data['SmsApi.username']);
		$('#EditSmsApiPassword').val(data['SmsApi.password']);

	});
	
	$('#SmsApiAddSmsApiForm, #EditSmsApiEditSmsApiForm').on('submit',function(e){
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
			  $('#sms_servers').DataTable().ajax.reload( null, false );
		  }
		});
	});
	
	
});
</script>