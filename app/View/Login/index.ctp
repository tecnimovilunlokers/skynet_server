<div class="position-relative overflow-hidden radial-gradient min-vh-100">
<div class="position-relative z-index-5">
  <div class="row">
	<div class="col-xl-7 col-xxl-8 login_banner">
	  <a href="<?=Configure::read('BASE_URL')?>login" class="text-nowrap logo-img d-block px-4 py-9 w-100">
		
	  </a>
	  
	  <div class="d-none d-xl-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
		<?php 
		//	echo $this->Html->image(Configure::read('BASE_URL') .'template/images/backgrounds/bg.png', array('class' =>'img-fluid','width'=>'500','alt'=>''));
		?>
	  </div>
	  
	</div>
	<div class="col-xl-5 col-xxl-4">
	  <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
		<div class="col-sm-8 col-md-6 col-xl-9">
		  <h2 class="mb-3 fs-7 fw-bolder text-center">NEW<span class="text-danger">SUPPORT</span></h2>
		  
		  <?php echo $this->Form->create('User');  ?>
			<div class="mb-3">
			  <label for="username" class="form-label">Username</label>
			  <?php 
				echo $this->Form->input('username',array('label'=>false,'div'=>false,'type'=>'text','class'=>'form-control','id'=>'username'));
			  ?>
			</div>
			<div class="mb-4">
			  <label for="password" class="form-label">Password</label>
			  <?php 
				echo $this->Form->input('password',array('label'=>false,'div'=>false,'type'=>'password','class'=>'form-control','id'=>'password'));
			  ?>
			</div>
			<div class="d-flex align-items-center justify-content-between mb-4">
			  <div class="form-check">
				<input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
				<label class="form-check-label text-dark" for="flexCheckChecked">
				  Remeber this Device
				</label>
			  </div>
			 <!-- <a class="text-primary fw-medium" href="./authentication-forgot-password.html">Forgot Password ?</a> -->
			</div>

			<?php echo $this->Form->submit('Sign in',array('class'=>'btn btn-danger w-100 py-8 mb-4 rounded-2')); ?>
			<div class="d-flex align-items-center justify-content-center">
			  <a class="text-primary fw-medium ms-2" href="<?=Configure::read('BASE_URL')?>register">Create an account</a>
			</div>
		  <?php echo $this->Form->end(); ?>
		  
		</div>
	  </div>
	</div>
  </div>
</div>

</div>