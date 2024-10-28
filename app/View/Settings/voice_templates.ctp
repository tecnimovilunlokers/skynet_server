<?php
	echo $this->ModernizeComponent->create_card_container_start('Manage Voice Templates');
	$model = 'VoiceTemplate';
	$controller = 'settings';
	$action = Inflector::underscore($model);
	echo $this->ModernizeComponent->create_table_view(array(
		'id' => 'voice_template',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('' => array('style'=>'width: 20px;')),
			array('Name' => array()),
			array('Type' => array()),
			array('Passcode Length' => array()),
			array('Language' => array()),
			array('Voice' => array()),
			array('Before Input' => array()),
			array('After Input' => array()),
			array('No Input' => array()),
			array('Before End Call' => array()),
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
						'field'=>array('VoiceTemplate.status'=>'<span class="mb-1 badge bg-success">Active</span>'),
						'operator'=>'equal'
					)
				),
				'enable'=>array(
					'ajax' => true,
					'on'=>array(
						'field'=>array('VoiceTemplate.status'=>'<span class="mb-1 badge bg-danger">Disabled</span>'),
						'operator'=>'equal'
					)
				),
			),
			'search_options' => array(
				array('name',12, array('label' => 'Name','type' => 'text')),
				array('type',12, array('type' => 'select'),array('passcode'=>'Passcode','info'=>'Info')),
				array('passcode_length',12, array('type' => 'text')),
				array('status',12, array('type'=>'select'),getStatusArray()),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	//add new modal
	echo $this->ModernizeComponent->create_start_modal('add_record','Add Voice Template');
	echo $this->Form->create('VoiceTemplate',array('enctype'=>'multipart/form-data','url'=>array('controller' => 'settings', 'action' => 'add_voice_template', 'prefix' => false)));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('name',12, array('label' => 'Name','required')),
				array('file_path',12, array('label' => 'File','type'=>'file','required')),
				array('type',12, array('type'=>'select','required','class'=>'add_type'),array('passcode'=>'Passcode','info'=>'Info')),
				'<div class="d-none add_passcode">',
				array('passcode_length',12, array('type'=>'select','class'=>'add_passcode_length'),array('4'=>'4 Digit','6'=>'6 Digit')),
				'</div>'
			)
		)
	));
	
	echo '<div class="modal-footer">';
	echo $this->Form->button('Add New', array('type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
	echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
	echo '</div>';
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_end_modal();
	
	//edit modal
	echo $this->ModernizeComponent->create_start_modal('edit_record','Update Voice Template');
	echo $this->Form->create('EditVoiceTemplate',array('enctype'=>'multipart/form-data','url'=>array('controller' => 'settings', 'action' => 'edit_voice_template', 'prefix' => false)));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('id',12, array('label' => false,'type'=>'hidden','required')),
				array('name',12, array('label' => 'Name','required')),
				array('file_path',12, array('label' => 'File','type'=>'file')),
				array('type',12, array('type'=>'select','required','class'=>'add_type'),array('passcode'=>'Passcode','info'=>'Info')),
				'<div class="d-none add_passcode">',
				array('passcode_length',12, array('type'=>'select','class'=>'add_passcode_length'),array('4'=>'4 Digit','6'=>'6 Digit')),
				array('language',12, array('type'=>'select','required','id'=>'language'),$languages),
				array('voice_name',12, array('type'=>'select','required','id'=>'voice_name'),array()),
				array('msg_before_input',12, array('type'=>'test')),
				array('msg_after_input',12, array('type'=>'test')),
				array('msg_no_input',12, array('type'=>'test')),
				array('msg_before_end',12, array('type'=>'test')),
				'</div>'
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
    
    $(document).on('change','#language',function(e){
		var language_code = $(this).val();
		$.ajax({
		  type: "GET",
		  url: "<?php echo Configure::read('BASE_URL') ?>settings/get_language_voices/" + language_code,
		  dataType: "json",
		  success: function(data){
			 $('#voice_name').empty();
			 $.each(data, function(key, value) {
				$('#voice_name').append('<option value="' + value.value + '" >' + value.name + '</option>');
			 });
			 $('#voice_name').trigger('change');
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
		  }
		});
	});
	
	$(document).on('change','.add_type',function(e){
		var main_parent = $(this).parent().parent().parent().parent();
		if($(this).val()=='passcode'){
			main_parent.find('.add_passcode_length').attr('required',true);
			main_parent.find('.add_passcode').removeClass('d-none');
		}else{
			main_parent.find('.add_passcode_length').removeAttr('required');
			main_parent.find('.add_passcode').addClass('d-none');
		}
	});
		
	
	$(document).on('click','.btn-play-voice',function(e){
		stopAll();
		var voice_audio = $(this).parent().find('audio');
		voice_audio[0].currentTime=0;
		voice_audio[0].play();
	});
	
	$(document).on('click','.btn-stop-voice',function(e){
		stopAll();
		var play_button = $(this);
		play_button.attr('class','btn btn-primary rounded-circle btn-sm btn-play-voice');
		play_button.find('i').attr('class','fa-solid fa-play');
	});
	
	
	$('#voice_template').on('draw.dt', function() {
		$('audio').on('playing', function() {
			var play_button = $(this).parent().find('button');
			play_button.attr('class','btn btn-warning rounded-circle btn-sm btn-stop-voice');
			play_button.find('i').attr('class','fas fa-pause');
		});
		
		$('audio').on('ended', function() {
			var play_button = $(this).parent().find('button');
			play_button.attr('class','btn btn-primary rounded-circle btn-sm btn-play-voice');
			play_button.find('i').attr('class','fa-solid fa-play');
		});
	});
	
	
	
	function stopAll(){
		$('audio').each(function(){
			this.pause(); // Stop playing
			this.currentTime = 0; // Reset time
			var play_button = $(this).parent().find('button');
			play_button.attr('class','btn btn-primary rounded-circle btn-sm btn-play-voice');
			play_button.find('i').attr('class','fa-solid fa-play');
		}); 
	
	}
	
	
	
	
	$(document).on('click','.edit_record',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		var row = $(this).closest('tr');
		
		$('#EditVoiceTemplateId').val(id);
		$('#EditVoiceTemplateName').val($(row.find('td')[3]).text());
		$('#EditVoiceTemplateType').val($(row.find('td')[4]).text()).trigger('change');
		$('#EditVoiceTemplatePasscodeLength').val($(row.find('td')[5]).text()).trigger('change');
	});
});
</script>