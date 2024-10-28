<?php
	$router_url = Router::url('/', true);
	Configure::write('BASE_URL', str_replace('http:','https:',$router_url) );
	Configure::write('autoremove_link', 'https://utoolspro.online/autoremove/autoremove.php');
	
	Configure::write('PAGE_LIMIT',20);
	Configure::write('STATUS', array(
		1 => 'Active',
		0 => 'Disabled'
	));
?>