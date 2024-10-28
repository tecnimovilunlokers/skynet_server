<?php
	
	echo $this->ModernizeComponent->create_card_container_start('Manual Remove');
	echo $this->Form->create('Autoremove');
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'horizontal',
			'contents' => array(
				array('username',12, array('label'=>'Username or Email','type'=>'text','required')),
				array('password',12, array('label'=>'Password','type'=>'text','required')),
				array('web',12, array('type'=>'select','required'),getSupportedWeb()),
			)
		),
	));
	
	echo $this->ModernizeComponent->create_form_action_start();
	echo $this->Form->submit('Start Remove',array('class'=>'btn btn-success font-medium rounded-pill px-5'));
	echo $this->ModernizeComponent->create_form_action_end();
	
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	echo $this->ModernizeComponent->create_card_container_start('Check Xiaomi Find My');
	echo $this->Form->create('XiaomiCheck');
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'horizontal',
			'contents' => array(
				array('imei',12, array('label'=>'IMEI/Lock Code','type'=>'text','required')),
			)
		),
	));
	
	echo $this->ModernizeComponent->create_form_action_start();
	echo $this->Form->submit('Check',array('class'=>'btn btn-success font-medium rounded-pill px-5'));
	echo $this->ModernizeComponent->create_form_action_end();
	
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_card_container_end();
	

?>

<script>
$(document).ready(function(){
	$('#AutoremoveIndexForm').on('submit',function(e){
		e.preventDefault();
		showLoading('Removing device...');
		
		$.ajax({
		  type: "POST",
		  url: "<?php echo Configure::read('BASE_URL') ?>extras/start_manual_remove",
		  data:  $(this).serialize(),
		  dataType: "json",
		  success: function(data){
			 if(data.success == true){
				 var html = '<div class="row fs-3 m-0">';
				 if(data.device_list.length >=1){
					 html += '<h5>Autoremove Result</h5>';
					 data.device_list.forEach((element) => {
						 if(element.hasOwnProperty('model') && element.model === null){
							 return;
						 }
						 
						 var device_img = "";
						 var img_width = "100%";
						 if (typeof element.device_img !== 'undefined' && element.hasOwnProperty('device_img')) {
								device_img = element.device_img;
								img_width = "35%";
						 }else{
							 device_img = "https://statici.icloud.com/fmipmobile/deviceImages-9.0/" + element.device_type + "/" + element.raw_device_model + "/online-infobox__3x.png";
						 }
						 
						 var status = '<span class="m-0 p-1 badge bg-success">OFF</span>'
						 if(element.msg !== 'Removed'){
							status = '<span class="m-0 p-1 badge bg-danger">Failed</span>' 
						 }
						 
						 html+='<div class="col-md-4 m-0 p-0">';
						 html+='<div class=" h-100">';
						 html+='<img src="'+ device_img +'" class="card-img-top" alt="Thumbnail 2" style="width: ' + img_width + '">';
						 html+='<div class="card-body">';
						 html+='<h5 class="card-title fs-3 fw-bolder">'+ element.model +'</h5>';
						 html+='<ul class="list-unstyled">';
						 // html+='<li>Owner: '+ element.owner_name +'</li>';
						 html+='<li>Passcode: '+ element.passcode_length +'</li>';
						 html+='<li>Status: ' + status + '</li>';
						 html+='</ul>';
						 html+='</div>';
						 html+='</div>';
						 html+='</div>';
					 });
					 
				 }else{
					  html += '<h1>No Devices to Remove.</h1>';
				 }
				 
				 html += '</div>';
				 swal.fire({html: html, showCloseButton: true,confirmButtonText: "Close",});
				 
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
	
	
	
	
	$('#XiaomiCheckIndexForm').on('submit',function(e){
		e.preventDefault();
		showLoading('Checking device...');
		
		$.ajax({
		  type: "POST",
		  url: "<?php echo Configure::read('BASE_URL') ?>extras/xiaomi_check",
		  data:  $(this).serialize(),
		  dataType: "json",
		  success: function(data){
			  if(data.success == true){
				  if(data.data == 'unlocked'){
					  swal.fire("Unlocked", data.msg, "success");
				  }else{
					  swal.fire("Locked", data.msg, "error");
				  }
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
	
	
	
	
	
	
	
});
</script>