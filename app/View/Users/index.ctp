<?php
	$model = 'User';
	$controller = 'users';
	$action = Inflector::underscore($model);
	
	echo $this->ModernizeComponent->create_card_container_start('Manage Users');
	echo $this->ModernizeComponent->create_table_view(array(
		// 'id' => 'users-table',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('Username' => array()),
			array('Link Credits' => array()),
			array('SMS Credits' => array()),
			array('Voice Credits' => array()),
			array('Email Credits' => array()),
			array('Last Login' => array()),
			array('Telegram Username' => array()),
			array('Chat ID' => array()),
			array('Role' => array()),
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
				'delete',
			),
			'include_controls' => array(
				'disable'=>array(
					'ajax' => true,
					'on'=>array(
						'field'=>array('User.status'=>'<span class="mb-1 badge bg-success">Active</span>'),
						'operator'=>'equal'
					)
				),
				'enable'=>array(
					'ajax' => true,
					'on'=>array(
						'field'=>array('User.status'=>'<span class="mb-1 badge bg-danger">Disabled</span>'),
						'operator'=>'equal'
					)
				),
			),
			'search_options' => array(
				array('username',6, array('required')),
				array('email',6, array('type'=>'email')),
				array('telegram_username',6, array('type'=>'text')),
				array('chat_id',6, array('type'=>'text')),
				array('role', 6,array('required','type'=>'select'),$roles),
				array('status',6, array('type'=>'select'),getStatusArray()),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
	//add new users
	echo $this->ModernizeComponent->create_start_modal('add_record','Add New User');
	echo $this->Form->create('User',array('url'=>array('controller' => 'users', 'action' => 'add_user', 'prefix' => false)));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('username',6, array('required')),
				array('email',6, array('type'=>'email','required')),
				array('telegram_username',6, array('type'=>'text','required')),
				array('chat_id',6, array('type'=>'text','required')),
				array('link_credits',6, array('type'=>'text','required')),
				array('sms_credits',6, array('type'=>'text','required')),
				array('voice_credits',6, array('type'=>'text','required')),
				array('email_credits',6, array('type'=>'text','required')),
				array('password',6, array('type'=>'password','required')),
				array('confirm_password',6, array('type'=>'password','required')),
				array('role', 12,array('required','type'=>'select'),$roles),
			)
		)
	));
	
	echo '<div class="modal-footer">';
	echo $this->Form->button('Save', array('type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
	echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
	echo '</div>';
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_end_modal();
	
	//edit modal
	echo $this->ModernizeComponent->create_start_modal('edit_record','Update User');
	echo $this->Form->create('User',array('url'=>array('controller' => 'users', 'action' => 'edit_user', 'prefix' => false)));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('username',6, array('required','id'=>'update_username','readonly','disabled')),
				array('email',6, array('type'=>'email','required','id'=>'update_email')),
				array('telegram_username',6, array('type'=>'text','required','id'=>'update_telegram_username')),
				array('chat_id',6, array('type'=>'text','required','id'=>'update_chat_id')),
				array('link_credits',6, array('type'=>'text','required','id'=>'update_credits')),
				array('sms_credits',6, array('type'=>'text','required','id'=>'update_sms_credits')),
				array('voice_credits',6, array('type'=>'text','required','id'=>'update_voice_credits')),
				array('email_credits',6, array('type'=>'text','required','id'=>'update_email_credits')),
				array('role', 6,array('required','type'=>'select','id'=>'update_role'),$roles),
				array('password',6, array('placeholder'=>'Leave blank if unchange','required'=>false)),
				array('id',6, array('label'=>false,'div'=>false,'type'=>'hidden','required','id'=>'update_id')),
			)
		),
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
		var data = $(row.find('td'));
		
		$('#update_id').val(id);
		$('#update_username').val($(data[2]).find('.user-name').html());
		$('#update_email').val($(data[2]).find('.user-work').html());
		
		$('#update_credits').val($(data[3]).text());
		$('#update_sms_credits').val($(data[4]).text());
		$('#update_voice_credits').val($(data[5]).text());
		$('#update_email_credits').val($(data[6]).text());
		
		$('#update_telegram_username').val($(data[8]).text());
		$('#update_chat_id').val($(data[9]).text());
		$('#update_role').val($(data[10]).text()).trigger('change');
	});
});
</script>