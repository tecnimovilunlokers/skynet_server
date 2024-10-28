<?php

echo $this->ModernizeComponent->create_card_container_start('Add Email Templates');
echo $this->Form->create('EmailTemplate');
echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
	array(
		'size' => 12,
		'orientation' => 'vertical',
		'contents' => array(
			array('name',12, array('type'=>'text','required')),
			array('template',12, array('type'=>'textarea')),
		)
	)
));

echo $this->ModernizeComponent->create_form_action_start();
echo $this->Form->button('<i class="fa-regular fa-circle-phone me-2 fs-4"></i> Save',array('type'=>'submit','class'=>'btn btn-success font-medium rounded-pill px-5'));
echo $this->Html->link('<i class="fa-solid fa-circle-chevron-left"></i>&nbsp; Back',$this->request->referer(),array('class'=>'btn btn-danger font-medium rounded-pill px-5','escape'=>false));
echo $this->ModernizeComponent->create_form_action_end();

echo $this->Form->end();


echo ' <div id="summernote"></div>';

echo $this->ModernizeComponent->create_card_container_end();


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
	
	$("#EmailTemplateTemplate").summernote({
		height: 250, // set editor height
		minHeight: null, // set minimum height of editor
		maxHeight: null, // set maximum height of editor
		focus: false, // set focus to editable area after initializing summernote
	});
	
	$('.note-codable').on('blur', function() {
		if ($('#EmailTemplateTemplate').summernote('codeview.isActivated')) {
			$('#EmailTemplateTemplate').summernote('codeview.deactivate');
		}
	});
	
});
</script>