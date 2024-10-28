<?php
App::uses('Component', 'Controller');

class ConditionBuilderComponent extends Component {
	
	public $controller;

	public function startup(Controller $controller) {
		$this->controller = $controller;
	}
	
    public function build_ajax_wildcard($column_name, $field_name, $params = '%LIKE%') {
		## FOR AJAX FILTER
		$search_filters = array();
		$filters = $this->controller->request->query['filter'] ?? '';
		parse_str($filters,$search_filters);
		unset($search_filters['_method']);
		$search_filters = (isset($search_filters['data']) ? $search_filters['data'] : $search_filters);
		## FOR AJAX FILTER

		$new_condition = array();
		
		if(isset($search_filters[$field_name]) && trim($search_filters[$field_name]) != '') {
			$data = $search_filters[$field_name];
			
			if(is_array($column_name)) {
				$additional_condition = array();
				foreach($column_name as $column_value) {
					if($params == 'LIKE' || $params == '%LIKE%') {
						$additional_condition[$column_value . ' LIKE'] = '%' . $data . '%';
					}
					else if($params == 'LIKE%') {
						$additional_condition[$column_value . ' LIKE'] = $data . '%';
					}
					else if($params == '%LIKE') {
						$additional_condition[$column_value . ' LIKE'] = '%' . $data;
					}
				}
				
				$new_condition['OR'] = array_merge($new_condition, $additional_condition);
			}
			else {				
				if($params == 'LIKE' || $params == '%LIKE%') {
					$new_condition = array(
						$column_name . ' LIKE' => '%' . $data . '%'
					);
				}
				else if($params == 'LIKE%') {
					$new_condition = array(
						$column_name . ' LIKE' => $data . '%'
					);
				}
				else if($params == '%LIKE') {
					$new_condition = array(
						$column_name . ' LIKE' => '%' . $data
					);
				}
			}
		}
		
		return $new_condition;
    }
	
	public function build_ajax_string_equivalent($column_name, $field_name) {
		## FOR AJAX FILTER
		$search_filters = array();
		$filters = $this->controller->request->query['filter'] ?? '';
		parse_str($filters,$search_filters);
		unset($search_filters['_method']);
		$search_filters = (isset($search_filters['data']) ? $search_filters['data'] : $search_filters);
		## FOR AJAX FILTER

		$new_condition = array();
		
		if(isset($search_filters[$field_name]) && trim($search_filters[$field_name]) != '') {
			$data = $search_filters[$field_name];

			$new_condition = array(
				$column_name => $data
			);
		}
		
		return $new_condition;
	}
	
	public function build_ajax_date_equivalent($column_name, $field_name) {
		## FOR AJAX FILTER
		$search_filters = array();
		$filters = $this->controller->request->query['filter'] ?? '';
		parse_str($filters,$search_filters);
		unset($search_filters['_method']);
		$search_filters = (isset($search_filters['data']) ? $search_filters['data'] : $search_filters);
		## FOR AJAX FILTER

		$new_condition = array();
		
		if(isset($search_filters[$field_name]) && !empty($search_filters[$field_name])) {
			$data = date_format(date_create($search_filters[$field_name]), 'Y-m-d');
			// $data = convert_datetime($search_filters[$field_name], 'Y-m-d');

			$new_condition = array(
				"date(".$column_name.")" => $data
			);
		}
		
		return $new_condition;
	}
	
}
?>