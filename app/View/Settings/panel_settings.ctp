<?php
	
	echo $this->ModernizeComponent->create_card_container_start('Panel Settings');
	echo $this->Form->create('Setting');
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('id',12, array('label'=>false,'div'=>false,'type'=>'hidden','required')),
				array('generate_cost',6, array('label'=>'Link Generate Price','type'=>'number','required')),
				array('sms_cost',6, array('label'=>'SMS Price','type'=>'number','required')),
				array('voice_cost',6, array('label'=>'Voice Price','type'=>'number','required')),
				array('email_cost',6, array('label'=>'Email Price','type'=>'number','required')),
				array('admin_chat_id',2, array('placeholder'=>'Admin Chat ID','type'=>'text','required')),
				array('admin_telegram_bot',4, array('label'=>'Admin Token <small class="text-danger">(Reporting login,signup, bots)</small>','type'=>'text','required')),
				array('user_telegram_bot',6, array('label'=>'Users Bot Token <small class="text-danger">(For user notification)</small>','type'=>'text','required')),
				array('map_api_key',6, array('type'=>'text','required')),
				array('panel_domain',6, array('label'=>'Panel Domain <small class="text-danger">(Dont include http:// or https:// or www.)</small>','placeholder'=>'unlockpro.online','type'=>'text')),
				array('maintenance', 2,array('type'=>'switch_yes')),
				array('sms_maintenance', 2,array('type'=>'switch_yes','class'=>'maintenance')),
				array('voice_maintenance', 2,array('type'=>'switch_yes','class'=>'maintenance')),
				array('email_maintenance', 2,array('type'=>'switch_yes','class'=>'maintenance')),
				array('enable_signup', 2,array('type'=>'switch_yes')),
				array('antibots', 2,array('label'=>'Enable Antibots','type'=>'switch_yes')),
			)
		),
	));
	
	echo $this->ModernizeComponent->create_form_action_start();
	echo $this->Form->submit('Update Settings',array('class'=>'btn btn-success font-medium rounded-pill px-5'));
	echo $this->ModernizeComponent->create_form_action_end();
	
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_card_container_end();

?>

<script>
$(document).ready(function(){
	$('#SettingMaintenance').on('change',function(){
		var checked = $(this).prop('checked');
		$('.maintenance').prop('checked',checked).trigger('change');
	});
});
</script>