<?php
App::uses('AppHelper', 'View/Helper');

class ModernizeComponentHelper extends AppHelper {
	var $helpers = array('Html', 'Form','Time');
	
	var $global_model = null;
	var $global_controller = null;
	var $global_action = null;
	var $global_prefix = null;
	var $get_query_string = null;
	var $get_sort_query_string = null;
	
	public function get_templated_navigation_links($link_params = array()) {
		$navigation_link_string_level_1 = '';
		$navigation_link_string_level_2 = '';
		$navigation_link_string_level_3 = '';
		
		$has_match_level_1 = false;
		$has_match_level_2 = false;
		$has_match_level_3 = false;
		
		if(isset($this->params['prefix'])) {
			$action = substr($this->params['action'], strlen($this->params['prefix'] . '_'));
		}
		else {
			$action = $this->params['action'];
		}
		
		if(isset($this->params['controller'])) {
			$controller = $this->params['controller'];
		}

		foreach($link_params as $link_param_index => $link_param_key_value_pair) {			
			$active_class = '';
			
			if (isset($link_param_key_value_pair['url'])) {

				$passed_controller = $link_param_key_value_pair['url']['controller'];
				$passed_action = $link_param_key_value_pair['url']['action'];
				$passed_icon = '';
				if(isset($link_param_key_value_pair['icon'])) {
					$passed_icon = $link_param_key_value_pair['icon'];
				}

				if(isset($link_param_key_value_pair['url']['controller']) && $link_param_key_value_pair['url']['controller'] == $controller && isset($link_param_key_value_pair['url']['action']) && $link_param_key_value_pair['url']['action'] == $action) {
					$active_class = 'active';
				}

				$navigation_link_string_level_1 .= '
					<li class="sidebar-item">
						<a class="sidebar-link '. $active_class .'" href="'. $this->Html->url(array('controller' => $passed_controller, 'action' => $passed_action, 'prefix' => false)) .'" aria-expanded="false">
						<span>
						'. $passed_icon .'
						</span>
						<span class="hide-menu">'. $link_param_index .'</span>
						</a>
					</li>
				';
			}
			else if (isset($link_param_key_value_pair['children']) && !empty($link_param_key_value_pair['children'])) {
				$child_level_1 = '';
				$child_level_2 = '';
				$child_level_3 = '';
				$parent_icon = '';
				if(isset($link_param_key_value_pair['icon'])) {
					$parent_icon = $link_param_key_value_pair['icon'];
				}
				
				foreach($link_param_key_value_pair['children'] as $children_one_level_index => $children_one_level_key_value_pair) {
					
					if (isset($children_one_level_key_value_pair['url'])) {
						$child_controller = $children_one_level_key_value_pair['url']['controller'];
						$child_action = $children_one_level_key_value_pair['url']['action'];
						$child_icon = '';
						if(isset($children_one_level_key_value_pair['icon'])) {
							$child_icon = $children_one_level_key_value_pair['icon'];
						}

						$child_level_1 .= '
							<li class="sidebar-item">
								<a href="'. $this->Html->url(array('controller' => $child_controller, 'action' => $child_action, 'prefix' => false)) .'" class="sidebar-link">
									<div class="round-16 d-flex align-items-center justify-content-center">
										'. $child_icon .'
									</div>
									<span class="hide-menu">'. $children_one_level_index .'</span>
								</a>
							</li>
						';
					}
					else if (isset($children_one_level_key_value_pair['children']) && !empty($children_one_level_key_value_pair['children'])) {
												
						$child_level_2 .= '
							<li class="sidebar-item">
								<a class="sidebar-link has-arrow '. $active_class .'" href="#" aria-expanded="false">
								<span class="d-flex">
									'. $child_icon .'
								</span>
								<span class="hide-menu">'. $children_one_level_index .'</span>
								</a>
								<ul aria-expanded="false" class="collapse two-level">					
						';

						foreach($children_one_level_key_value_pair['children'] as $children_second_level_index => $children_second_level_key_value_pair) {
							
							if (isset($children_second_level_key_value_pair['url'])) {
								$second_child_controller = $children_second_level_key_value_pair['url']['controller'];
								$second_child_action = $children_second_level_key_value_pair['url']['action'];
								$second_child_icon = '';
								if(isset($children_second_level_key_value_pair['icon'])) {
									$second_child_icon = $children_second_level_key_value_pair['icon'];
								}

								$child_level_2 .= '
									<li class="sidebar-item">
										<a href="'. $this->Html->url(array('controller' => $second_child_controller, 'action' => $second_child_action, 'prefix' => false)) .'" class="sidebar-link">
											<div class="round-16 d-flex align-items-center justify-content-center">
												'. $second_child_icon .'
											</div>
											<span class="hide-menu">'. $children_second_level_index .'</span>
										</a>
									</li>
								';
							}
							else if (isset($children_second_level_key_value_pair['children']) && !empty($children_second_level_key_value_pair['children'])) {
								$child_level_3 .= '
									<li class="sidebar-item">
										<a class="sidebar-link has-arrow '. $active_class .'" href="#" aria-expanded="false">
										<span class="d-flex">
											'. $child_icon .'
										</span>
										<span class="hide-menu">'. $children_second_level_index .'</span>
										</a>
										<ul aria-expanded="false" class="collapse three-level">					
								';

								foreach($children_second_level_key_value_pair['children'] as $children_third_level_index => $children_third_level_key_value_pair) {
									
									if (isset($children_third_level_key_value_pair['url'])) {
										$third_child_controller = $children_third_level_key_value_pair['url']['controller'];
										$third_child_action = $children_third_level_key_value_pair['url']['action'];
										$third_child_icon = '';
										if(isset($children_third_level_key_value_pair['icon'])) {
											$third_child_icon = $children_third_level_key_value_pair['icon'];
										}

										if(isset($children_third_level_key_value_pair['url']['controller']) && $children_third_level_key_value_pair['url']['controller'] == $controller && isset($children_third_level_key_value_pair['url']['action']) && $children_third_level_key_value_pair['url']['action'] == $action) {
											$active_class = 'active';
										}

										$child_level_3 .= '
											<li class="sidebar-item">
												<a href="'. $this->Html->url(array('controller' => $third_child_controller, 'action' => $third_child_action, 'prefix' => false)) .'" class="sidebar-link">
													<div class="round-16 d-flex align-items-center justify-content-center">
														'. $third_child_icon .'
													</div>
													<span class="hide-menu">'. $children_third_level_index .'</span>
												</a>
											</li>
										';
									}
									
								}
								
								$child_level_3 .= '
										</ul>
									</li>
								';

								$child_level_2 .= $child_level_3;
							}
						}

						$child_level_2 .= '
								</ul>
							</li>
						';
					}

				}
				
				$child_level_1 .= $child_level_2;
				
				$child_level_1 .= '
						</ul>
					</li>
				';
				
				$navigation_link_string_level_1 .= '
					<li class="sidebar-item">
						<a class="sidebar-link has-arrow" href="#" aria-expanded="false">
						<span class="d-flex">
							'. $parent_icon .'
						</span>
						<span class="hide-menu">'. $link_param_index .'</span>
						</a>
						<ul aria-expanded="false" class="collapse first-level">					
				';

				$navigation_link_string_level_1 .= $child_level_1;
				
				// $navigation_link_string_level_1 .= '
				// 		</ul>
				// 	</li>
				// ';
			}
			else {
				// $navigation_link_string_level_1 .= '<li class="nav-small-cap"><i class="ti ti-dots nav-small-cap-icon fs-4"></i><span class="hide-menu">' . $link_param_key_value_pair . '</span></li>';
				// $navigation_link_string_level_1 .= '
				// 	<li class="sidebar-item">
				// 		<a class="sidebar-link" href="./index.html" aria-expanded="false">
				// 		<span>
				// 		<i class="ti ti-aperture"></i>
				// 		</span>
				// 		<span class="hide-menu">Modern</span>
				// 		</a>
				// 	</li>
				// ';
			}
		}

		return $navigation_link_string_level_1;
	}

	

