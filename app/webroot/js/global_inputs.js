function convert_phone_input(temp_id){
	var selected_country = $('.phone-input[temp_id="' + temp_id + '"]').parent().parent().find('.selected_country_iso').val();
	if(typeof selected_country === undefined || selected_country.trim() === ''){
		selected_country = 'us';
	}

	$('.phone-input[temp_id="' + temp_id + '"]').intlTelInput({
		initialCountry: selected_country,
		nationalMode: false,
		showSelectedDialCode: true,
		formatAsYouType: false,
		autoPlaceholder: 'aggressive',
		countrySearch: true,
		fixDropdownWidth: true,
		formatOnDisplay: false,
		customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
			return selectedCountryPlaceholder.replace(/[^0-9]/g, '');;
		},
		utilsScript: '../template/libs/intl-tel-input/js/utils.js',
	});
}

$(document).ready(function() { 
	//phone inputs
	$('.phone-input:not([temp_id])').intlTelInput({
			initialCountry: 'us',
			nationalMode: false,
			showSelectedDialCode: true,
			formatAsYouType: false,
			autoPlaceholder: 'aggressive',
			countrySearch: true,
			fixDropdownWidth: true,
			formatOnDisplay: false,
			customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
				return selectedCountryPlaceholder.replace(/[^0-9]/g, '');;
			},
			utilsScript: '../template/libs/intl-tel-input/js/utils.js',
	});
	
	$(document).on('countrychange','.phone-input',function(){
		try{
			var iti = $(this).intlTelInput("getSelectedCountryData");
			var country_name_field = $(this).parent().parent().find('.selected_country_name');
			var country_iso_field = $(this).parent().parent().find('.selected_country_iso');
			var country_code_field = $(this).parent().parent().find('.selected_country_code');
			
			$(country_name_field).val(iti.name).trigger('change');
			$(country_iso_field).val(iti.iso2).trigger('change');
			$(country_code_field).val(iti.dialCode).trigger('change');
		}catch(e){
		}
	});
	$('.phone-input').trigger('countrychange');
	
	//basic form inputs
	$(".datepicker").prop("type", "date");
	$(".daterange").daterangepicker({showDropdowns: true,autoApply: true});
	// $(".autoapply").daterangepicker({
		// autoApply: true,
	// });

	//select2
	$('select[prevent-chosen!="1"]').each(function(){
		var select_element = $(this);
		var modal_parent = select_element.closest('.modal');
		
		if(modal_parent.length >= 1){
			select_element.select2({ 
				dropdownPosition: 'below', 
				width: '100%',
				dropdownParent: modal_parent,
				escapeMarkup: function(markup) {
					return markup; // Allow HTML in dropdown
				},
				templateResult: function(data) {
					if (!data.id) { return data.text; } // Return if no data id
					var $html = $(data.element).data('html');
					return $html ? $html : data.text; // Render HTML if available
				},
				templateSelection: function(data) {
					return data.text; // Keep selection text as plain text
				}
			});
		}else{
			select_element.select2({ 
				dropdownPosition: 'below', 
				width: '100%',
				escapeMarkup: function(markup) {
					return markup; // Allow HTML in dropdown
				},
				templateResult: function(data) {
					if (!data.id) { return data.text; } // Return if no data id
					var $html = $(data.element).data('html');
					return $html ? $html : data.text; // Render HTML if available
				},
				templateSelection: function(data) {
					return data.text; // Keep selection text as plain text
				}
			});
		}
	});
	
	
	$('.daterange').on('change',function(){
		var start_field = $(this).parent().find('.daterange_start');
		var end_field = $(this).parent().find('.daterange_end');
		
		var start_date = $(this).data('daterangepicker').startDate.format('YYYY-MM-DD');
		var end_date = $(this).data('daterangepicker').endDate.format('YYYY-MM-DD');
		
		start_field.val(start_date);
		end_field.val(end_date);
	});
	
	
});