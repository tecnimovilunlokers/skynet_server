<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- --------------------------------------------------- -->
		<!-- Title -->
		<!-- --------------------------------------------------- -->
		<title>NEW SUPPORT</title>
		<!-- --------------------------------------------------- -->
		<!-- Required Meta Tag -->
		<!-- --------------------------------------------------- -->
		<?php echo $this->Html->charset(); ?>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="handheldfriendly" content="true" />
		<meta name="MobileOptimized" content="width" />
		<!-- <meta name="description" content="Mordenize" />
		<meta name="author" content="" />
		<meta name="keywords" content="Mordenize" /> -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<!-- --------------------------------------------------- -->
		<!-- Favicon -->
		<!-- --------------------------------------------------- -->
		<?php
			echo $this->Html->meta(
				'/template/images/logos/favicon.png',
				'/template/images/logos/favicon.png',
				array('type' => 'img/png', 'rel' => 'shortcut icon')
			);
			echo $this->element('head.all.css');
			echo $this->element('head.all.js');
		?>
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader">
			<?=$this->Html->image('/template/images/logos/favicon.png', array('alt' => 'loader', 'class' => 'lds-ripple img-fluid'));?>
		</div>
		
		<!--  Body Wrapper -->
		<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
	
			<?php
				echo $this->Session->flash();
				echo $this->fetch('content');
			?>
		</div>

		<?php
			//preloader
			echo $this->Html->script(array(
				'../template/js/custom',
			));
		?>
	</body>
</html>