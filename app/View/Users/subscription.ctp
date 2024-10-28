<?php
	echo $this->ModernizeComponent->create_card_container_start('Manage User Subscriptions');
	$model = 'UserSubscription';
	$controller = 'users';
	$action = Inflector::underscore($model);
	echo $this->ModernizeComponent->create_table_view(array(
		'id' => 'user_subscriptions',
		'class' => 'table align-middle text-nowrap',
		'column-headers' => array(
			array('Username' => array()),
			array('Date of Subscription' => array()),
			array('Next Billing Date' => array()),
			array('Days Remaining' => array()),
			array('Status' => array()),
			array('Added By' => array()),
		),
		'table-settings' => array(
			'model' => $model,
			'controller' => $controller,
			'prefix' => false,
			'action' => $action,
			'ajax'=>true,
			'multiselect'=>array(
				'delete',
			),
			'include' => array(
				'search',
				'add' => array('attributes'=>array('href'=>'#', 'data-bs-toggle'=>'modal','data-bs-target'=>'#add_record')),
				'edit'=>array(
					'label'=> '<i class="fs-4 fa-regular fa-circle-question"></i> Extend / Update',
					'attributes'=>array('class'=>'edit_record','href'=>'#','data-bs-toggle'=>'modal','data-bs-target'=>'#edit_record')
				),
				'delete' => array(
					'ajax'=>array(
						'title' => 'Are you sure?',
						'description' => 'You won\'t be able to revert this!!'
					)
				)
			),
			'include_controls' => array(
				'cancel'=>array(
					'ajax' => true,
					'label'=> '<i class="fs-4 fa-regular fa-circle-question"></i> Cancel',
					'on'=>array(
						'field'=>array('UserSubscription.subscription_status'=>'<span class="mb-1 badge bg-success">Active</span>'),
						'operator'=>'equal'
					)
				),
			),
			'search_options' => array(
				array('user_id',12, array('required','type'=>'select','label'=>'User'),$user_list),
				array('subscription_status',12, array('type'=>'select'),array('Active'=>'Active','Cancelled'=>'Cancelled','Expired'=>'Expired')),
			),
			'table-data' => $data ?? array(),
		),
		
	));
	echo $this->ModernizeComponent->create_card_container_end();
	
	
	//add new modal
	echo $this->ModernizeComponent->create_start_modal('add_record','Add Subscription');
	echo $this->Form->create('UserSubscription',array('url'=>array('controller' => 'users', 'action' => 'add_subscription', 'prefix' => false)));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('user_id',12, array('required','type'=>'select','label'=>'User'),$user_list),
				array('subscription',12, array('label' => 'Subscription Date','type'=>'daterange','required')),
			)
		)
	));
	
	echo '<div class="modal-footer">';
	echo $this->Form->button('Add New', array('id'=>'add_submit','type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
	echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
	echo '</div>';
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_end_modal();
	
	//edit modal
	echo $this->ModernizeComponent->create_start_modal('edit_record','Update Subscription');
	echo $this->Form->create('EditUserSubscription',array('url'=>array('controller' => 'users', 'action' => 'edit_subscription', 'prefix' => false)));
	echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
		array(
			'size' => 12,
			'orientation' => 'vertical',
			'contents' => array(
				array('id',12, array('label' => false,'type'=>'hidden','required')),
				array('user_id',12, array('required','type'=>'select','label'=>'User'),$user_list),
				array('subscription',12, array('label' => 'Subscription Date','type'=>'daterange','required')),
			)
		)
	));
	
	echo '<div class="modal-footer">';
	echo $this->Form->button('Update', array('id'=>'edit_submit','type' => 'submit','class'=>'btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply'));
	echo $this->Form->button('Cancel', array('type' => 'button','data-bs-dismiss'=>'modal','class'=>'btn btn-light-danger text-danger font-medium waves-effect text-start'));
	echo '</div>';
	echo $this->Form->end();
	echo $this->ModernizeComponent->create_end_modal();
?>

<script>
$(document).ready(function(){
	
	$('.server_provider').on('change',function(){
		var parent = $(this).parent().parent().parent().parent();
		if($(this).val()!==''){
			var provider_url = $(this).find('option:selected').attr('host');
			var provider_description = $(this).find('option:selected').text();
			
			parent.find('.server_url').val(provider_url);
			parent.find('.server_description').val(provider_description);
		}else{
			parent.find('.server_url').val('');
			parent.find('.server_description').val('');
		}
	});
	
	$(document).on('click','.edit_record',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		var data = JSON.parse($(this).closest('tr').find('.update_data').val());
		console.log(data);
		$('#EditUserSubscriptionId').val(id);
		$('#EditUserSubscriptionUserId').val(data['UserSubscription.user_id']).trigger('change');
		$('#EditUserSubscriptionSubscription').data('daterangepicker').setStartDate(moment(data['UserSubscription.subscription_start'], 'YYYY-MM-DD'));
		$('#EditUserSubscriptionSubscription').data('daterangepicker').setEndDate(moment(data['UserSubscription.subscription_end'], 'YYYY-MM-DD')).trigger('change');
		
	});
	
	$('#UserSubscriptionAddSubscriptionForm, #EditUserSubscriptionEditSubscriptionForm').on('submit',function(e){
		var submit_button = $(this).find('button[type="submit"]');
		var old_submit_text = submit_button.text();
		
		submit_button.attr('disabled',true);
		submit_button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait...');
		
		e.preventDefault();
		$.ajax({
		  type: "POST",
		  url: $(this).attr('action'),
		  data: $(this).serialize(),
		  dataType: "json",
		  success: function(data){
			  if(data.success){
				  swal.fire("Success", data.msg, "success");
			  }else{
				  swal.fire("Error", data.msg, "error");
			  }
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			 swal.fire("Error", 'An error occured, please contact system administrator.', "error");
		  },
		  complete: function(data) {
			  submit_button.removeAttr('disabled');
			  submit_button.text(old_submit_text);
			  
			  $('#add_record').modal('hide');
			  $('#edit_record').modal('hide');
			  $('#user_subscriptions').DataTable().ajax.reload( null, false );
		  }
		});
	});
	
});
</script>