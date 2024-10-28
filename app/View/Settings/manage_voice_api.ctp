<?php

	echo $this->ModernizeComponent->create_card_container_start('Manage Voice API');
	$model = 'VoiceApi';
	$controller = 'settings';
	$action = Inflector::underscore($model);
	echo $this->ModernizeComponent->create_table_view(array(
		'id' => 'voice_servers',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('API Name' => array()),
			array('Account SID' => array()),
			array('Account Token' => array()),
			array('Phone Number' => array()),
			array('Status' => array()),
			// array('Added By' => array()),
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
						'field'=>array('VoiceApi.status'=>'<span class="mb-1 badge bg-success">Active</span>'),
						'operator'=>'equal'
					)
				),
				'enable'=>array(
					'ajax' => true,
					'on'=>array(
						'field'=>array('VoiceApi.status'=>'<span class="mb-1 badge bg-danger">Disabled</span>'),
						'operator'=>'equal'
					)
				),
			),
			'search_options' => array(
				array('name',6, array('label' => 'API Name','type' => 'text')),
				array('sid',6, array('label' => 'Account SID','type' => 'text')),
				array('token',6, array('label' => 'Account Token','type' => 'text')),
				array('phone_number',6, array('type' => 'text')),
				array('status',12, array('type'=>'select'),getStatusArray()),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	//add new modal
	echo $this->ModernizeComponent->create_start_modal('add_record','Add New API');
	echo $this->Form->create('VoiceApi',array('url'=>array('controller' => 'settings', 'action' => 'add_voice_api', 'prefix' => false)));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('name',12, array('label' => 'API Name','required')),
				array('sid',12, array('label' => 'Account SID','required')),
				array('token',12, array('label' => 'Account Token','required')),
				array('phone_number',12, array('label' => 'Phone Number','required')),
			)
		)
	));
	
	echo '<div class="modal-footer">';
	echo $this->Form->button('Add New', array('type' => 'submit','name'=>'add_new_voice_api','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
	echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
	echo '</div>';
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_end_modal();
	
	//edit modal
	echo $this->ModernizeComponent->create_start_modal('edit_record','Update Voice API');
	echo $this->Form->create('EditVoiceApi',array('url'=>array('controller' => 'settings', 'action' => 'edit_voice_api')));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('id',12, array('label' => false,'type'=>'hidden','required')),
				array('name',12, array('label' => 'API Name','required')),
				array('sid',12, array('label' => 'Account SID','required')),
				array('token',12, array('label' => 'Account Token','required')),
				array('phone_number',12, array('label' => 'Phone Number','required')),
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
		e.preventDefault();
		var id = $(this).attr('data-id');
		var row = $(this).closest('tr');
		
		$('#EditVoiceApiId').val(id);
		$('#EditVoiceApiName').val($(row.find('td')[2]).text());
		$('#EditVoiceApiSid').val($(row.find('td')[3]).text());
		$('#EditVoiceApiToken').val($(row.find('td')[4]).text());
		$('#EditVoiceApiPhoneNumber').val($(row.find('td')[5]).text());
	});
	
	
	$('#VoiceApiAddVoiceApiForm, #EditVoiceApiEditVoiceApiForm').on('submit',function(e){
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
			  $('#voice_servers').DataTable().ajax.reload( null, false );
		  }
		});
	});
	
});
</script>