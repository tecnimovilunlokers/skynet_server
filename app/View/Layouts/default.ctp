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
		
		<style>
		.select2-close-mask{
            z-index: 99999;
        }
        .select2-dropdown{
            z-index: 99999;
        }
		</style>
		
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader">
			<?=$this->Html->image('logo.png', array('alt' => 'loader', 'class' => 'lds-ripple img-fluid','style'=>'width: 200px'));?>
		</div>
		<!-- --------------------------------------------------- -->
		<!-- Body Wrapper -->
		<!-- --------------------------------------------------- -->
		
		
		<!-- <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed"> -->
		<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">	
			
			<!-- --------------------------------------------------- -->
			<!-- Sidebar -->
			<!-- --------------------------------------------------- -->
			<aside class="left-sidebar">
				<!-- Sidebar scroll-->
				<div>
					<!-- Sidebar navigation-->
					<?=$this->element('side.navbar');?>
					<!-- End Sidebar navigation -->
				</div>
				<!-- End Sidebar scroll-->
			</aside>
			<!-- --------------------------------------------------- -->
			<!-- Main Wrapper -->
			<!-- --------------------------------------------------- -->
			<div class="body-wrapper">
				<?php
					echo $this->element('body-header');
				?>
				<div class="container-fluid mw-100" >
					<?php
						echo $this->Session->flash();
						echo $this->fetch('content');
					?>
				</div>
			</div>
		</div>
		
		
		<?php
			//preloader
			echo $this->Html->script(array(
				'../template/js/custom',
			));
		?>
	</body>
</html>