	public function create_page_container_start($title, $decription = false) {
		if($decription != false){
			echo '
				<div class="card">
					<div class="card-body">
						<h5>'.$title.'</h5>
							<p class="card-subtitle mb-3">
								'.$decription.'
							</p>
										
			';
		}else{
			$decription = '';
			echo '
				<div class="card">
					<div class="card-body">
						<h5 class="card-title fw-semibold mb-0">'.$title.'</h5>
							<p class="card-subtitle mb-3">
								'.$decription.'
							</p>
										
				';
		}
		
	}
	
	public function create_page_container_end() {
		echo '	
				</div>
			</div>
		';
	}

	public function create_start_modal($id, $title=''){
		return '<div class="modal fade" id="'.$id.'" aria-hidden="true" data-focus="false">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
					<div class="modal-content">
						<div class="modal-header d-flex align-items-center">
						  <h4 class="modal-title" > '.$title.' </h4>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
						</div>
						
								<div class="modal-body">';
	}
	
	public function create_end_modal(){
			return '			</div>
					</div>
				</div>
				</div>';
	}
	
	public function create_start_search_filter_modal(){
		$id = 'search-filter-modal';
		$title = 'Search Filters';
		return $this->create_start_modal($id,$title);
	}
	
	
	public function create_end_search_filter_modal(){
			return '			</div>
						<div class="modal-footer">
							  <button type="button" class="btn btn-light-primary text-primary font-medium waves-effect text-start btn-search-filter-apply" data-bs-dismiss="modal" >
								Apply
							  </button>
							  <button type="button" class="btn btn-light-danger text-warning font-medium waves-effect text-start btn-search-filter-reset" data-bs-dismiss="modal" >
								Reset Filters
							  </button>
							  <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect text-start" data-bs-dismiss="modal" >
								Cancel
							  </button>
						</div>
					</div>
				</div>
				</div>';
	}
	
