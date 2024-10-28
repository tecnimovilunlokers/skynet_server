
<?php
	$input_group = array(
		array('phone_number', array('div'=>false,'type'=>'phone')),
		array('buttoname',array('type'=>'button','value'=>'Check Network!','class'=>'btn btn-outline-secondary')),
	);
	
	echo $this->ModernizeComponent->create_page_header_title('Voice Call','Order');
	echo $this->ModernizeComponent->create_card_container_start('<i class="fa-regular fa-circle-phone fs-5"></i> &nbsp;Voice Call');
	echo $this->Form->create('Call');
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'horizontal',
			'contents' => array(
				array('server_id', 12,array('label' => 'Voice Server','required','type'=>'select'),$server_list),
				array('phone_number', 12,array('required','type'=>'input_group'),$input_group),
				array('template', 12,array('label' => 'Voice Template','required','type'=>'select'),$template_list),
			)
		),
		
	));
	
	echo $this->ModernizeComponent->create_form_action_start();
	echo $this->Form->button('<i class="fa-regular fa-circle-phone me-2 fs-4"></i> Start Call',array('type'=>'submit','class'=>'btn btn-success font-medium rounded-pill px-5'));
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
<script>
$(document).ready(function(){
	 
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
			  url: "<?php echo Configure::read('BASE_URL') ?>calls/start_call",
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
	  
	  
	  function update_call_status(sid){
		$.ajax({
		  type: "POST",
		  url: "<?php echo Configure::read('BASE_URL') ?>calls/get_realtime_call_status",
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
						icon = "fa-thin fa-circle-phone fa-shake";
						hstatus = 'Ringing';
					}else if(call_status=='in-progress'){
						icon = "text-navy fa-sharp fa-solid fa-phone-volume";
						hstatus = 'Answered';
					}else if(call_status=='busy'){
						icon = "text-danger fa-solid fa-phone-rotary";
						hstatus = 'Busy';
					}else if(call_status=='no-answer'){
						icon = "text-danger fa-solid fa-phone-rotary";
						hstatus = 'No Answer';
					}else if(call_status=='failed'){
						icon = "text-danger fa-solid fa-phone-rotary";
						hstatus = 'Call Failed';
					}else{
						icon = "text-danger fa-solid fa-phone-rotary";
					}
					
					$('.result_container').html('<div class="text-center"> <i class="' + icon + '" style="font-size:150px"></i> <br> <br> <h4> <p>Status: <span id="call_status">-</span></p> <p>Phone: <span id="dial_number">+-</span></p> <p>Response: <span id="dial_response">-</span></p> </h4> </div>');
					$('#call_status').html(hstatus);
					$('#dial_number').html(number);
					$('#dial_response').html(response);
					
					if(call_status=='busy' || call_status=='no-answer' || call_status=='failed' || call_status=='completed'){
						
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
				  clearInterval(call_update_interval);
				  swal.fire("Error", data.msg, "error").then(function () {
					$('#myModal').modal('hide');
				  });
			  }else{
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
	  
	  
	  
	  
	  
	  
	  
});
</script>