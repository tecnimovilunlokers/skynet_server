<!-- --------------------------------------------------- -->
<!-- Header Start -->
<!-- --------------------------------------------------- -->
<header class="app-header">
	<nav class="navbar navbar-expand-lg navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
				<i class="ti ti-menu-2"></i>
				</a>
			</li>
		</ul>
		
		<div class="d-block d-lg-none">
			<?=$this->Html->image('logo.png', array('width' => '180', 'alt' => '', 'class' => 'dark-logo'));?>
		</div>
		<button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="p-2">
		<i class="ti ti-dots fs-7"></i>
		</span>
		</button>
		<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
			<div class="d-flex align-items-center justify-content-between">
				<ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
					
					<?php 
						if($_SESSION['Auth']['User']['role']=='Administrator'){
					?>

					<li class="nav-item">
						<div class="form-check form-switch">
						  <input class="form-check-input" type="checkbox" id="is_maintenance" <?php echo $is_maintenance ? 'checked' : ''; ?> />
						  <label class="form-check-label" for="is_maintenance" >Maintenance</label>
						</div>
					</li>
					
					<?php 
						}
					?>
					
					<li class="nav-item dropdown">
						<a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false" >
							<div class="d-flex align-items-center">
								<div class="user-profile-img">
									<?=$this->Html->image($_SESSION['Auth']['User']['profile_picture'], array('width' => '35', 'height' => '35', 'alt' => '', 'class' => 'rounded-circle'));?>
								</div>
							</div>
						</a>
						<div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
							<div class="profile-dropdown position-relative" data-simplebar>
								<div class="py-3 px-7 pb-0">
									<h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
								</div>
								<div class="d-flex align-items-center py-9 mx-7 border-bottom">
									<?=$this->Html->image($_SESSION['Auth']['User']['profile_picture'], array('width' => '80', 'height' => '80', 'alt' => '', 'class' => 'rounded-circle'));?>
									<div class="ms-3">
										<h5 class="mb-1 fs-3"><?=$_SESSION['Auth']['User']['full_name']?></h5>
										<span class="mb-1 d-block text-dark"></span>
										<p class="mb-0 d-flex text-dark align-items-center gap-2">
											<i class="ti ti-mail fs-4"></i> <?=$_SESSION['Auth']['User']['email']?>
										</p>
										<p class="mb-0 d-flex text-dark align-items-center gap-2">
											<i class="fa-regular fa-suitcase"></i> <?=$_SESSION['Auth']['User']['role']?>
										</p>
									</div>
								</div>
								<div class="message-body">
									<a href="<?=Configure::read('BASE_URL')?>users/account_settings" class="py-8 px-7 mt-8 d-flex align-items-center">
										<span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
										<?=$this->Html->image('/template/images/svgs/icon-account.svg', array('width' => '24', 'height' => '24', 'alt' => ''));?>
										</span>
										<div class="w-75 d-inline-block v-middle ps-3">
											<h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
											<span class="d-block text-dark">Account Settings</span>
										</div>
									</a>
									<a href="<?=Configure::read('BASE_URL')?>calls/history" class="py-8 px-7 d-flex align-items-center">
										<span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
										<?=$this->Html->image('/template/images/svgs/icon-inbox.svg', array('width' => '24', 'height' => '24', 'alt' => ''));?>
										</span>
										<div class="w-75 d-inline-block v-middle ps-3">
											<h6 class="mb-1 bg-hover-primary fw-semibold">Call Histories</h6>
											<span class="d-block text-dark">Calls</span>
										</div>
									</a>
								</div>
								<div class="d-grid py-2 px-7 pt-8">
									<a href="<?=Configure::read('BASE_URL').'users/change_password' ?>" class="btn btn-outline-warning">Change Password</a>
								</div>
								<div class="d-grid pb-4 px-7">
									<a href="<?=Configure::read('BASE_URL').'users/logout' ?>" class="btn btn-outline-primary">Log Out</a>
								</div>
								
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>

<?php 
if($_SESSION['Auth']['User']['role']=='Administrator'){
?>

<script>
$( document ).ready(function() {
	$(document).on('change','#is_maintenance',function(){	
		$.ajax({
		  type: "POST",
		  url: "<?php echo Configure::read('BASE_URL') ?>settings/maintenance",
		  data:  'maintenance=' + $(this).is(':checked'),
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
});	
</script>

<?php 
}
?>