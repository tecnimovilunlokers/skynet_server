<?php
	echo $this->ModernizeComponent->create_page_header_title('Account Settings','User');
	$this->ModernizeComponent->create_page_container_start('','');
	echo $this->Form->create('User');
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'contents' => array(
				array('username',12, array('required','id'=>'update_username','readonly','disabled')),
				array('email',12, array('type'=>'email','required')),
				array('chat_id',12, array('type'=>'text','required')),
				array('two_factor_enabled', 12,array('type'=>'switch_yes','label'=>'2FA Authentication Enabled')),
				array('telegram_username',12, array('type'=>'text','required'))
			)
		),
	));
	echo '<div class="row pt-4">';
	echo '<div class="col-12 text-center">';
	
    echo '<button type="submit" class="btn btn-success font-medium rounded-pill px-4">
			<div class="d-flex align-items-center">
			  Save
			</div>
		  </button>';
		  
    echo '</div>';
    echo '</div>';
	echo $this->Form->end();
	$this->ModernizeComponent->create_page_container_end();

?>