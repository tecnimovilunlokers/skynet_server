<?php
App::uses('Model', 'Model');

class UserSubscription extends AppModel {
	public $audit_model = 'UserSubscription';
	public $audit_module = 'UserSubscription';
	public $audit_singular_alias = 'UserSubscription';
	public $audit_plural_alias = 'UserSubscriptions';
	
	public $virtualFields = array(
		'status_desc' => "CASE UserSubscription.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
		'remaining_days' => 'DATEDIFF(UserSubscription.subscription_end, CURDATE())',
	);
	
	public $validate = array(
        'id' => array(
			'validation 1' => array(
				'required' => 'update',
				'rule' => array('notBlank'),
				'message'	=> 'ID is required and must not be empty.'
			),
			'validation 2' => array(
				'rule' => array('naturalNumber'),
				'message'	=> 'ID must be a non-decimal number that is greater than zero.'
			),
			'validation 3' => array(
				'rule' => array('isUnique'),
				'message'	=> 'ID is already existing.'
			)
        ),
		'user_id' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'User is required and must not be empty.'
			),
			'validation 2' => array(
				'rule' => array('isUnique'),
				'message'	=> 'User is already exist.'
			)
        ),
	);
	
	public $hasOne = array(
	  
	);
	
	public $belongsTo = array(
		'AddedBy' => array(
			'className' => 'User',
			'foreignKey' => 'created_by',
			'fields' => array(
				'AddedBy.id',
				'AddedBy.username', 
				'AddedBy.role', 
			),
		),
		'Subscriber' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'fields' => array(
				'Subscriber.id',
				'Subscriber.username', 
				'Subscriber.role', 
			),
		),
	);
	
	public $hasMany = array(
		
	);
	
	public function beforeFind($queryData) {
		$fields = array('UserSubscription.subscription_status' => "'Expired'");
		$conditions = array(
			'DATE(UserSubscription.subscription_end) <= CURDATE()',
			'UserSubscription.subscription_status' => 'Active',
		);
		$this->updateAll($fields,$conditions);
	}
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['UserSubscription']['id'])) {
		   $this->data['UserSubscription']['created_by'] = $_SESSION['Auth']['User']['id']; 
		   $this->data['UserSubscription']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}else{
		   $this->data['UserSubscription']['modified_by'] = $_SESSION['Auth']['User']['id']; 
		}
		return true;
	}
	
	
}