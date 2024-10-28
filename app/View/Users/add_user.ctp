<?php
	$current_url_parts = $this->request->params;
	$default_title = Inflector::humanize($this->request->params['action']);
	$default_controller_title = Inflector::humanize($this->request->params['controller']);
	
	echo $this->ModernizeComponent->create_page_header_title($default_title,$default_controller_title);
  ?>
  
<?php
    echo $this->Form->create('EmployeeIncomeAndBenefit');
    $this->ModernizeComponent->create_page_container_start('');
        $employee_list = array(
            '1' => 'Randolf',
            '2' => 'Gyro',
            '3' => 'Marvin',
        );
        echo  $this->ModernizeComponent->create_form_basic_input_batch(array(
            array(
                'size' => 6,
                'contents' => array(
					
                    array('employee_code', 12,array('label' => 'Employee Name','required','type'=>'select'),$employee_list),
                    array('birth_date', 12, array('label' => 'Birthdate', 'placeholder' => 'Birthdate','template' => 'date')),
                    array('laundry_allowance1',12, array('label' => 'Laundry Allowance')),
                    array('amount',12, array('label' => 'Amount','type' => 'number')),
                    array('remarks2',12, array('label' => 'Remarks', 'placeholder' => 'Remarks','type' => 'textarea')),
                    array('', 12, array('type' => 'checkbox'),
                        array(
                            'list_box' => array(
                                'option_1' => 'This Is Check box 1',
                                'option_2' => 'This Is Check box 2',
                                'option_3' => 'This Is Check box 3',
                                'option_4' => 'This Is Check box 4',
                            )
                        ),
                        
                    ),
					array('date_range_auto_apply',12, array('label' => 'Date From and To','type' => 'text','template' => 'date_range','autoapply')),
                    array('date_range',12, array('label' => 'Date From and To','type' => 'text','template' => 'date_range')),
                    
                )
            ),
        ));
    $this->ModernizeComponent->create_button_line_container_start();
        $this->ModernizeComponent->create_submit_button('Save');
        $this->ModernizeComponent->create_link_button('Back', array('controller' => 'income_and_benefits', 'action' => 'index'), array('template' => 'danger'));
    $this->ModernizeComponent->create_button_line_container_end();

    $this->ModernizeComponent->create_page_container_end();
    echo $this->Form->end();	
?>
<script>
    $(".daterange").daterangepicker();
    $(".autoapply").daterangepicker({
      autoApply: true,
    });
</script>