	public function create_page_header_title($title,$controller){
		return '<div class="card bg-light-info shadow-none position-relative overflow-hidden">
				<div class="card-body px-4 py-3">
				  <div class="row align-items-center">
					<div class="col-9">
					  <h4 class="fw-semibold mb-8">'.$title.'</h4>
					  <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
						  <li class="breadcrumb-item">'.$controller.'</li>
						  <li class="breadcrumb-item" aria-current="page">'.$title.'</li>
						</ol>
					  </nav>
					</div>
					<div class="col-3">
					  <div class="text-center mb-n5">  
						<img src="'.Configure::read('BASE_URL').'template/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
					  </div>
					</div>
				  </div>
				</div>
			  </div>';
	}
	
	
	
	
	function create_table_start($table_params){
		$class = $table_params['class'] ?? null;
		$id = $table_params['id'] ?? null;
		$controller = $table_params['table-settings']['controller'] ?? null;
		$action = $table_params['table-settings']['action'] ?? '';
		
		if($id===null && trim($id) === ''){
			$id = generate_unique_key();
		}
		
		if($class===null && trim($class) === ''){
			$class = 'table align-middle text-nowrap';
		}
		
		if($controller!==null && trim($controller) !== ''){
			$controller = 'data-controller="'.$controller.'"';
		}
		
		if($action!==null && trim($action) !== ''){
			$action = 'data-action="'.$action.'"';
		}
		
		$html='';
		$html.= '<div class="table-responsive" >
						<table id="'.$id.'" class="'.$class.'" '.$controller.' '.$action.'>';
		return $html;
	}
	
	function create_table_end(){
		return '</table>
			</div>';
	}
	
	function create_table_headings($table_headers = array()){
		$html='<thead class="header-item">';
		$html.= $this->Html->tableHeaders($table_headers);
		$html.='</thead>';
		return $html;
	}
	
	function create_table_data($table_data = array()){
		$html='<tbody>';
		// $html.= $this->Html->tableCells($table_headers);
		
		foreach($table_data as $key=>$value){
			$html.= $this->Html->tableCells(array_values($value));
			// debug(array_values($value));
			// exit();
		}
		
		$html.='</tbody>';
		return $html;
	}
	
