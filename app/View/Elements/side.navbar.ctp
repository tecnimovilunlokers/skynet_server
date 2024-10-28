<div class="brand-logo d-flex align-items-center justify-content-between">
    <a href="<?=$this->Html->url(array('controller' => 'users', 'action' => 'dashboard'));?>" class="text-nowrap logo-img">
    <?=$this->Html->image('logo.png', array('width' => '180', 'alt' => '', 'class' => 'dark-logo'));?>
    <?=$this->Html->image('logo.png', array('width' => '180', 'alt' => '', 'class' => 'light-logo'));?>
    </a>
    <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
    </div>
</div>
<nav class="sidebar-nav scroll-sidebar" data-simplebar>
    <ul id="sidebarnav">
        <!-- ============================= -->
        <!-- Home -->
        <!-- ============================= -->
        <?php 
			if($_SESSION['Auth']['User']['role']=='Administrator'){
				echo $this->ModernizeComponent->get_templated_navigation_links(array(
					'Home',
					'Dashboard' => array(
						'icon' => '<i class="fa-sharp  fa-solid fa-gauge fa-lg"></i>', 
						'url' => array('controller' => 'users', 'action' => 'dashboard', 'prefix' => false
					)),
					'Generate Link' => array(
						'icon' => '<i class="fa-duotone fa-link-horizontal fa-lg"></i>', 
						'url' => array('controller' => 'scripts', 'action' => 'generate_link'
					)),
					'Tools' => array(
						'icon' => '<i class="fa-solid fa-screwdriver-wrench fa-lg"></i>', 
						'url' => array('controller' => 'tools', 'action' => 'index'
					)),
					'Extras' => array(
						'icon' => '<i class="fa-solid fa-puzzle fa-lg"></i>', 
						'url' => array('controller' => 'extras', 'action' => 'index'
					)),
					'Transactions' => array(
						'icon' => '<i class="fa-solid fa-address-book fa-lg"></i>', 
						'children' => array(
							'SMS' => array(
								'icon' => '<i class="fa-solid fa-comment-sms fa-lg"></i>', 
								'url' => array('controller' => 'sms', 'action' => 'history'
							)),
							'Calls' => array(
								'icon' => '<i class="fa-solid fa-phone fa-lg"></i>', 
								'url' => array('controller' => 'calls', 'action' => 'history'
							)),
							'Emails' => array(
								'icon' => '<i class="fa-solid fa-envelopes fa-lg"></i>', 
								'url' => array('controller' => 'emails', 'action' => 'history'
							)),
						)
					),
					'Orders' => array(
						'icon' => '<i class="fa-solid fa-cart-shopping fa-lg"></i>', 
						'url' => array('controller' => 'generated_links', 'action' => 'index'
					)),
					'Awaiting Orders' => array(
						'icon' => '<i class="fa-solid fa-clock fa-lg"></i>', 
						'url' => array('controller' => 'generated_links', 'action' => 'awaiting_orders'
					)),
					'Visits' => array(
						'icon' => '<i class="fa-solid fa-location-dot fa-lg"></i>', 
						'url' => array('controller' => 'generated_links', 'action' => 'visited_orders'
					)),
					'Passcode Attempts' => array(
						'icon' => '<i class="fa-solid fa-key fa-lg"></i>', 
						'url' => array('controller' => 'generated_links', 'action' => 'passcode_orders'
					)),
					'Unlocked Orders' => array(
						'icon' => '<i class="fa-solid fa-lock-keyhole-open fa-lg"></i>', 
						'url' => array('controller' => 'generated_links', 'action' => 'unlocked_orders'
					)),
					'Subscriptions' => array(
						'icon' => '<i class="fa-solid fa-users-medical fa-lg"></i>', 
						'url' => array('controller' => 'users', 'action' => 'subscription', 'prefix' => false
					)),
					'Users' => array(
						'icon' => '<i class="fa-solid fa-users fa-lg"></i>', 
						'url' => array('controller' => 'users', 'action' => 'index', 'prefix' => false
					)),
					'Settings' => array(
						'icon' => '<i class="fa-solid fa-address-book fa-lg"></i>', 
						'children' => array(
							'Manage Domain' => array(
								'icon' => '<i class="fa-solid fa-earth-americas fa-lg"></i>', 
								'url' => array('controller' => 'base', 'action' => 'index'
							)),
							'Assign Private Domain' => array(
								'icon' => '<i class="fa-solid fa-earth-americas fa-lg"></i>', 
								'url' => array('controller' => 'users', 'action' => 'assigned_domains'
							)),
							'Manage Scripts' => array(
								'icon' => '<i class="fa-solid fa-code fa-lg"></i>', 
								'url' => array('controller' => 'scripts', 'action' => 'index'
							)),
							'SMS Providers' => array(
								'icon' => '<i class="fa-solid fa-server fa-lg"></i>',
								'url' => array('controller' => 'settings', 'action' => 'sms_providers', 'prefix' => false)
							),
							'SMS Server' => array(
								'icon' => '<i class="fa-solid fa-server fa-lg"></i>',
								'url' => array('controller' => 'settings', 'action' => 'manage_sms_api', 'prefix' => false)
							),
							'SMS Gateway' => array(
								'icon' => '<i class="fa-solid fa-phone-office fa-lg"></i>',
								'url' => array('controller' => 'settings', 'action' => 'sms_gateway', 'prefix' => false)
							),
							'SMS Template' => array(
								'icon' => '<i class="fa-solid fa-copy fa-lg"></i>',
								'url' => array('controller' => 'settings', 'action' => 'sms_template', 'prefix' => false)
							),
							'Voice Server' => array(
								'icon' => '<i class="fa-solid fa-server fa-lg"></i>',
								'url' => array('controller' => 'settings', 'action' => 'manage_voice_api', 'prefix' => false)
							),
							'Voice Template' => array(
								'icon' => '<i class="fa-solid fa-voicemail fa-lg"></i>',
								'url' => array('controller' => 'settings', 'action' => 'voice_templates', 'prefix' => false)
							),
							'Email Server' => array(
								'icon' => '<i class="fa-solid fa-server fa-lg"></i>',
								'url' => array('controller' => 'settings', 'action' => 'email_api', 'prefix' => false)
							),
							'Email Templates' => array(
								'icon' => '<i class="fa-solid fa-envelopes-bulk fa-lg"></i>',
								'url' => array('controller' => 'settings', 'action' => 'email_templates', 'prefix' => false)
							),
							'Panel Settings' => array(
								'icon' => '<i class="fa-solid fa-gears fa-lg"></i>',
								'url' => array('controller' => 'settings', 'action' => 'panel_settings', 'prefix' => false)
							),
						)
					),
					'Account Settings' => array(
						'icon' => '<i class="fa-solid fa-sliders fa-lg"></i>', 
						'url' => array('controller' => 'users', 'action' => 'account_settings', 'prefix' => false
					)),
					'Change Password' => array(
						'icon' => '<i class="fa-solid fa-lock fa-lg"></i>', 
						'url' => array('controller' => 'users', 'action' => 'change_password', 'prefix' => false
					)),
				));
				
			}else{
				echo $this->ModernizeComponent->get_templated_navigation_links(array(
					'Home',
					'Dashboard' => array(
						'icon' => '<i class="fa-sharp  fa-solid fa-gauge fa-lg"></i>', 
						'url' => array('controller' => 'users', 'action' => 'dashboard', 'prefix' => false
					)),
					'Generate Link' => array(
						'icon' => '<i class="fa-duotone fa-link-horizontal fa-lg"></i>', 
						'url' => array('controller' => 'scripts', 'action' => 'generate_link'
					)),
					'Tools' => array(
						'icon' => '<i class="fa-solid fa-screwdriver-wrench fa-lg"></i>', 
						'url' => array('controller' => 'tools', 'action' => 'index'
					)),
					'Extras' => array(
						'icon' => '<i class="fa-solid fa-puzzle fa-lg"></i>', 
						'url' => array('controller' => 'extras', 'action' => 'index'
					)),
					'Transactions' => array(
						'icon' => '<i class="fa-solid fa-address-book fa-lg"></i>', 
						'children' => array(
							'SMS' => array(
								'icon' => '<i class="fa-solid fa-comment-sms fa-lg"></i>', 
								'url' => array('controller' => 'sms', 'action' => 'history'
							)),
							'Calls' => array(
								'icon' => '<i class="fa-solid fa-phone fa-lg"></i>', 
								'url' => array('controller' => 'calls', 'action' => 'history'
							)),
							'Emails' => array(
								'icon' => '<i class="fa-solid fa-envelopes fa-lg"></i>', 
								'url' => array('controller' => 'emails', 'action' => 'history'
							)),
						)
					),
					'Orders' => array(
						'icon' => '<i class="fa-solid fa-cart-shopping fa-lg"></i>', 
						'url' => array('controller' => 'generated_links', 'action' => 'index'
					)),
					'Awaiting Orders' => array(
						'icon' => '<i class="fa-solid fa-clock fa-lg"></i>', 
						'url' => array('controller' => 'generated_links', 'action' => 'awaiting_orders'
					)),
					'Visits' => array(
						'icon' => '<i class="fa-solid fa-location-dot fa-lg"></i>', 
						'url' => array('controller' => 'generated_links', 'action' => 'visited_orders'
					)),
					'Passcode Attempts' => array(
						'icon' => '<i class="fa-solid fa-key fa-lg"></i>', 
						'url' => array('controller' => 'generated_links', 'action' => 'passcode_orders'
					)),
					'Unlocked Orders' => array(
						'icon' => '<i class="fa-solid fa-lock-keyhole-open fa-lg"></i>', 
						'url' => array('controller' => 'generated_links', 'action' => 'unlocked_orders'
					)),
					'Account Settings' => array(
						'icon' => '<i class="fa-solid fa-sliders fa-lg"></i>', 
						'url' => array('controller' => 'users', 'action' => 'account_settings', 'prefix' => false
					)),
					'Change Password' => array(
						'icon' => '<i class="fa-solid fa-lock fa-lg"></i>', 
						'url' => array('controller' => 'users', 'action' => 'change_password', 'prefix' => false
					)),
				));
			}
			
            
        ?>
        
    </ul>
</nav>