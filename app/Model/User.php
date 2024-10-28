<?php
App::uses('Model', 'Model');
App::uses('CakeTime','Utility');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $displayField = 'username';
	
	public $audit_model = 'User';
	public $audit_module = 'User';
	public $audit_singular_alias = 'User';
	public $audit_plural_alias = 'Users';
	
	public $virtualFields = array(
		'online_status' => "CASE WHEN TIMESTAMPDIFF(MINUTE,User.last_seen,NOW()) >=5 OR User.last_seen IS NULL THEN 'Offline' ELSE 'Online' END",
		'status_desc' => "CASE User.status WHEN 1 THEN 'Active' ELSE 'Disabled' END",
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
		'username' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Username is required and must not be empty.'
			),
			'validation 2' => array(
				'rule' => array('alphaNumeric'),
				'message'	=> 'Username must be in alphabets and numbers only.'
			),
			'validation 3' => array(
				'rule' => array('lengthBetween', 5, 20),
				'message'	=> 'Username must be 5 to 20 characters long.'
			),
			'validation 4' => array(
				'rule' => array('isUnique'),
				'message'	=> 'Username is already taken.'
			)
        ),
		'chat_id' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Chat ID is required and must not be empty.'
			),
			'validation 2' => array(
				'rule' => array('numeric'),
				'message'	=> 'Chat ID must be in numbers only.'
			),
			'validation 3' => array(
				'rule' => array('isUnique'),
				'message'	=> 'Chat ID is already taken.'
			)
        ),
		'email' => array(
				'rule' => array('email', true),
				'message' => 'Please supply a valid email address.'
		),
		'password' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Password is required and must not be empty.'
			),
			'validation 3' => array(
				'rule' => array('lengthBetween', 5, 20),
				'message'	=> 'Password must be 5 to 20 characters long.'
			),
			'validation 4' => array(
				'required' => 'create',
				'on' => 'create',
				'rule' => array('equalToField', 'password', 'confirm_password'),
				'message'	=> 'Password and confirm password does not match.'
			),
			'validation 5' => array(
				'on' => 'update',
				'rule' => array('equalToField', 'password', 'new_password'),
				'message'	=> 'Password and new password does not match.'
			)
        ),
		'confirm_password' => array(
			'validation 1' => array(
				'required' => 'create',
				'rule' => array('notBlank'),
				'message'	=> 'Password must not be empty.'
			),
			'validation 4' => array(
				'required' => 'create',
				'on' => 'create',
				'rule' => array('equalToField', 'password', 'confirm_password'),
				'message'	=> 'Password and confirm password does not match.'
			)
        ),
		'current_password' => array(
			'validation 1' => array(
				'rule' => array('notBlank'),
				'message'	=> 'Password must not be empty.'
			),			
			'validation 4' => array(
				'rule' => array('checkIfCurrentPasswordIsCorrect', 'current_password'),
				'message'	=> 'Current password does not match.'
			)
        ),
		'new_password' => array(
			'validation 1' => array(
				'rule' => array('notBlank'),
				'message'	=> 'New password must not be empty.'
			),
			'validation 3' => array(
				'rule' => array('lengthBetween', 5, 20),
				'message'	=> 'New password must be 5 to 20 characters long.'
			),
			'validation 4' => array(
				'rule' => array('equalToField', 'new_password', 'repeat_new_password'),
				'message'	=> 'New password and repeat new password does not match.'
			)
        ),
		'repeat_new_password' => array(
			'validation 1' => array(
				'rule' => array('notBlank'),
				'message'	=> 'Repeat new password must not be empty.'
			),
			'validation 4' => array(
				'rule' => array('equalToField', 'new_password', 'repeat_new_password'),
				'message'	=> 'Repeat new password and new password does not match.'
			)
        ),
	);
	
	public $hasOne = array(
		'UserSubscription' => array(
			'className' => 'UserSubscription',
			'foreignKey' => 'user_id',
		),
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
	);
	public $hasMany = array(
		
	);
	public function checkIfCurrentPasswordIsCorrect($data_for_validation = '', $field_name_to_compare = '') {
		$password_hasher = new SimplePasswordHasher();
		
		$user_id = $this->data[$this->name]['id'];
		$user_hashed_password = $password_hasher->hash($this->data[$this->name][$field_name_to_compare]);
		
		$boolean_result = $this->hasAny(array(
			'User.id' => $user_id,
			'User.password' => $user_hashed_password
		));
		
		return $boolean_result;
    }
	
	public function change_password($data = array()) {
		$data['User']['id'] = $_SESSION['Auth']['User']['id'];
		return $this->save($data);
	}
	
	public function override_password($data = array()) {
		return $this->save($data);
	}
	
	public function check_user_existency($id = null) {
		$boolean_result = $this->hasAny(array(
			'User.id' => $id,
		));
		
		return $boolean_result;
	}
	
	public function find_by_id($id) {
		$results = $this->find('first', array(
			'conditions' => array(
				'User.id' => $id,
			),
			'contain' => array(
				'EndUser',
				'Role',
				'Owner',
				'UserPrivilege' => array(
					'fields' => array(
						'UserPrivilege.id',
						'UserPrivilege.name'
					)
				)
			)
		));
		
		if(!empty($results)) {
			return $results;
		}
		
		return false;
	}
	
	public function find_by_id_contain_employee($id = null) {
		$results = $this->find('first', array(
			'conditions' => array(
				'User.id' => $id,
			),
			'contain' => array(
				'Employee'
			)
		));
		
		if(!empty($results)) {
			return $results;
		}
		
		return false;
	}
	
	public function find_by_id_contain_role_owner($id = null) {
		$results = $this->find('first', array(
			'conditions' => array(
				'User.id' => $id,
			),
			'contain' => array(
				'Role',
				'Owner'
			)
		));
		
		if(!empty($results)) {
			return $results;
		}
		
		return false;
	}
	
	public function get_unassigned_users_list($end_user_id = null) {
		$result = $this->find('list', array(
			'fields' => array(
				'User.id',
				'User.username'
			),
			'contain' => array(
				'EndUser'
			),
			'conditions' => array(
				'User.status' => 1,
				'OR' => array(
					array('EndUser.id' => null),
					array('EndUser.id' => $end_user_id)
				)
			),
			'order' => array(
				'User.username ASC'
			),
			'recursive' => -1
		));
		
		return $result;
	}
	
	public function beforeValidate($options = array()) {
		if(!isset($this->data['User']['id'])) {
			$this->data['User']['is_eula_agreed'] = 0;
		}
		else {
			if(isset($this->data['User']['new_password'])) {
				$this->data['User']['password'] = $this->data['User']['new_password'];
			}
		}
	}
	
	public function afterValidate() {
		if(isset($this->data['User']['password'])) {
			$password_hasher = new SimplePasswordHasher();
			$this->data['User']['password'] = $password_hasher->hash($this->data['User']['password']);
		}
	}
}