	function create_table_view($table_params = array()){
		$html='';
		$table_settings_includes = $table_params['table-settings']['include'] ?? array();
		$table_settings_row_includes = $table_params['table-settings']['include_controls'] ?? array();
		$table_multiselect = (isset($table_params['table-settings']['multiselect']) && $table_params['table-settings']['multiselect'] !==false ? true : false);
		$table_multiselect_params = $table_params['table-settings']['multiselect'] ?? array();
		
		$table_headers = $table_params['column-headers'] ?? array();
		$table_data = $table_params['table-settings']['table-data'] ?? array();
		
		$table_controller = $table_params['table-settings']['controller'] ?? null;
		$table_model = $table_params['table-settings']['model'] ?? null;
		$table_action = $table_params['table-settings']['action'] ?? '';
		
		
		$table_ajax_url = '';
		$is_ajax_table = isValueInArray('table-settings','ajax',$table_params);
		if($is_ajax_table){
			$table_ajax_url = $table_params['table-settings']['ajax']['url'] ?? '';
			$table_ajax_url = $this->Html->url($table_ajax_url);
		}
		
		$table_id = generate_unique_key();
		if(isset($table_params['id']) && trim($table_params['id'])!==''){
			$table_id = $table_params['id'];
		}else{
			$table_params['id'] = $table_id;
		}
		
		//build searchbox and export
		if(count($table_settings_includes)>=1){
			$html.='<div class="row">';
				$html.='<div class="col-md-6 col-xl-6">';
				//build search
				if(in_array('search',$table_settings_includes)){
				  $html.='<div class="position-relative">
						  <div class="row">';
						  
							$html.='<div class="col-10 pe-1">
										<input type="text" class="form-control table-global-search ps-5" placeholder="Search Record...">
										<i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>';
										//MODAL HERE
										
										$html.= $this->create_start_search_filter_modal();
										$html.= $this->Form->create(false,array('class'=>'form-table-search-filters'));
										$html.=  $this->create_form_basic_input_batch(array(
											array(
												'size' => 12,
												'orientation' => 'vertical',
												'contents' => ($table_params['table-settings']['search_options'] ?? array())
											),
										));
										$html.= $this->Form->end();
										$html.= $this->create_end_search_filter_modal();
										
										
							$html.='</div>';
							  
							$html.='<div class="col-2 ps-0">
										<button type="button" class="notify-badge btn mb-1 waves-effect waves-light btn-outline-primary" data-bs-toggle="modal" data-bs-target="#search-filter-modal">
											<i class="fa-solid fa-filter-list fs-4"></i>
											<span class="badge rounded-pill bg-danger fs-2 table-filter-count" style="top:0px;right:0px;display: none">0</span>
										</button>
									</div>';
							  
				  $html.='</div>
						  </div>';
				}
				$html.='</div>';
			
				$html.='<div class="col-md-6 col-xl-6 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
						  <div class="btn-group btn-group mb-2" role="group">';
						  
							if(in_array('export',$table_settings_includes)){
								$html.='<a class="btn mb-1 waves-effect waves-light btn-outline-primary" href="#">
										  <i class="fa-light fa-file-csv fs-4 me-2"></i>CSV
										</a>
										<a class="btn mb-1 waves-effect waves-light btn-outline-primary" href="#">
										  <i class="fa-light fa-file-pdf fs-4 me-2"></i>PDF
										</a>';
							}
							
							if(isset($table_settings_includes['add']) || in_array('add',$table_settings_includes)){
								
								$label = $table_settings_includes['add']['label'] ?? '<i class="fa-light fa-circle-plus fs-4 me-2"></i>Add';
								$label = (trim($label)=='' ? '<i class="fa-regular fa-circle-exclamation text-danger"></i> &nbsp;No Label' : $label);
								
								$href = $table_settings_includes['add']['attributes']['href'] ?? '';
								
								$url = $table_settings_includes['add']['url'] ?? array('controller'=>$table_controller, 'action'=> "add_$table_action");
								$url = (trim($href)=='' ? $url : $href);
								
								$attributes = $table_settings_includes['add']['attributes'] ?? array();
								$attributes['escape'] = false;
								$attributes['table_id'] = $table_id;
								$attributes['class'] = $table_settings_includes['add']['attributes']['class'] ?? '';
								$attributes['class'].= ' btn mb-1 waves-effect waves-light btn-outline-primary add_new_record';
								
								$html.= $this->Html->link($label,$url,$attributes);
								
							}

			$html.='	  </div>
						</div>';
			$html.='</div>';
		}
		
		//bulk select action
		$has_table_row_action = false;

		if($table_multiselect === true){
			$html.= '<div class="row">
				  <div class="col-md-12">
					<div class="btn-group float-start" role="group">
						<button id="btnGroupVerticalDrop1" type="button" class="btn rounded-pill btn-light-secondary text-secondary font-medium dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						 <span class="badge rounded-pill me-auto bg-primary fs-2 selected-table-count" style="top:0px;right:0px">0</span>
						  &nbsp;Actions
						</button>';
						
						if(count($table_multiselect_params) > 0) $html.= '<div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="">';
						
						foreach($table_multiselect_params as $key=>$value){
							
							
							if($value !== 'delete' && $value !== 'disable' && $value !== 'enable'){
								$action = $key;
								$url = $value['url'] ?? array('controller'=>$table_controller, 'action'=> $action);
								$label = $value['label'] ?? '<i class="fa-regular fa-circle-exclamation text-danger"></i>No Label';
								$attributes = $value['attributes'] ?? array();
								$attributes['escape'] = false;
								$attributes['table_id'] = $table_id;
								
								if(isset($attributes['class'])){
									$attributes['class'] .= ' dropdown-item d-flex align-items-center gap-3';
								}else{
									$attributes['class'] = 'dropdown-item d-flex align-items-center gap-3';
								}
								$html.= $this->Html->link($label,$url,$attributes);
							}
						}
						
						if(isset($table_multiselect_params['disable']) || in_array('disable',$table_multiselect_params)){
							$label = '<i class="fs-4 fa-solid fa-ban"></i>Disable Selected';
							$url = array('controller'=>$table_controller, 'action'=> "disable_selected_$table_action");
							$attributes = array();
							$attributes['escape'] = false;
							$attributes['table_id'] = $table_id;
							$attributes['class'] = 'dropdown-item d-flex align-items-center gap-3';
							$attributes['onclick'] = 'table_disable_selected(this,event)';
							$html.= $this->Html->link($label,$url,$attributes);
						}
						
						if(isset($table_multiselect_params['enable']) || in_array('enable',$table_multiselect_params)){
							$label = '<i class="fs-4 fa-solid fa-lock-keyhole-open"></i>Enable Selected';
							$url = array('controller'=>$table_controller, 'action'=> "enable_selected_$table_action");
							$attributes = array();
							$attributes['escape'] = false;
							$attributes['table_id'] = $table_id;
							$attributes['class'] = 'dropdown-item d-flex align-items-center gap-3';
							$attributes['onclick'] = 'table_enable_selected(this,event)';
							$html.= $this->Html->link($label,$url,$attributes);
						}
						
						if(isset($table_multiselect_params['delete']) || in_array('delete',$table_multiselect_params)){
							$label = '<i class="fs-4 ti ti-trash"></i>Delete Selected';
							$url = array('controller'=>$table_controller, 'action'=> "delete_selected_$table_action");
							$attributes = array();
							$attributes['escape'] = false;
							$attributes['table_id'] = $table_id;
							$attributes['class'] = 'dropdown-item d-flex align-items-center gap-3';
							$attributes['onclick'] = 'table_delete_selected(this,event)';
							$html.= $this->Html->link($label,$url,$attributes);
						}
			
			if(count($table_multiselect_params) > 0) $html.= '</div>';			
						
			$html.=	  '</div>
				 </div>
				</div>';
		}
		
		//create table
		$html .= $this->create_table_start($table_params);
		if(count($table_headers) >=1){
			
			if(count($table_settings_row_includes)>=1 || isset($table_settings_includes['edit']) || in_array('edit',$table_settings_includes) || isset($table_settings_includes['delete']) || in_array('delete',$table_settings_includes)){
				//add headers for action
				$has_table_row_action = true;
				$table_headers[]=array(''=>array('class'=>'action_column sorting_disabled','style'=>'min-width: 10px;max-width: 10px;width: 10px;'));
				$table_headers = array_merge(array_splice($table_headers, -1), $table_headers);
			}
			
			//check if multiselect
			if($table_multiselect){
				
				$multiselect_html = '<div class="n-chk align-self-center text-center">
										<div class="form-check">
										  <input type="checkbox" class="form-check-input primary header_checkbox">
										  <label class="form-check-label"></label>
										  <span class="new-control-indicator"></span>
										</div>
									</div>';
				
				$table_headers[]=array($multiselect_html=>array('class'=>'multiselect_column','style'=>'min-width: 30px;max-width: 30px;width: 30px;'));
				$table_headers = array_merge(array_splice($table_headers, -1), $table_headers);
			}
			
			$html.= $this->create_table_headings($table_headers);
		}
		
		//create table data row
		$html.='<tbody>';
		foreach($table_data as $key=>$value){
			
			$data_id_attribute = "";
			$data_id = null;
			
			if($table_model !== null){
				$data_id = $value["$table_model.id"];
				unset($value["$table_model.id"]);
				$data_id_attribute = 'data-id="'.$data_id.'"';
			}

			if($table_multiselect){
				$row_checkbox = '<div class="n-chk align-self-center text-center">
									<div class="form-check">
									  <input type="checkbox" class="form-check-input primary row_checkbox" '.$data_id_attribute.'>
									  <label class="form-check-label"></label>
									  <span class="new-control-indicator"></span>
									</div>
								</div>';
				$value['checkbox_column'] = $row_checkbox;
				$value = array_merge(array_splice($value, -1), $value);
			}

			if($has_table_row_action){
				//not done yet for standard datatable not server side
				$value['action_column'] = 'Action';
			}
			$html.= $this->Html->tableCells(array_values($value));
		}
		$html.='</tbody>';
		//end
		
		$html .= $this->create_table_end();
		
		$html .= '
		<div class="text-center pagination_info mt-1">
		</div>
		<div class="text-center pagination_container mt-3">
		</div>';
		
		$exclude_from_datatable_order = array();
		//buid datatable sorting
		if($table_multiselect){
			array_push($exclude_from_datatable_order,0);
		}
		if($has_table_row_action){
			if($table_multiselect){
				array_push($exclude_from_datatable_order,1);
			}else{
				array_push($exclude_from_datatable_order,0);
			}
		}
		$exclude_from_datatable_order = json_encode($exclude_from_datatable_order);
		//create table action rows
		
		//edit
		$table_row_actions = array();
		if(isset($table_settings_includes['edit']) || in_array('edit',$table_settings_includes)){
			
			$label = $table_settings_includes['edit']['label'] ?? '<i class="fs-4 ti ti-edit"></i>Edit';
			$url = $table_settings_includes['edit']['url'] ?? array('controller'=>$table_controller,'action'=>"edit_$table_action",'prefix'=>false);
			$url = $this->Html->url($url);
			
			$attributes = $table_settings_includes['edit']['attributes'] ?? array();
			$on = $table_settings_includes['edit']['on'] ?? array();
			
			$is_use_param = isValueInArray('edit', 'use_param', $table_settings_includes);
			$use_param = $table_settings_includes['edit']['use_param'] ?? array();
			
			$ajax = isValueInArray('edit', 'ajax', $table_settings_includes);
			$ajax_params = $table_settings_includes['edit']['ajax'] ?? array();
			
			if(isset($attributes['class'])){
				$attributes['class'].= ' dropdown-item d-flex align-items-center gap-3';
			}else{
				$attributes['class'] = 'dropdown-item d-flex align-items-center gap-3';
			}
			$attributes['href'] = $url;
			
			$controls = array();
			$controls['edit']['label'] = $label;
			$controls['edit']['url'] = $url;
			$controls['edit']['attributes'] = $attributes;
			$controls['edit']['on'] = $on;
			
			if($is_use_param) $controls['edit']['use_param'] = $use_param;
			if($ajax) $controls['edit']['ajax'] = $ajax_params;
			$table_row_actions = array_merge($table_row_actions,$controls);
		}
		
		//disable
		if(isset($table_settings_row_includes['disable']) || in_array('disable',$table_settings_row_includes)){
			
			$label = $table_settings_row_includes['disable']['label'] ?? '<i class="fa-solid fa-ban"></i> Disable';
			$url = $table_settings_row_includes['disable']['url'] ?? array('controller'=>$table_controller,'action'=>"disable_$table_action",'prefix'=>false);
			$url = $this->Html->url($url);
			
			$attributes = $table_settings_row_includes['disable']['attributes'] ?? array();
			$on = $table_settings_row_includes['disable']['on'] ?? array();
			
			$is_use_param = isValueInArray('disable', 'use_param', $table_settings_row_includes);
			$use_param = $table_settings_row_includes['disable']['use_param'] ?? array();
			
			$ajax = isValueInArray('disable', 'ajax', $table_settings_row_includes);
			$ajax_params = $table_settings_row_includes['disable']['ajax'] ?? array();
			
			if(isset($attributes['class'])){
				$attributes['class'].= ' dropdown-item d-flex align-items-center gap-3';
			}else{
				$attributes['class'] = 'dropdown-item d-flex align-items-center gap-3';
			}
			$attributes['href'] = $url;
			
			$controls = array();
			$controls['disable']['label'] = $label;
			$controls['disable']['url'] = $url;
			$controls['disable']['attributes'] = $attributes;
			$controls['disable']['on'] = $on;

			if($is_use_param) $controls['disable']['use_param'] = $use_param;
			if($ajax) $controls['disable']['ajax'] = $ajax_params;
			$table_row_actions = array_merge($table_row_actions,$controls);
			
			if(isset($table_settings_row_includes['disable'])){
				unset($table_settings_row_includes['disable']);
			}else{
				unset($table_settings_row_includes[array_search('disable',$table_settings_row_includes)]);
			}
			
		}
		
		//enable
		if(isset($table_settings_row_includes['enable']) || in_array('enable',$table_settings_row_includes)){
			
			$label = $table_settings_row_includes['enable']['label'] ?? '<i class="fa-solid fa-lock-keyhole-open"></i> Enable';
			$url = $table_settings_row_includes['enable']['url'] ?? array('controller'=>$table_controller,'action'=>"enable_$table_action",'prefix'=>false);
			$url = $this->Html->url($url);
			
			$attributes = $table_settings_row_includes['enable']['attributes'] ?? array();
			$on = $table_settings_row_includes['enable']['on'] ?? array();
			
			$is_use_param = isValueInArray('enable', 'use_param', $table_settings_row_includes);
			$use_param = $table_settings_row_includes['enable']['use_param'] ?? array();
			
			$ajax = isValueInArray('enable', 'ajax', $table_settings_row_includes);
			$ajax_params = $table_settings_row_includes['enable']['ajax'] ?? array();
			
			if(isset($attributes['class'])){
				$attributes['class'].= ' dropdown-item d-flex align-items-center gap-3';
			}else{
				$attributes['class'] = 'dropdown-item d-flex align-items-center gap-3';
			}
			$attributes['href'] = $url;
			
			$controls = array();
			$controls['enable']['label'] = $label;
			$controls['enable']['url'] = $url;
			$controls['enable']['attributes'] = $attributes;
			$controls['enable']['on'] = $on;

			if($is_use_param) $controls['enable']['use_param'] = $use_param;
			if($ajax) $controls['enable']['ajax'] = $ajax_params;
			$table_row_actions = array_merge($table_row_actions,$controls);
			
			if(isset($table_settings_row_includes['enable'])){
				unset($table_settings_row_includes['enable']);
			}else{
				unset($table_settings_row_includes[array_search('enable',$table_settings_row_includes)]);
			}
			
		}
		
		//delete
		if(isset($table_settings_includes['delete']) || in_array('delete',$table_settings_includes)){
			
			$label = $table_settings_includes['delete']['label'] ?? '<i class="fs-4 ti ti-trash"></i>Delete';
			$url = $table_settings_includes['delete']['url'] ?? array('controller'=>$table_controller,'action'=>"delete_$table_action",'prefix'=>false);
			$url = $this->Html->url($url);
			
			$attributes = $table_settings_includes['delete']['attributes'] ?? array();
			$on = $table_settings_includes['delete']['on'] ?? array();
			
			$is_use_param = isValueInArray('delete', 'use_param', $table_settings_includes);
			$use_param = $table_settings_includes['delete']['use_param'] ?? array();
			
			$ajax = isValueInArray('delete', 'ajax', $table_settings_includes);
			$ajax_params = $table_settings_includes['delete']['ajax'] ?? array();
			
			if(isset($attributes['class'])){
				$attributes['class'].= ' dropdown-item d-flex align-items-center gap-3';
			}else{
				$attributes['class'] = 'dropdown-item d-flex align-items-center gap-3';
			}
			$attributes['href'] = $url;
			
			$controls = array();
			$controls['delete']['label'] = $label;
			$controls['delete']['url'] = $url;
			$controls['delete']['attributes'] = $attributes;
			$controls['delete']['on'] = $on;

			if($is_use_param) $controls['delete']['use_param'] = $use_param;
			if($ajax) $controls['delete']['ajax'] = $ajax_params;
			$table_row_actions = array_merge($table_row_actions,$controls);
			
		}
		
		foreach($table_settings_row_includes as $key => $value) {
			if(!is_array($table_settings_row_includes[$key])){
				$key = $value;
			}
			
			$key_label = Inflector::humanize(Inflector::underscore(Inflector::camelize($key)));

			$label = $table_settings_row_includes[$key]['label'] ?? '<i class="fs-4 fa-regular fa-circle-question"></i>'.$key_label;
			$url = $table_settings_row_includes[$key]['url'] ?? array('controller'=>$table_controller,'action'=> $key."_$table_action",'prefix'=>false);
			$url = $this->Html->url($url);
			
			$attributes = $table_settings_row_includes[$key]['attributes'] ?? array();
			$on = $table_settings_row_includes[$key]['on'] ?? array();
			
			$is_use_param = isValueInArray($key, 'use_param', $table_settings_row_includes);
			$use_param = $table_settings_row_includes[$key]['use_param'] ?? array();
			
			$ajax = isValueInArray($key, 'ajax', $table_settings_row_includes);
			$ajax_params = $table_settings_row_includes[$key]['ajax'] ?? array();
			
			if(isset($attributes['class'])){
				$attributes['class'].= ' dropdown-item d-flex align-items-center gap-3';
			}else{
				$attributes['class'] = 'dropdown-item d-flex align-items-center gap-3';
			}
			$attributes['href'] = $url;
			
			$controls = array();
			$controls[$key]['label'] = $label;
			$controls[$key]['url'] = $url;
			$controls[$key]['attributes'] = $attributes;
			$controls[$key]['on'] = $on;

			if($is_use_param) $controls[$key]['use_param'] = $use_param;
			if($ajax) $controls[$key]['ajax'] = $ajax_params;
			$table_row_actions = array_merge($table_row_actions,$controls);
			
		}
		
		$table_row_actions = json_encode($table_row_actions);
		//end create table action rows
		
		if(trim($table_ajax_url)!==''){
			$html.="<script>convert_to_datatable('".$table_id."','".$table_ajax_url."','" . $exclude_from_datatable_order . "',".$table_row_actions.");</script>";
		}else{
			$html.="<script>convert_to_datatable('".$table_id."',null,'" . $exclude_from_datatable_order . "');</script>";
		}

		return $html;
	}
	
