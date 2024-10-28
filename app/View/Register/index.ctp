<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
<div class="d-flex align-items-center justify-content-center w-100">
  <div class="row justify-content-center w-100">
	<div class="col-md-8 col-lg-6 col-xxl-4">
	  <div class="card mb-0">
		<div class="card-body">
		  <a href="<?=Configure::read('BASE_URL')?>login" class="text-nowrap logo-img text-center d-block mb-5 w-100">
			<?php
				echo $this->Html->image(Configure::read('BASE_URL') .'img/logo.png', array('width'=>'180','alt'=>''));
			?>
		  </a>
			
			<?php
			
			echo $this->Form->create('User');
			echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
				array(
					'size' => 12,
					'orientation' => 'vertical',
					'contents' => array(
						array('username',12, array('required')),
						array('email',12, array('type'=>'email','required')),
						array('chat_id',6, array('type'=>'text','required','label'=> 'Chat ID <small class="text-danger">(@getmyid_bot)</small>')),
						array('telegram_username',6, array('type'=>'text','required')),
						array('password',12, array('type'=>'password','required')),
						array('confirm_password',12, array('type'=>'password','required')),
					)
				)
			));
			echo '<button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign up</button>';
			echo $this->Form->end();
			
			?>
			
			<div class="d-flex align-items-center">
			  <p class="fs-4 mb-0 text-dark">Already have an Account?</p>
			  <a class="text-primary fw-medium ms-2" href="<?=Configure::read('BASE_URL')?>login">Sign In</a>
			</div>
		  
		</div>
	  </div>
	</div>
  </div>
</div>
</div>


<?php

	if(isset($_SESSION['chat_error'])){
		$chat_error = $_SESSION['chat_error'];
		unset($_SESSION["chat_error"]);
		$telegram_username = $chat_error['Setting']['user_bot_username'];
		echo "<script>
			swal.fire({title: 'Unable to register', icon: 'error', html: 'Please goto your telegram find <a href=\"http://t.me/$telegram_username\">@$telegram_username</a><br><b> \"Click Start\".</b>'});
		</script>";
	}
	

?>

<script>
$(document).ready(function(){
	$('#UserIndexForm').on('submit',function(e){
		var submit_button = $(this).find('button[type="submit"]');
		submit_button.attr('disabled',true);
		submit_button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait...');
	});
});
</script>