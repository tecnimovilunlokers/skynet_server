var checked_table_data = [];

function checked_table_counter(parent_table){
	var table_id = $(parent_table).attr('id');
	if(checked_table_data.hasOwnProperty(table_id)){
		var checked_count = Object.keys(checked_table_data[table_id]).length;
		parent_table.closest('.table-responsive').parent().find('.selected-table-count').html(checked_count);
	}else{
		parent_table.closest('.table-responsive').parent().find('.selected-table-count').html(0);
	}
}

$(document).ready(function() {
	
	$(document).on('change','table tbody tr td:first-child input[type="checkbox"]',function(){
		var parent_table = $(this).closest('table');
		// checked_record_counter(parent_table);
		var table_id = $(parent_table).attr('id');
		
		var checkbox_id = $(this).attr('data-id');
		var checkbox_state = $(this).prop("checked");
		
		
		if(checkbox_state){
			var new_checked_table_data = {};
			new_checked_table_data[table_id] = {};
			new_checked_table_data[table_id][checkbox_id] = checkbox_state;
			
			if (checked_table_data.hasOwnProperty(table_id) == false) {
				checked_table_data[table_id] = {};
				checked_table_data[table_id][checkbox_id] = checkbox_state;
			}else{
				//merge checked_table_data values and new_checked_table_data values
				checked_table_data[table_id] = $.extend({}, checked_table_data[table_id], new_checked_table_data[table_id]);
			}
		}else{
			delete checked_table_data[table_id][checkbox_id];
		}
		
		checked_table_counter(parent_table);
		
	});
	
	$(document).on('change','table thead th:first-child input[type="checkbox"]',function(){
		var value = $(this).is(":checked");
		var parent_table = $(this).closest('table');
		var child_checkboxes = parent_table.find('tbody tr td:first-child input[type="checkbox"]');
		child_checkboxes.prop('checked',value).trigger('change');
	});
	
	//End table multiple selection
	
});

function show_toast(notification_type,duration=15000,title='',description='',redirect_url,position){
	toastr.options.closeButton =true;
	toastr.options.progressBar =true;
	toastr.options.preventDuplicates =false;
	toastr.options.timeOut =duration;
	toastr.options.extendedTimeOut =1000;
	toastr.options.positionClass ='toast-' + position;
	
	
	if (redirect_url){
		toastr.options.onclick = function () {
			location.href = redirect_url;
		};
	}
	
	if(title){
		toastr[notification_type](description,title);
	}else{
		toastr[notification_type](description);
	}
}

function count_form_filters(form_element,output_element){

	var filter_count = 0;
	var formData = form_element.serializeArray();
	$.each(formData,function(index, field){
		if(field.name !== '_method'){
			if(field.value !==''){
				filter_count+=1;
			}
		}
	});
	
	console.log(formData);
	
	if(filter_count >=1){
		$(output_element).html(filter_count).show();
	}else{
		$(output_element).html(0).hide();
	}
}
//disable datatable error pop
$.fn.dataTable.ext.errMode = 'none';

