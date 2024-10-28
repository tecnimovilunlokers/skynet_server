<?php
	echo $this->ModernizeComponent->create_card_container_start('Test Title');
	echo $this->Form->create('Setting');
	
	$checklist = array(
		array('value'=>'1','name'=>'Ranz','class'=>'form-check-input'),
		array('value'=>'2','name'=>'Zyrus','class'=>'form-check-input'),
		array('value'=>'3','name'=>'Matt','class'=>'form-check-input'),
		array('value'=>'4','name'=>'Adam','class'=>'form-check-input'),
	);
	
	$input_group = array(
		array('textname', array('div'=>false,'type'=>'text','class'=>'form-control')),
		array('buttoname',array('type'=>'button','value'=>'Go!','class'=>'btn btn-outline-secondary')),
	);
	
	echo $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size'=>12,
			'orientation'=>'horizontal',
			'contents'=>array(
				array('text',12, array('class'=>'form-control is-valid')),
				array('file',12, array('type'=>'file')),
				array('phone',12, array('type'=>'phone')),
				array('password',12, array('type'=>'password')),
				array('select',12, array('type'=>'select'),$checklist),
				array('number',12, array('type'=>'number')),
				array('date',12, array('type'=>'date')),
				array('daterange',12, array('type'=>'daterange')),
				array('checkbox',12, array('type'=>'checkbox','class'=>'')),
				array('radiolist',12, array('type'=>'radiolist','class'=>'asd'),$checklist),
				array('checklist',12, array('type'=>'checklist','class'=>'form-check-inline'),$checklist),
				array('input_group',12, array('type'=>'input_group'),$input_group),
			)
		),
	));
	
	echo $this->ModernizeComponent->create_form_action_start();
	echo $this->Form->submit('Submit',array('class'=>'btn btn-success font-medium rounded-pill px-5'));
	echo $this->Html->link('Cancel',array('controller'=>'','action'=>''),array('class'=>'btn btn-warning font-medium rounded-pill px-5'));
	echo $this->ModernizeComponent->create_form_action_end();
	
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_card_container_end();

?>