<div class="row">
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-success shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-regular fa-link-horizontal text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">
				Link Credits
				<?php
					if($_SESSION['Auth']['User']['role']!=='Administrator' && $subscription_status == 'Active'){
						$desc = "$subscription_days day remaining";
						if($subscription_days > 1){
							$desc = "$subscription_days days remaining";
						}
						echo "<br><small class=\"text-muted\">$subscription_end</small>";
						echo "<br><small class=\"text-muted\">$desc</small>";
					}
				?>
			</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$link_credits?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>

	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-success shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-comment-sms text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">SMS Credits</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$sms_credits?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-success shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-phone-volume text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Voice Credits</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$voice_credits?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-success shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-at text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Email Credits</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$email_credits?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>

<div class="row">
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-info shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-regular fa-cart-shopping text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Orders</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_orders?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>


	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-info shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-clock text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Pending</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_pending?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-info shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-location-dot text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Visited</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_visit?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-success shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-lock-open text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Unlocked<br><span class="text-muted">Accuracy: <?=$accuracy?>%</span></h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_unlocked?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>

<div class="row">
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-secondary shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-regular fa-key text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Passcode</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_passcode?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-secondary shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-envelope text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total SMS</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_sms?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-secondary shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-phone-office text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Calls</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_calls?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-secondary shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-mailbox text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Emails</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_emails?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
</div>
	
<?php
	if($_SESSION['Auth']['User']['role']=='Administrator'){
?>	
	
<div class="row">
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-danger shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-credit-card text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">User Credits</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_user_credits?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-danger shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-credit-card text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">User SMS Credits&nbsp;</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_user_sms_credits?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-danger shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-credit-card text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">User Call Credits&nbsp;&nbsp;&nbsp;</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_user_call_credits?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-3">
	  <div class="card bg-light-danger shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-credit-card text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">User Email Credits&nbsp;</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$total_user_email_credits?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6 col-xl-4">
	  <div class="card bg-light-danger shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-users text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Users</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$active_users?>/<?=$total_users?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-4">
	  <div class="card bg-light-danger shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-earth-americas text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Domain</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$active_domains?>/<?=$total_domains?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-4">
	  <div class="card bg-light-danger shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-code text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Scripts</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$active_scripts?>/<?=$total_scripts?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>

<div class="row">
	
	
	
	
	<div class="col-sm-6 col-xl-4">
	  <div class="card bg-light-danger shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-server text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total SMS Server</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$active_sms_server?>/<?=$total_sms_server?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-4">
	  <div class="card bg-light-danger shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-server text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Voice Server&nbsp;&nbsp;</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$active_voice_server?>/<?=$total_voice_server?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-6 col-xl-4">
	  <div class="card bg-light-danger shadow-none">
		<div class="card-body p-4">
		  <div class="d-flex align-items-center">
			<div class="round rounded bg-primary d-flex align-items-center justify-content-center">
			  <i class="fa-light fa-server text-white fs-7"></i>
			</div>
			<h6 class="mb-0 ms-3">Total Email Server&nbsp;&nbsp;</h6>
			<div class="ms-auto text-primary d-flex align-items-center">
			  <h3 class="mb-0 fw-semibold fs-7"><?=$active_email_server?>/<?=$total_email_server?></h3>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	
</div>


<?php } ?>

