<?php
	echo $this->ModernizeComponent->create_page_header_title('Change Password','User');
	$this->ModernizeComponent->create_page_container_start('','');
	echo $this->Form->create('User');
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'horizontal',
			'contents' => array(
				array('current_password',12, array('type'=>'password','required')),
				array('new_password',12, array('type'=>'password','required')),
				array('repeat_new_password',12, array('type'=>'password','required'))
			)
		),
	));
	
	echo $this->ModernizeComponent->create_form_action_start();
	echo $this->Form->submit('Change password',array('class'=>'btn btn-success font-medium rounded-pill px-5'));
	echo $this->ModernizeComponent->create_form_action_end();
	
	echo $this->Form->end();
	$this->ModernizeComponent->create_page_container_end();

?>