function convert_to_datatable(table_id,ajax_data_url=null,exclude_orderable='[]',table_row_actions=[],pagination_limit=20){
	var table_id_orig = table_id;
	table_id = '#'+table_id;
	var has_action_column = Boolean($(table_id).find('thead .action_column').length);
	var has_multiselect_column = Boolean($(table_id).find('thead .multiselect_column').length);
	var is_server_side = false;
	var ajax_params = null;

	// if(table_row_actions !== null && table_row_actions.trim() !== ''){
		// table_row_actions = JSON.parse(table_row_actions);
		// console.log(table_row_actions)
		// return false;
	// }
	
	if(ajax_data_url !== null && ajax_data_url.trim() !== ''){
		is_server_side = true;
		ajax_params = {
			url: ajax_data_url,
			type: "GET",
			data: {
				layout: "ajax",
				filter: function () { // dynamic
					return $(table_id).parent().parent().parent().find('.form-table-search-filters').serialize();
				}
			},
			dataSrc: function ( json ) {
				var new_data = [];
				
				$.each(json.data,function(index, value){
					
					var unformatted_rows = value;
					json.data[index] = Object.values(value);
					
					var row_id = json.data[index][0];
					json.data[index].shift(); //unset id
					
					//add checkbox in first column of table row
					if(has_multiselect_column){
						
						var default_check_value = '';;
						if (checked_table_data.hasOwnProperty(table_id_orig) && checked_table_data[table_id_orig].hasOwnProperty(row_id)) {
							if(checked_table_data[table_id_orig][row_id]==true){
								default_check_value = 'checked';
							}
						}
						
						json.data[index].unshift('<div class="n-chk align-self-center text-center"><div class="form-check"><input type="checkbox" ' + default_check_value + ' class="form-check-input primary row_checkbox" data-id="' + row_id + '"><label class="form-check-label"></label><span class="new-control-indicator"></span></div></div>');
					}
					
					//add row controls
					if(has_action_column){
						var action_html = '<div class="dropdown dropstart"><a href="#" class="text-muted" data-bs-toggle="dropdown" data-bs-boundary="viewport" aria-expanded="false"><i class="ti ti-dots-vertical fs-8"></i></a>';
						action_html += '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
						
						//build additional actions
						$.each(table_row_actions,function(action_index, action_value){
							var label = (action_value.hasOwnProperty('label')) ? action_value.label : 'Undefined label';
							var attributes = (action_value.hasOwnProperty('attributes')) ? action_value.attributes : '';
							
							//build action button on condition here
							try {
								var on_condition = (action_value.hasOwnProperty('on')) ? action_value.on : '';
								if(typeof on_condition.field !== 'undefined' && on_condition!==''){
									
									var on_condition_column = (action_value.on.hasOwnProperty('field') ? Object.keys(action_value.on.field)[0] : '');
									var on_condition_value = on_condition.field[on_condition_column];
									var on_condition_operator = ((typeof on_condition.operator !== 'undefined' && on_condition.operator.trim() !=='') ?	on_condition.operator : 'equal');
									
									if( typeof unformatted_rows[on_condition_column] !== 'undefined' && unformatted_rows[on_condition_column] !== null ){
										
										if(on_condition_operator == 'not'){
											if(unformatted_rows[on_condition_column] === on_condition_value){
												return;
											}
										}else{
											if(unformatted_rows[on_condition_column] !== on_condition_value){
												return;
											}
										}
										
									}
									
									
									
								}
							} catch (error) {
							}
							
							attributes = JSON.parse(JSON.stringify(attributes)); //why the fuck need this code
							
							var use_param = (action_value.hasOwnProperty('use_param')) ? action_value.use_param : false;
							var row_data_id = '';
							
							if(unformatted_rows.hasOwnProperty(use_param)){
								row_data_id = unformatted_rows[use_param];
							}else if(use_param === false){
								row_data_id = row_id;
							}else{
								row_data_id = use_param;
							}
	
							if(attributes.href !== '#'){
								attributes.href += '/' + row_data_id;
							}
							
							//build ajax here
							var ajax_attributes = '';
							if(action_value.hasOwnProperty('ajax')){
								var ajax_url = (action_value.hasOwnProperty('url') && action_value.url.trim()!=='') ? action_value.url.trim() : '#';
								if(ajax_url!=='#' && ajax_url!==''){
									
									ajax_url += '/' + row_data_id;
									var ajax_confirm_title = (action_value.ajax.title) ? action_value.ajax.title : 'Are you sure?';
									var ajax_confirm_desc = (action_value.ajax.description) ? action_value.ajax.description : '';
									
									var success_callback = escape_html_chars((action_value.ajax.hasOwnProperty('success_callback') && action_value.ajax.success_callback.trim()!=='') ? action_value.ajax.success_callback.trim() : '');
									var fail_callback = escape_html_chars((action_value.ajax.hasOwnProperty('fail_callback') && action_value.ajax.fail_callback.trim()!=='') ? action_value.ajax.fail_callback.trim() : '');
									
									ajax_function = escape_html_chars('confirm_ajax("' + ajax_confirm_title + '","' + ajax_confirm_desc + '","' + ajax_url + '","GET",null,function(data){' + success_callback + '; $("'+ table_id +'").DataTable().ajax.reload( null, false );},function(data){' + fail_callback + '; $("'+ table_id +'").DataTable().ajax.reload( null, false ); })');
									ajax_attributes = 'onclick="' + ajax_function + '"';
									
								}
							}

							action_html += '<li>';
							action_html += '<a ' + ajax_attributes + ' data-id="' + row_data_id + '" ' + array_to_html_attributes(attributes) + ' >' + label + '</a>';
							action_html += '</li>';
						});
						
						action_html += '</ul>';
						action_html += '</div>';
						
						if(has_multiselect_column){
							json.data[index].splice(1, 0, action_html);
						}else{
							json.data[index].splice(0, 0, action_html);
						}
						
						
					}
				});
				
				return json.data;
			},
			error: function (xhr, error, code) {
				show_toast('error',5000,'Error',error,'','top-right','f06a');
			}
		};
	}
	
	
	function getKeyByValue(object, value) {
	  return Object.keys(object).find(key => object[key] === value);
	}

	$(table_id).DataTable({
		info: true,
		searching: true,
		ordering: true,
		paging: true,
		processing: true,
		
		"language": {
			"processing": "<span class='fa-stack fa-lg'>\n\
			<i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
			</span>&nbsp;Processing ..."
		},
		
		serverSide: is_server_side,
		order: [],
		saveState: true,
		autoWidth: false,
		// scroller: true,
		// deferRender: true,
	    // scrollCollapse: true,
	    // scrollY: "auto",
		
		dom: "lrtip",
		columnDefs: [
			{ "orderable": false, "targets": JSON.parse(exclude_orderable) },
		],
		pageLength: pagination_limit,
		lengthChange: false,
		ajax: ajax_params,
		initComplete: function(settings, json) {
			var table = settings.nTable;
			var search_field = $(table).parent().parent().parent().find('.table-global-search');
			var table_filter_count = $(table).parent().parent().parent().find('.table-filter-count');
			var btn_search_filter_apply = $(table).parent().parent().parent().find('.btn-search-filter-apply');
			var btn_search_filter_reset = $(table).parent().parent().parent().find('.btn-search-filter-reset');
			var form_table_search_filters = $(table).parent().parent().parent().find('.form-table-search-filters');
			var pagination_container  = $(table).parent().parent().parent().find('.pagination_container ');
			var pagination_info  = $(table).parent().parent().parent().find('.pagination_info ');
			
			var dataTables_info  = $(table).parent().parent().parent().find('.dataTables_info');
			var dataTables_paginate  = $(table).parent().parent().parent().find('.dataTables_paginate');
			
			 $(dataTables_info).appendTo(pagination_info);
			 $(dataTables_paginate).appendTo(pagination_container);
			
			$(btn_search_filter_apply).on('click',function(){
				$(table).DataTable().draw();
				count_form_filters(form_table_search_filters,table_filter_count);
			});
			
			$(btn_search_filter_reset).on('click',function(){
				$(form_table_search_filters).find('select').val('').trigger('change');
				$(form_table_search_filters).trigger('reset');
				$(table_filter_count).html('0').hide();
				$(table).DataTable().draw();
			});
			
			$(search_field).on('keyup change', function () {
				$(table).DataTable().search($(this).val()).draw();
			});
		},
		
	});
}