	function build_url($data,$key=null,$controller=null){
		if(isset($data['url'])){
			$link = $this->Html->url($data['url']);
		}else{
			$link = $this->Html->url(array('controller'=>$controller,'action'=>$key,'prefix'=>false));
		}
		return $link;
	}
	
	
	
	
	//========================================================RANZ CLEAN SLATE====================================
	
	function create_card_container_start($title=''){
		$html = '<div class="card">';
		$html .= '<div class="px-4 py-3 border-bottom">';
		$html .= '<h5 class="card-title fw-semibold mb-0">'.$title.'</h5>';
		$html .= '</div>';
		$html .= '<div class="card-body">';
		// if($title!=='') $html .= '<h5 class="mb-6">'.$title.'</h5>';
		return $html;
	}
	function create_card_container_end($title=''){
		return '</div></div>';
	}
	
	function create_form_basic_input_batch($form_input_data = array()){
		$html = '<div class="row">';
		
		foreach($form_input_data as $form_input_fields) {
			$form_layout = $form_input_fields['orientation'] ?? 'horizontal';
			$form_layout = ($form_layout == 'horizontal' ? false : true);
			
			$html.= '<div class="col-' . $form_input_fields['size'] . '">';
			$html.= '<div class="row">';
			
			foreach($form_input_fields['contents'] as $form_input_field) {
				if(is_array($form_input_field)) {
					
					$column_name = $form_input_field[0];
					$input_size = $form_input_field[1];
					$input_params = $form_input_field[2] ?? array();
					$input_options = $form_input_field[3] ?? array();
					
					$html.= $this->create_form_basic_input($column_name,$input_size,$input_params,$input_options,2,$form_layout);
					
				}else{
					$html.= $form_input_field;
				}
			}
			
			$html.= '</div>';
			$html.= '</div>';
		}
		
		$html.= '</div>';
		
		
		return $html;
	}
	
