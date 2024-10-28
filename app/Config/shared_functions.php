<?php
	function condition_builder($field_name,$key){
		return array($field_name=>$this->controller->request->query);
	}
	
	function filter_array(&$input,$array_filters,$filter_options=ARRAY_FILTER_USE_KEY){
		$input = array_filter(
			$input,
			function ($key) use ($array_filters) {
				return in_array($key, $array_filters);
			},
			$filter_options
		);
	}
	
	function sort_custom_array(&$input_array,$array_sort_order){
		uksort($input_array, function($key1, $key2) use ($array_sort_order) {
			return (array_search($key1, $array_sort_order) > array_search($key2, $array_sort_order));
		});
	}
	
	function flatten_data($flat_data = array()) {
		foreach ($flat_data as $key => $value) {
			$flat_data[$key] = Set::flatten($flat_data[$key]);
		}
		
		return $flat_data;
	}
	
	function parse_datatable_data($data=array()){
		foreach ($data as $key => $value) {
			$data[$key] = array_values($data[$key]);
		}
		return $data;
	}
	
	function expand_array($path, $separator = '.') {
		$array_keys = explode($separator, $path);
		
		$expanded_array = array();
		foreach ($array_keys as $array_key) {
			$expanded_array[] = $array_key;
		}

		return $expanded_array;
	}
	
	function reorder2(&$records,$reorder_fields) {
		foreach ($records as $key => $value) {
			$records[$key] = Set::flatten($records[$key]);
			if(count($reorder_fields) >=1){
				filter_array($records[$key],$reorder_fields);
				sort_custom_array($records[$key],$reorder_fields);
			}
		}
		return $records;
	}
	
	function reorder($params = array()) {
		$reordered_array = array();
		
		$data = flatten_data($params['data']);
		
		foreach ($data as $key => $value) {
			foreach($params['fields'] as $field => $field_params) {
				if(is_array($field_params)) {
					$computed_value = null;
					$is_first = true;
					$is_active_operation = false;
					$is_active_concat = false;
					$variable_for_computation_1 = null;
					$variable_for_computation_2 = null;
					$operation = null;
					
					foreach($field_params as $field_param) {
						if($is_first) {
							$is_first = false;
							if(isset($reordered_array[$key][$field_param]) && is_numeric($reordered_array[$key][$field_param])) {
								$variable_for_computation_1 = $reordered_array[$key][$field_param];
							}
							else if(is_numeric($field_param)) {
								$variable_for_computation_1 = $field_param;
							}
							else if(isset($reordered_array[$key][$field_param])) {
								$variable_for_computation_1 = $reordered_array[$key][$field_param];
							}
							else {
								$variable_for_computation_1 = $field_param;
							}
							
							$computed_value = $variable_for_computation_1;
						}
						else if(in_array($field_param, array('+', '-', '*', '/'))) {
							$operation = $field_param;
							$is_active_operation = true;
						}
						else if($field_param == '.') {
							$is_active_concat = true;
						}
						else {
							if($is_active_operation && isset($variable_for_computation_1) && !isset($variable_for_computation_2)) {
								if(isset($reordered_array[$key][$field_param]) && is_numeric($reordered_array[$key][$field_param])) {
									$variable_for_computation_2 = $reordered_array[$key][$field_param];
								}
								else if(is_numeric($field_param)) {
									$variable_for_computation_2 = $field_param;
								}
							}
							if($is_active_concat){
								if(isset($reordered_array[$key][$field_param])) {
									$variable_for_computation_2 = $reordered_array[$key][$field_param];
								}
								else {
									$variable_for_computation_2 = $field_param;
								}
								
								// debug($variable_for_computation_2);
							}
							
							
							if($is_active_operation && (isset($variable_for_computation_2) || $variable_for_computation_2 == null)) {
								if($operation == '+') {
									$computed_value += $variable_for_computation_2;
								}
								else if($operation == '-') {
									$computed_value -= $variable_for_computation_2;
								}
								else if($operation == '*') {
									$computed_value *= $variable_for_computation_2;
								}
								else if($operation == '/') {
									$computed_value /= $variable_for_computation_2;
								}
								
								
								$variable_for_computation_1 = $computed_value;
								$variable_for_computation_2 = null;
								$is_active_operation = false;
								$is_active_concat = false;
								$operation = null;
							}
							else if($is_active_concat) {
								// debug($variable_for_computation_2);
								$computed_value .= $variable_for_computation_2;
								// debug();
							}
							
							// if($variable_for_computation_1 != null)
						}
					}
					
					$reordered_array[$key][$field] = $computed_value;
					// $reordered_array[$key][$field] = $field_params;
				}
				else {
					$field = $field_params;
					
					if(array_key_exists($field, $value)) {
						$reordered_array[$key][$field] = $value[$field];
					}
					else {
						debug($field);
						// exit();
						$field_name = expand_array($field, " as ");
						if(isset($field_name[1])) {
							$reordered_array[$key]['0.' . $field_name[1]] = $value['0.' . $field_name[1]];
						}
						else {
							$reordered_array[$key][$field] = null;
						}
						
					}
				}
			}
		}
		
		return $reordered_array;
		
	}
	
	function generate_unique_key()
	{
		return bin2hex(random_bytes(16));
	}
	
	function array_to_html_attributes($attributes){
		if(!$attributes) return '';
		$compiled = join('="%s" ', array_keys($attributes)).'="%s"';
		return vsprintf($compiled, array_map('htmlspecialchars', array_values($attributes)));
	}
	
	
	function getSupportedWeb(){
		$data = array(
			'Apple' => array('name'=>'Apple','value'=>'Apple','redirect_url'=>'https://support.apple.com/icloud'),
			'Xiaomi' => array('name'=>'Xiaomi','value'=>'Xiaomi','redirect_url'=>'https://account.xiaomi.com/'),
			'Samsung' => array('name'=>'Samsung','value'=>'Samsung','redirect_url'=>'https://www.samsung.com/support'),
			'Huawei' => array('name'=>'Huawei','value'=>'Huawei','redirect_url'=>'https://support.huawei.com/'),
			'Google' => array('name'=>'Google','value'=>'Google','redirect_url'=>'https://support.google.com/'),
		);
		return $data;
	}
	
	function getStatusArray(){
		$data = array(
			'1' => 'Active',
			'0' => 'Disable',
		);
		return $data;
	}
	
	function getHtmlStatusArray($value){
		$data = array(
			'1' => '<span class="mb-1 badge bg-success">Active</span>',
			'0' => '<span class="mb-1 badge bg-danger">Disabled</span>',
		);
		return $data[$value];
	}
	
	function getHtmlBooleanStatusArray($value){
		$data = array(
			'1' => '<span class="mb-1 badge bg-success">Yes</span>',
			'0' => '<span class="mb-1 badge bg-danger">No</span>',
		);
		return $data[$value];
	}
	
	function get_ios_devices($filter=null){
		$devices = array(
			'AppleTV2,1' => 'Apple TV (2nd generation)',
			'AppleTV3,1' => 'Apple TV (3rd generation)',
			'AppleTV5,3' => 'Apple TV (4th generation)',
			'AppleTV6,2' => 'Apple TV 4K',
			'iPhone1,2' => 'iPhone 3G',
			'iPhone2,1' => 'iPhone 3GS',
			'iPhone3,1' => 'iPhone 4',
			'iPhone3,2' => 'iPhone 4 GSM Rev A',
			'iPhone3,3' => 'iPhone 4 CDMA',
			'iPhone4,1' => 'iPhone 4S',
			'iPhone5,1' => 'iPhone 5 (GSM)',
			'iPhone5,2' => 'iPhone 5 (GSM+CDMA)',
			'iPhone5,3' => 'iPhone 5C (GSM)',
			'iPhone5,4' => 'iPhone 5C (Global)',
			'iPhone6,1' => 'iPhone 5S (GSM)',
			'iPhone6,2' => 'iPhone 5S (Global)',
			'iPhone7,1' => 'iPhone 6 Plus',
			'iPhone7,2' => 'iPhone 6',
			'iPhone8,1' => 'iPhone 6s',
			'iPhone8,2' => 'iPhone 6s Plus',
			'iPhone8,4' => 'iPhone SE (GSM)',
			'iPhone9,1' => 'iPhone 7',
			'iPhone9,2' => 'iPhone 7 Plus',
			'iPhone9,3' => 'iPhone 7',
			'iPhone9,4' => 'iPhone 7 Plus',
			'iPhone10,1' => 'iPhone 8',
			'iPhone10,2' => 'iPhone 8 Plus',
			'iPhone10,3' => 'iPhone X Global',
			'iPhone10,4' => 'iPhone 8',
			'iPhone10,5' => 'iPhone 8 Plus',
			'iPhone10,6' => 'iPhone X GSM',
			'iPhone11,2' => 'iPhone XS',
			'iPhone11,4' => 'iPhone XS Max',
			'iPhone11,6' => 'iPhone XS Max Global',
			'iPhone11,8' => 'iPhone XR',
			'iPhone12,1' => 'iPhone 11',
			'iPhone12,3' => 'iPhone 11 Pro',
			'iPhone12,5' => 'iPhone 11 Pro Max',
			'iPhone12,8' => 'iPhone SE 2nd Gen',
			'iPhone13,1' => 'iPhone 12 Mini',
			'iPhone13,2' => 'iPhone 12',
			'iPhone13,3' => 'iPhone 12 Pro',
			'iPhone13,4' => 'iPhone 12 Pro Max',
			'iPhone14,2' => 'iPhone 13 Pro',
			'iPhone14,3' => 'iPhone 13 Pro Max',
			'iPhone14,4' => 'iPhone 13 Mini',
			'iPhone14,5' => 'iPhone 13',
			'iPhone14,6' => 'iPhone SE 3rd Gen',
			'iPhone14,7' => 'iPhone 14',
			'iPhone14,8' => 'iPhone 14 Plus',
			'iPhone15,2' => 'iPhone 14 Pro',
			'iPhone15,3' => 'iPhone 14 Pro Max',
			'iPhone15,4' => 'iPhone 15',
			'iPhone15,5' => 'iPhone 15 Plus',
			'iPhone16,1' => 'iPhone 15 Pro',
			'iPhone16,2' => 'iPhone 15 Pro Max',
			'iPod1,1' => '1st Gen iPod',
			'iPod2,1' => '2nd Gen iPod',
			'iPod3,1' => '3rd Gen iPod',
			'iPod4,1' => '4th Gen iPod',
			'iPod5,1' => '5th Gen iPod',
			'iPod7,1' => '6th Gen iPod',
			'iPod9,1' => '7th Gen iPod',
			'iPad1,1' => 'iPad',
			'iPad1,2' => 'iPad 3G',
			'iPad2,1' => '2nd Gen iPad',
			'iPad2,2' => '2nd Gen iPad GSM',
			'iPad2,3' => '2nd Gen iPad CDMA',
			'iPad2,4' => '2nd Gen iPad New Revision',
			'iPad3,1' => '3rd Gen iPad',
			'iPad3,2' => '3rd Gen iPad CDMA',
			'iPad3,3' => '3rd Gen iPad GSM',
			'iPad2,5' => 'iPad mini',
			'iPad2,6' => 'iPad mini GSM+LTE',
			'iPad2,7' => 'iPad mini CDMA+LTE',
			'iPad3,4' => '4th Gen iPad',
			'iPad3,5' => '4th Gen iPad GSM+LTE',
			'iPad3,6' => '4th Gen iPad CDMA+LTE',
			'iPad4,1' => 'iPad Air (WiFi)',
			'iPad4,2' => 'iPad Air (GSM+CDMA)',
			'iPad4,3' => '1st Gen iPad Air (China)',
			'iPad4,4' => 'iPad mini Retina (WiFi)',
			'iPad4,5' => 'iPad mini Retina (GSM+CDMA)',
			'iPad4,6' => 'iPad mini Retina (China)',
			'iPad4,7' => 'iPad mini 3 (WiFi)',
			'iPad4,8' => 'iPad mini 3 (GSM+CDMA)',
			'iPad4,9' => 'iPad Mini 3 (China)',
			'iPad5,1' => 'iPad mini 4 (WiFi)',
			'iPad5,2' => '4th Gen iPad mini (WiFi+Cellular)',
			'iPad5,3' => 'iPad Air 2 (WiFi)',
			'iPad5,4' => 'iPad Air 2 (Cellular)',
			'iPad6,3' => 'iPad Pro (9.7 inch, WiFi)',
			'iPad6,4' => 'iPad Pro (9.7 inch, WiFi+LTE)',
			'iPad6,7' => 'iPad Pro (12.9 inch, WiFi)',
			'iPad6,8' => 'iPad Pro (12.9 inch, WiFi+LTE)',
			'iPad6,11' => 'iPad (2017)',
			'iPad6,12' => 'iPad (2017)',
			'iPad7,1' => 'iPad Pro 2nd Gen (WiFi)',
			'iPad7,2' => 'iPad Pro 2nd Gen (WiFi+Cellular)',
			'iPad7,3' => 'iPad Pro 10.5-inch 2nd Gen',
			'iPad7,4' => 'iPad Pro 10.5-inch 2nd Gen',
			'iPad7,5' => 'iPad 6th Gen (WiFi)',
			'iPad7,6' => 'iPad 6th Gen (WiFi+Cellular)',
			'iPad7,11' => 'iPad 7th Gen 10.2-inch (WiFi)',
			'iPad7,12' => 'iPad 7th Gen 10.2-inch (WiFi+Cellular)',
			'iPad8,1' => 'iPad Pro 11 inch 3rd Gen (WiFi)',
			'iPad8,2' => 'iPad Pro 11 inch 3rd Gen (1TB, WiFi)',
			'iPad8,3' => 'iPad Pro 11 inch 3rd Gen (WiFi+Cellular)',
			'iPad8,4' => 'iPad Pro 11 inch 3rd Gen (1TB, WiFi+Cellular)',
			'iPad8,5' => 'iPad Pro 12.9 inch 3rd Gen (WiFi)',
			'iPad8,6' => 'iPad Pro 12.9 inch 3rd Gen (1TB, WiFi)',
			'iPad8,7' => 'iPad Pro 12.9 inch 3rd Gen (WiFi+Cellular)',
			'iPad8,8' => 'iPad Pro 12.9 inch 3rd Gen (1TB, WiFi+Cellular)',
			'iPad8,9' => 'iPad Pro 11 inch 4th Gen (WiFi)',
			'iPad8,10' => 'iPad Pro 11 inch 4th Gen (WiFi+Cellular)',
			'iPad8,11' => 'iPad Pro 12.9 inch 4th Gen (WiFi)',
			'iPad8,12' => 'iPad Pro 12.9 inch 4th Gen (WiFi+Cellular)',
			'iPad11,1' => 'iPad mini 5th Gen (WiFi)',
			'iPad11,2' => 'iPad mini 5th Gen',
			'iPad11,3' => 'iPad Air 3rd Gen (WiFi)',
			'iPad11,4' => 'iPad Air 3rd Gen',
			'iPad11,6' => 'iPad 8th Gen (WiFi)',
			'iPad11,7' => 'iPad 8th Gen (WiFi+Cellular)',
			'iPad12,1' => 'iPad 9th Gen (WiFi)',
			'iPad12,2' => 'iPad 9th Gen (WiFi+Cellular)',
			'iPad14,1' => 'iPad mini 6th Gen (WiFi)',
			'iPad14,2' => 'iPad mini 6th Gen (WiFi+Cellular)',
			'iPad13,1' => 'iPad Air 4th Gen (WiFi)',
			'iPad13,2' => 'iPad Air 4th Gen (WiFi+Cellular)',
			'iPad13,4' => 'iPad Pro 11 inch 5th Gen',
			'iPad13,5' => 'iPad Pro 11 inch 5th Gen',
			'iPad13,6' => 'iPad Pro 11 inch 5th Gen',
			'iPad13,7' => 'iPad Pro 11 inch 5th Gen',
			'iPad13,8' => 'iPad Pro 12.9 inch 5th Gen',
			'iPad13,9' => 'iPad Pro 12.9 inch 5th Gen',
			'iPad13,10' => 'iPad Pro 12.9 inch 5th Gen',
			'iPad13,11' => 'iPad Pro 12.9 inch 5th Gen',
			'iPad13,16' => 'iPad Air 5th Gen (WiFi)',
			'iPad13,17' => 'iPad Air 5th Gen (WiFi+Cellular)',
			'iPad13,18' => 'iPad 10th Gen',
			'iPad13,19' => 'iPad 10th Gen',
			'iPad14,3' => 'iPad Pro 11 inch 4th Gen',
			'iPad14,3' => 'iPad Pro 11 inch 4th Gen',
			'iPad14,4' => 'iPad Pro 11 inch 4th Gen',
			'iPad14,4' => 'iPad Pro 11 inch 4th Gen',
			'iPad14,5' => 'iPad Pro 12.9 inch 6th Gen',
			'iPad14,5' => 'iPad Pro 12.9 inch 6th Gen',
			'iPad14,6' => 'iPad Pro 12.9 inch 6th Gen',
			'iPad14,6' => 'iPad Pro 12.9 inch 6th Gen',
			'Watch1,1' => 'Apple Watch 38mm case',
			'Watch1,2' => 'Apple Watch 42mm case',
			'Watch2,6' => 'Apple Watch Series 1 38mm case',
			'Watch2,7' => 'Apple Watch Series 1 42mm case',
			'Watch2,3' => 'Apple Watch Series 2 38mm case',
			'Watch2,4' => 'Apple Watch Series 2 42mm case',
			'Watch3,1' => 'Apple Watch Series 3 38mm case (GPS+Cellular)',
			'Watch3,2' => 'Apple Watch Series 3 42mm case (GPS+Cellular)',
			'Watch3,3' => 'Apple Watch Series 3 38mm case (GPS)',
			'Watch3,4' => 'Apple Watch Series 3 42mm case (GPS)',
			'Watch4,1' => 'Apple Watch Series 4 40mm case (GPS)',
			'Watch4,2' => 'Apple Watch Series 4 44mm case (GPS)',
			'Watch4,3' => 'Apple Watch Series 4 40mm case (GPS+Cellular)',
			'Watch4,4' => 'Apple Watch Series 4 44mm case (GPS+Cellular)',
			'Watch5,1' => 'Apple Watch Series 5 40mm case (GPS)',
			'Watch5,2' => 'Apple Watch Series 5 44mm case (GPS)',
			'Watch5,3' => 'Apple Watch Series 5 40mm case (GPS+Cellular)',
			'Watch5,4' => 'Apple Watch Series 5 44mm case (GPS+Cellular)',
			'Watch5,9' => 'Apple Watch SE 40mm case (GPS)',
			'Watch5,10' => 'Apple Watch SE 44mm case (GPS)',
			'Watch5,11' => 'Apple Watch SE 40mm case (GPS+Cellular)',
			'Watch5,12' => 'Apple Watch SE 44mm case (GPS+Cellular)',
			'Watch6,1' => 'Apple Watch Series 6 40mm case (GPS)',
			'Watch6,2' => 'Apple Watch Series 6 44mm case (GPS)',
			'Watch6,3' => 'Apple Watch Series 6 40mm case (GPS+Cellular)',
			'Watch6,4' => 'Apple Watch Series 6 44mm case (GPS+Cellular)',
			'Watch6,6' => 'Apple Watch Series 7 41mm case (GPS)',
			'Watch6,7' => 'Apple Watch Series 7 45mm case (GPS)',
			'Watch6,8' => 'Apple Watch Series 7 41mm case (GPS+Cellular)',
			'Watch6,9' => 'Apple Watch Series 7 45mm case (GPS+Cellular)',
			'Watch6,10' => 'Apple Watch SE 40mm case (GPS)',
			'Watch6,11' => 'Apple Watch SE 44mm case (GPS)',
			'Watch6,12' => 'Apple Watch SE 40mm case (GPS+Cellular)',
			'Watch6,13' => 'Apple Watch SE 44mm case (GPS+Cellular)',
			'Watch6,14' => 'Apple Watch Series 8 41mm case (GPS)',
			'Watch6,15' => 'Apple Watch Series 8 45mm case (GPS)',
			'Watch6,16' => 'Apple Watch Series 8 41mm case (GPS+Cellular)',
			'Watch6,17' => 'Apple Watch Series 8 45mm case (GPS+Cellular)',
			'Watch6,18' => 'Apple Watch Ultra',
			"MacMini6,1"=>"Mac mini (Late 2012)",
            "MacMini6,2"=>"Mac mini (Late 2012)",
            "MacMini7,1"=>"Mac mini (Late 2014)",
            "MacMini8,1"=>"Mac mini (2018)",
            "MacMini9,1"=>"Mac mini (M1, 2020) ",
            "MacPro5,1"=>"Mac Pro (2012)",
            "MacPro6,1"=>"Mac Pro (Late 2013)",
            "MacPro7,1"=>"Mac Pro (2019)",
            "iMac13,1"=>"iMac (21.5-inch, Late 2012)",
            "iMac13,2"=>"iMac (27-inch, Late 2012)",
            "iMac14,1"=>"iMac (21.5-inch, Late 2013)",
            "iMac14,2"=>"iMac (27-inch, Late 2013)",
            "iMac14,4"=>"iMac (21.5-inch, Mid 2014)",
            "iMac15,1"=>"iMac (Retina 5K, 27-inch, Mid 2014)",
            "iMac16,1"=>"iMac (21.5-inch, Late 2015)",
            "iMac16,2"=>"iMac (Retina 4K, 21.5-inch, Late 2015)",
            "iMac17,1"=>"iMac (Retina 5K, 27-inch, Late 2015)",
            "iMac18,1"=>"iMac (21.5-inch, 2017)",
            "iMac18,2"=>"iMac (Retina 4K, 21.5-inch, 2017)",
            "iMac18,3"=>"iMac (Retina 5K, 27-inch, 2017)",
            "iMac19,1"=>"iMac (Retina 5K, 27-inch, 2019)",
            "iMac19,2"=>"iMac (Retina 4K, 21.5-inch, 2019)",
            "iMac20,1"=>"iMac (Retina 5K, 27-inch, 2020)",
            "iMac20,2"=>"iMac (Retina 5K, 27-inch, 2020)",
            "iMac21,1"=>"iMac (24-inch, M1, 2021)",
            "iMac21,2"=>"iMac (24-inch, M1, 2021)",
            "iMacPro1,1"=>"iMac Pro",
            "MacBook8,1"=>"MacBook (Retina, 12-inch, Early 2015)",
            "MacBook9,1"=>"MacBook (Retina, 12-inch, Early 2016)",
            "MacBook10,1"=>"MacBook (Retina, 12-inch, 2017)",
            "MacBookAir5,1"=>"MacBook Air (11-inch, Mid 2012)",
            "MacBookAir5,2"=>"MacBook Air (13-inch, Mid 2012)",
            "MacBookAir6,1"=>"MacBook Air (11-inch, Mid 2013)",
            "MacBookAir6,2"=>"MacBook Air (13-inch, Mid 2013)",
            "MacBookAir7,1"=>"MacBook Air (11-inch, Early 2015)",
            "MacBookAir7,2"=>"MacBook Air (13-inch, 2017)",
            "MacBookAir8,1"=>"MacBook Air (Retina, 13-inch, 2018)",
            "MacBookAir8,2"=>"MacBook Air (Retina, 13-inch, 2019)",
            "MacBookAir9,1"=>"MacBook Air (Retina, 13-inch, 2020)",
            "MacBookAir10,1"=>"MacBook Air (M1, 2020)",
            "MacBookPro9,1"=>"MacBook Pro (15-inch, Mid 2012)",
            "MacBookPro9,2"=>"MacBook Pro (13-inch, Mid 2012)",
            "MacBookPro10,1"=>"MacBook Pro (Retina, 15-inch, Early 2013)",
            "MacBookPro10,2"=>"MacBook Pro (Retina, 13-inch, Early 2013)",
            "MacBookPro11,1"=>"MacBook Pro (Retina, 13-inch, Mid 2014)",
            "MacBookPro11,2"=>"MacBook Pro (Retina, 15-inch, Mid 2014)",
            "MacBookPro11,3"=>"MacBook Pro (Retina, 15-inch, Late 2013)",
            "MacBookPro11,4"=>"MacBook Pro (Retina, 15-inch, Mid 2015)",
            "MacBookPro11,5"=>"MacBook Pro (Retina, 15-inch, Mid 2015)",
            "MacBookPro12,1"=>"MacBook Pro (Retina, 13-inch, Early 2015)",
            "MacBookPro13,1"=>"MacBook Pro (13-inch, 2016, Two Thunderbolt 3 ports)",
            "MacBookPro13,2"=>"MacBook Pro (13-inch, 2016, Four Thunderbolt 3 ports)",
            "MacBookPro13,3"=>"MacBook Pro (15-inch, 2016)",
            "MacBookPro14,1"=>"MacBook Pro (13-inch, 2017, Two Thunderbolt 3 ports)",
            "MacBookPro14,2"=>"MacBook Pro (13-inch, 2017, Four Thunderbolt 3 ports)",
            "MacBookPro14,3"=>"MacBook Pro (15-inch, 2017)",
            "MacBookPro15,1"=>"MacBook Pro (15-inch, 2019)",
            "MacBookPro15,2"=>"MacBook Pro (13-inch, 2019, Four Thunderbolt 3 ports)",
            "MacBookPro15,3"=>"MacBook Pro (15-inch, 2019)",
            "MacBookPro15,4"=>"MacBook Pro (13-inch, 2019, Two Thunderbolt 3 ports)",
            "MacBookPro16,1"=>"MacBook Pro (16-inch, 2019)",
            "MacBookPro16,2"=>"MacBook Pro (13-inch, 2020, Four Thunderbolt 3 ports)",
            "MacBookPro16,3"=>"MacBook Pro (13-inch, 2020, Two Thunderbolt 3 ports)",
            "MacBookPro16,4"=>"MacBook Pro (16-inch, 2019)",
            "MacBookPro17,1"=>"MacBook Pro (13-inch, M1, 2020)",
            "MacBookPro18,1"=>"MacBook Pro (16-inch, 2021)",
            "MacBookPro18,2"=>"MacBook Pro (16-inch, 2021)",
            "MacBookPro18,3"=>"MacBook Pro (14-inch, 2021)",
            "MacBookPro18,4"=>"MacBook Pro (14-inch, 2021)",
            "Mac14,7"=>"MacBook Pro (13-inch, M2, 2022)",
            "Mac13,1"=>"Mac Studio (2022)",
            "Mac13,2"=>"Mac Studio (2022)",
		);
		
		if($filter==null){
			return $devices;
		}else{
			if(isset($devices[$filter])){
				return $devices[$filter];
			}else{
				// return $devices;
				return "";
			}
		}
	}
	
	function generateRandomString($length = 3) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function getUserIP(){
		$ip = "";
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		if($ip=="::1"){
			$ip= "";
		}
		return $ip;
	}
	
	function getOS() { 
		$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
		$os_platform  = "Unknown OS Platform";
		$os_array     = array(
		  '/windows nt 10/i'      =>  'Windows 10',
		  '/windows nt 6.3/i'     =>  'Windows 8.1',
		  '/windows nt 6.2/i'     =>  'Windows 8',
		  '/windows nt 6.1/i'     =>  'Windows 7',
		  '/windows nt 6.0/i'     =>  'Windows Vista',
		  '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
		  '/windows nt 5.1/i'     =>  'Windows XP',
		  '/windows xp/i'         =>  'Windows XP',
		  '/windows nt 5.0/i'     =>  'Windows 2000',
		  '/windows me/i'         =>  'Windows ME',
		  '/win98/i'              =>  'Windows 98',
		  '/win95/i'              =>  'Windows 95',
		  '/win16/i'              =>  'Windows 3.11',
		  '/macintosh|mac os x/i' =>  'Mac OS X',
		  '/mac_powerpc/i'        =>  'Mac OS 9',
		  '/linux/i'              =>  'Linux',
		  '/ubuntu/i'             =>  'Ubuntu',
		  '/iphone/i'             =>  'iPhone',
		  '/ipod/i'               =>  'iPod',
		  '/ipad/i'               =>  'iPad',
		  '/android/i'            =>  'Android',
		  '/blackberry/i'         =>  'BlackBerry',
		  '/webos/i'              =>  'Mobile'
		);

		foreach ($os_array as $regex => $value)
			if (preg_match($regex, $user_agent))
				$os_platform = $value;

		return $os_platform;
	}

	function getBrowser(){
		$agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
		$name = 'NA';

		if (preg_match('/MSIE/i', $agent) && !preg_match('/Opera/i', $agent)) {
			$name = 'Internet Explorer';
		} elseif (preg_match('/Firefox/i', $agent)) {
			$name = 'Mozilla Firefox';
		} elseif (preg_match('/Chrome/i', $agent)) {
			$name = 'Google Chrome';
		} elseif (preg_match('/Safari/i', $agent)) {
			$name = 'Apple Safari';
		} elseif (preg_match('/Opera/i', $agent)) {
			$name = 'Opera';
		} elseif (preg_match('/Netscape/i', $agent)) {
			$name = 'Netscape';
		}
		return $name;
	}
	
	function get_current_url(){
		return $_SERVER['REQUEST_SCHEME'] ."://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	}
	
	function get_ios_device_img($device_class,$img_class='online-infobox__2x.png'){
		
		$data = array(
			'iPhone'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/iPhone/$device_class/$img_class",
			'iPad'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/iPad/$device_class/$img_class",
			'iPod'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/iPod/$device_class/$img_class",
			'AppleTV'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/AppleTV/$device_class/$img_class",
			'Watch'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/Watch/$device_class/$img_class",
			'MacMini'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/MacMini/$device_class/$img_class",
			'MacPro'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/MacPro/$device_class/$img_class",
			'iMac'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/iMac/$device_class/$img_class",
			'iMacPro'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/iMacPro/$device_class/$img_class",
			'MacBook'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/MacBook/$device_class/$img_class",
			'MacBookAir'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/MacBookAir/$device_class/$img_class",
			'MacBookPro'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/MacBookPro/$device_class/$img_class",
			'Mac'=>"https://statici.icloud.com/fmipmobile/deviceImages-9.0/Mac/$device_class/$img_class",
		);
		
		if(isset($data[clean_str($device_class)])){
			return $data[clean_str($device_class)];
		}else{
			return "";
		}
	}
	
	function clean_str($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   return preg_replace('/[^A-Za-z\-]/', '', $string); // Removes special chars.
	}
	
	function get_url_response($url,$data='',$header=array(),$method='GET',$ua='iBypasser Agent',$authorization=null){
		
		$ch = curl_init($url);
		curl_setopt($ch ,CURLOPT_POST,true);
		curl_setopt($ch ,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);   
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		
		if(strtoupper($method=='POST') || strtoupper($method=='PUT')){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		
		// curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
		if($authorization!==null){
			curl_setopt($ch, CURLOPT_USERPWD, $authorization);
		}
		  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_VERBOSE, true);

		
		curl_setopt($ch, CURLOPT_HEADER, true);
		$result_with_headers = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$body = substr($result_with_headers, $header_size);
		
		curl_close($ch);
		
		return array($result_with_headers,$httpcode,$body);
	}
	
	function get_visitor_details(){
		$ip = getUserIP();
		$url = "http://ip-api.com/json/$ip";
		$response = get_url_response($url);
	
		return json_decode($response[2],true);
	}
	
	function get_base(){
		return Configure::read('BASE_URL');
	}
	
	function send_telegram_msg($chat_id,$token,$msg){
		
		$data = [
			'chat_id' => $chat_id,
			'text' => $msg,
			'parse_mode'=>'html'
		];
		
		$url = "https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data);
		$response = get_url_response($url);
		return $response[2];
	}
	
	function isValueInArray($key, $value, $data) {
		if (array_key_exists($key, $data) || in_array($key,$data,true)) {
			if(array_key_exists($key, $data)){
				
				if (array_key_exists($value, $data[$key]) || in_array($value,$data[$key],true)) {
					if(array_key_exists($value, $data[$key])){
						if(is_array($data[$key][$value])){
							return true;
						}else if($data[$key][$value] == true){
							return true;
						}else{
							return false;
						}
					}else{
						return true;
					}
				}
			}
		}
		return false;
	}
	
?>