function table_disable_selected(element,event){
	event.preventDefault();
	var table_id = $(element).attr('table_id');
	var table = $('#' + table_id);

	if(checked_table_data.hasOwnProperty(table_id) && Object.keys(checked_table_data[table_id]).length > 0){
		var ids = Object.keys(checked_table_data[table_id]);
		var data = 'id=' + JSON.stringify(ids);
		var url = $(element).attr('href');
		var success_callback = function(data){table.DataTable().ajax.reload(null, false);};
		confirm_ajax('Are you sure?','This will disable ' + ids.length + ' records from your data.',url,'POST',data,success_callback);
	}else{
		Swal.fire("","Please select data to disable","info");
	}
	
}

function table_enable_selected(element,event){
	event.preventDefault();
	var table_id = $(element).attr('table_id');
	var table = $('#' + table_id);

	if(checked_table_data.hasOwnProperty(table_id) && Object.keys(checked_table_data[table_id]).length > 0){
		var ids = Object.keys(checked_table_data[table_id]);
		var data = 'id=' + JSON.stringify(ids);
		var url = $(element).attr('href');
		var success_callback = function(data){table.DataTable().ajax.reload(null, false);};
		confirm_ajax('Are you sure?','This will enable ' + ids.length + ' records from your data.',url,'POST',data,success_callback);
	}else{
		Swal.fire("","Please select data to enable","info");
	}
	
}