	function create_form_basic_input($column_name,$input_container_size=12, $params = array(),$input_options = array(), $label_size = 2, $is_vertical = true){
		
		$input_size = (12 - $label_size);
		
		$html = '<div class="mb-3 col-md-'.$input_container_size.'">';
		$html .= '<div class="row align-items-center">';
		$label = $params['label'] ?? Inflector::humanize($column_name);
		$class = $params['class'] ?? false;
		
		$params['div'] = false;	
		
		if(count($params)<=0){
			$params['type'] = 'text';
		}
		
		//fixing label
		if(!isset($params['label']) || $params['label']!==false){
			$html .= '<label class="form-label fw-semibold col-md-'.($is_vertical ? 12 : $label_size).'">'.$label.'</label>';
		}
		$params['label'] = false;
		
		
		
		//fixing class
		if($class === false){
			$params['class'] = 'form-control';
		}
		
		//templates here=========
		if(isset($params['type']) && $params['type']=='input_group'){
			$html .= '<div class="col-md-'.($is_vertical ? 12 : $input_size).'">';
			$html .= '<div class="input-group align-items-center">';
			
			foreach($input_options as $key=>$value){
				$column_name = $value[0];
				$params = $value[1];
				$group_options = $value[2] ?? array();
				
				$params['label'] = false;
				// $params['div'] = false;
				
				if(!isset($params['type'])){
					$params['type'] = 'text';
				}
				if(!isset($params['class'])){
					$params['class'] = 'form-control';
				}
				
				if($params['type'] == 'button'){
					if(!isset($params['value'])){
						$params['value'] = '';
					}
					
					$column_name = $params['value'];
					unset($params['value']);
					
					$html .= $this->Form->button($column_name, $params);
					
				}else{
					$params['class'] .= ' input-group-right-radius';
					$params = $this->get_templated_input_params($column_name, $params,$group_options)[1];
					$html .= $this->Form->input($column_name, $params);
				}
			}
			
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			
			return $html;
		}else{
			$params = $this->get_templated_input_params($column_name, $params,$input_options)[1];
		}
		//=======================
		
		
		$html .= '<div class="col-md-'.($is_vertical ? 12 : $input_size).'">';
		$html .= $this->Form->input($column_name, $params);
		$html .= '</div>';
		
		$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}

