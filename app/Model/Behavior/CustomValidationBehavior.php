<?php
class CustomValidationBehavior extends ModelBehavior {
	
	public function equalToField(&$model, $data_for_validation = '', $field_name_to_compare_1 = '', $field_name_to_compare_2 = '') {
		if($model->data[$model->name][$field_name_to_compare_1] === $model->data[$model->name][$field_name_to_compare_2]) {
			return true;
		}

		return false;
    }
	
	public function noFutureDateTime(&$model, $data_for_validation = '', $field_name_to_compare_1 = '', $from_format = 'm/d/Y H:i:s') {
		$compare_datetime = convert_datetime_from_format($model->data[$model->name][$field_name_to_compare_1], $from_format);
		$current_datetime = get_datetime_now('Y-m-d H:i:s');
		
		if($compare_datetime <= $current_datetime) {
			 return true;
		}

		return false;
	}
	
	public function noFutureDate(&$model, $data_for_validation = '', $field_name_to_compare_1 = '', $from_format = 'm/d/Y') {
		$compare_date = convert_datetime_from_format($model->data[$model->name][$field_name_to_compare_1], $from_format);
		$current_date = get_datetime_now('Y-m-d');

		if($compare_date <= $current_date) {
			 return true;
		}

		return false;
	}
	
	public function inApplicationSettingsList(&$model, $data_for_validation = '', $field_name_to_compare_1 = '', $field_name_to_get_in_application_settings = '') {
		return array_key_exists($model->data[$model->name][$field_name_to_compare_1], Configure::read($field_name_to_get_in_application_settings));
    }
	
	public function noNegativeNumber(&$model, $data_for_validation, $field_name_to_compare_1, $allow_zero) {
		if(is_numeric($model->data[$model->name][$field_name_to_compare_1])) {
			if($allow_zero) {
				if($model->data[$model->name][$field_name_to_compare_1] >= 0) {
					return true;
				}
			}
			else {
				if($model->data[$model->name][$field_name_to_compare_1] > 0) {
					return true;
				}
			}
		}

		return false;
    }
	
	public function maxDecimalPlaces(&$model, $data_for_validation, $field_name_to_compare_1, $no_of_decimal_places) {
		if(is_numeric($model->data[$model->name][$field_name_to_compare_1])) {
			$numeric = explode('.', $model->data[$model->name][$field_name_to_compare_1]);

			if(isset($numeric[1])) {
				if(strlen($numeric[1]) <= $no_of_decimal_places) {
					return true;
				}
			}
			else {
				return true;
			}
		}

		return false;
    }
}