function table_delete_selected(element,event){
	event.preventDefault();
	var table_id = $(element).attr('table_id');
	var table = $('#' + table_id);

	if(checked_table_data.hasOwnProperty(table_id) && Object.keys(checked_table_data[table_id]).length > 0){
		var ids = Object.keys(checked_table_data[table_id]);
		var data = 'id=' + JSON.stringify(ids);
		var url = $(element).attr('href');
		var success_callback = function(data){table.DataTable().ajax.reload(null, false); if(checked_table_data.hasOwnProperty(table_id)) { delete checked_table_data[table_id]; checked_table_counter(table);}};
		confirm_ajax('Are you sure?','This will delete ' + ids.length + ' records from your data.',url,'POST',data,success_callback);
	}else{
		Swal.fire("","Please select data to delete","info");
	}
}

function confirm_ajax(title,message,ajax_url,request_method="GET",request_body="",success_callback=null,fail_callback=null,success_title = "Success!",icon="question",confirm_text="Proceed"){
	event.preventDefault();
	var ajax_params = {method: "POST", body: request_body, headers:{'Content-Type': 'application/x-www-form-urlencoded','Accept': '*/*' }};
	if(request_method=='GET'){
		ajax_params = {method: "GET", headers:{'Content-Type': 'application/x-www-form-urlencoded','Accept': '*/*' }};
	}
	
	Swal.fire({
	  title: title,
	  text: message,
	  icon: icon,
	  showCancelButton: true,
	  confirmButtonText: confirm_text,
	  showLoaderOnConfirm: true,
	  preConfirm: () => {
		  
		return fetch(ajax_url, ajax_params)
		.then((response) => {
			if (!response.ok) {
			  return {success: false, msg: response.statusText};
			}
			return response.json();
		})
		.catch((error) => {
			console.log(error);
			return {success: false, msg: 'Unable to fetch data!'};
		});
		  
	  },
	  allowOutsideClick: () => !Swal.isLoading(),
	}).then((result) => {
		if (result.value) {
			if (result.value.success == false) {
				if(fail_callback!==null && $.isFunction(fail_callback)){
					fail_callback(result.value);
				}
				Swal.fire(
				  "Error!",
				  result.value.msg,
				  "error"
				);
			}else{
				if(success_callback!==null && $.isFunction(success_callback)){
					success_callback(result.value);
				}
				Swal.fire(
				  success_title,
				  result.value.msg,
				  "success"
				);
			}
		}
	});
}

function array_to_html_attributes(attributes){
	if(typeof attributes !== 'object' || Object.keys(attributes).length <=0) return '';
	var compiled = Object.keys(attributes).join('="%s" ') + '="%s"';
	let value = Object.values(attributes);
	
	var clean_value = value.map((x) => {
		return escape_html_chars(x);
	});
	return parametize_string(compiled,...clean_value);
}

function parametize_string(...args){
	return args.shift().replace(/%([jsd])/g, x => x === '%j' ? JSON.stringify(args.shift()) : args.shift());
}

function escape_html_chars(unsafe)
{
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }

function showLoading(loading_caption='Please wait...'){
	Swal.fire({
	  html: '<div class="container d-flex align-items-center justify-content-center" style="height:150px; width: 100%;"><span class="hour_glass"></span> </div><h5>' + loading_caption + '</h5>',
	  showConfirmButton: false,
	  allowOutsideClick: false,
	  allowEscapeKey: false,
	  customClass: 'swal-loader-conatiner',
	});
}

function hideLoading(){
	Swal.close();
}