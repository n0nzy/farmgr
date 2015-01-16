<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Title $Title
 * @property UserCategory $UserCategory
 * @property FarmerGroup $FarmerGroup
 * @property BuyingStation $BuyingStation
 * @property Inspection $Inspection
 * @property Production $Production
 */
class User extends AppModel {

	public $name = 'User';

	public $useTable = 'users'; // This model uses a database table 'users'

	public $primaryKey = 'id'; // user_id is the primary key of the users table in the database

	public $displayField = 'username';

	public $virtualFields = array(
		'name'		=> "CONCAT(User.first_name, ' ', User.last_name)",
		'full_name'	=> "CONCAT(User.first_name, ' ', User.mid_name, ' ', User.last_name)"
	);

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'title_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'gender' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_category_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'farmer_group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone' => array(
			'phone' => array(
				'rule' => array('phone', '/^0[7-8]\d{9}$/', 'all'),
				'message' => 'This Phone number is not valid',
				'allowEmpty' => 'false',
				'requireed' => true
			)
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'This email address is invalid!!!',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Title' => array(
			'className' => 'Title',
			'foreignKey' => 'title_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserCategory' => array(
			'className' => 'UserCategory',
			'foreignKey' => 'user_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FarmerGroup' => array(
			'className' => 'FarmerGroup',
			'foreignKey' => 'farmer_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BuyingStation' => array(
			'className' => 'BuyingStation',
			'foreignKey' => 'buying_station_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FieldOfficer' => array(
            'className' => 'FieldOfficer',
            'foreignKey' => 'entered_by'
        )
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Production' => array(
			'className' => 'Production',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
		    $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}//end function beforeSave()

	/**
	 * This method checks to see that the $farmerId was actually entered by $user, returns false if not.
	 *
	 * @param string $farmerId The ID of the farmer to check
	 * @param string $user The ID of the user who entered the farmer's info
	 * @return boolean
	 */
	public function isEnteredBy($farmerId, $user) {
		//This returns the currently set model's ID, where user.id = $farmerId and user.entered_by = $user
		return $this->field('id', array('id' => $farmerId, 'entered_by' => $user)) === $farmerId;
	}

	public function fetchFullName($id) {

		$this->id = $id;
		if (!$this->exists()) {
			return NULL;
		}
		$farmerinfo = $this->find('first', array(
			'fields' => array('User.first_name', 'User.last_name'),
			'conditions' => array('User.id' => $id)
		 ));
		return $farmerinfo;

	}//end function fetchFullName()

}//end Class User [Model]
