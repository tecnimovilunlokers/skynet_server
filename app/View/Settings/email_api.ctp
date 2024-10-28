<?php
	echo $this->ModernizeComponent->create_card_container_start('Email Server');
	$model = 'EmailApi';
	$controller = 'settings';
	$action = Inflector::underscore($model);
	echo $this->ModernizeComponent->create_table_view(array(
		'id'=> 'email_api',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('Host' => array()),
			array('Port' => array()),
			array('Username' => array()),
			array('Password' => array()),
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
				'add'=>array('attributes'=>array('href'=>'#','data-bs-toggle'=>'modal','data-bs-target'=>'#add_record')),
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
						'field'=>array('EmailApi.status'=>'<span class="mb-1 badge bg-success">Active</span>'),
						'operator'=>'equal'
					)
				),
				'enable'=>array(
					'ajax' => true,
					'on'=>array(
						'field'=>array('EmailApi.status'=>'<span class="mb-1 badge bg-danger">Disabled</span>'),
						'operator'=>'equal'
					)
				),
			),
			'search_options' => array(
				array('host',6, array('type' => 'text')),
				array('port',6, array('type' => 'text')),
				array('username',6, array('type' => 'text')),
				array('password',6, array('type' => 'text')),
				array('status',12, array('type'=>'select'),getStatusArray()),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	//add new modal
	echo $this->ModernizeComponent->create_start_modal('add_record','Add Email Server');
	echo $this->Form->create('EmailApi',array('url'=>array('controller' => 'settings', 'action' => 'add_email_api')));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('host',12, array('type'=>'text','required')),
				array('port',12, array('type'=>'number','required')),
				array('username',12, array('type'=>'text','required')),
				array('password',12, array('type'=>'text','required')),
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
	echo $this->ModernizeComponent->create_start_modal('edit_record','Update Email Server');
	echo $this->Form->create('EditEmailApi',array('url'=>array('controller' => 'settings', 'action' => 'edit_email_api', 'prefix' => false)));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('id',12, array('label' => false,'type'=>'hidden','required')),
				array('host',12, array('type'=>'text','required')),
				array('port',12, array('type'=>'number','required')),
				array('username',12, array('type'=>'text','required')),
				array('password',12, array('type'=>'text','required')),
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
	$('#EmailApiAddEmailApiForm').on('submit',function(e){
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
			  $('#email_api').DataTable().ajax.reload( null, false );
		  }
		});
	});
	
	$('#EditEmailApiEditEmailApiForm').on('submit',function(e){
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
			  $('#email_api').DataTable().ajax.reload( null, false );
		  }
		});
	});
	
	$(document).on('click','.edit_record',function(e){
		var id = $(this).attr('data-id');
		var row = $(this).closest('tr');
		
		$('#EditEmailApiId').val(id);
		$('#EditEmailApiHost').val($(row.find('td')[2]).text());
		$('#EditEmailApiPort').val($(row.find('td')[3]).text());
		$('#EditEmailApiUsername').val($(row.find('td')[4]).text());
		$('#EditEmailApiPassword').val($(row.find('td')[5]).text());
	});
	
	
});
</script>