	function get_templated_input_params($column_name,$params,$input_options){
		if(isset($params['type']) && $params['type']=='date'){
			$params['class'] .= ' datepicker';
			$params['type'] = 'text';
		}else if(isset($params['type']) && $params['type']=='phone'){
			$temp_id = generate_unique_key();

			$params['class'] .= ' phone-input';
			$params['type'] = 'text';
			$params['temp_id'] = $temp_id;
			$params['after'] = $this->Form->input($column_name.'_selected_country_code', array('type'=>'hidden','class'=>'selected_country_code'));
			$params['after'].= $this->Form->input($column_name.'_selected_country_iso', array('type'=>'hidden','class'=>'selected_country_iso'));
			$params['after'].= $this->Form->input($column_name.'_selected_country_name', array('type'=>'hidden','class'=>'selected_country_name'));
			$params['after'].= "<script>convert_phone_input('$temp_id');</script>";
			
		}else if(isset($params['type']) && $params['type']=='daterange'){
			$params['class'] .= ' daterange';
			$params['type'] = 'text';
			$params['after'] = $this->Form->input($column_name.'_start', array('type'=>'hidden','class'=>'daterange_start'));
			$params['after'] .= $this->Form->input($column_name.'_end', array('type'=>'hidden','class'=>'daterange_end'));
			
		}else if(isset($params['type']) && $params['type']=='checkbox'){
			$params['class'] .= ' form-check-input';
			$params['class'] = str_replace("form-control", "", $params['class']);
			$params['div'] = 'form-check';
		}else if(isset($params['type']) && $params['type']=='switch_yes'){

			$params['class'] = str_replace("form-control", "", $params['class']);
			$params['div'] = 'switchToggleYesNo';
			$params['type'] = 'checkbox';
			$params['hiddenField'] = false;
			
			unset($params['label']);
		}else if(isset($params['type']) && $params['type']=='switch_status'){

			$params['class'] = str_replace("form-control", "", $params['class']);
			$params['div'] = 'switchToggleStatus';
			$params['type'] = 'checkbox';
			$params['hiddenField'] = false;
			
			unset($params['label']);
				
		}else if(isset($params['type']) && $params['type']=='radiolist'){
			$params['legend'] = false;
			$params['label'] = true;
			$params['type'] = 'radio';
			$params['before'] = '<div class="form-check form-check-inline">';
			$params['after'] = '</div>';
			$params['separator'] = '</div><div class="form-check form-check-inline">';
			$params['class'] .= ' form-check-input';
			$params['class'] = str_replace("form-control", "", $params['class']);
			
			$params = array_merge($params, array(
				'options' => $input_options,
			));
		}else if(isset($params['type']) && $params['type']=='checklist'){
			$params['label'] = false;
			$params['type'] = 'select';
			$params['multiple'] = 'checkbox';
			$params['class'] .= ' form-check';
			$params['class'] = str_replace("form-control", "", $params['class']);
			
			$params = array_merge($params, array(
				'options' => $input_options,
			));
			
		}else if(isset($params['type']) && $params['type']=='select'){
			$params = array_merge($params, array(
				'options' => $input_options,
				'empty' => array('name'=>'(Choose One)','value'=>'','selected' => true)
			));
		}
		
		return array($column_name,$params);
	}
	
	function create_form_action_start(){
		return '<div class="row pt-4"><div class="d-flex align-items-center justify-content-center gap-2">';
	}
	
	function create_form_action_end(){
		return '</div></div>';
	}
}
?>