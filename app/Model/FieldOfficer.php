<?php
App::uses('AppModel', 'Model');
/**
 * FieldOfficer Model
 *
 * @property FieldOfficer $FieldOfficer
 * @property UserCategory $UserCategory
 * @property BuyingStation $BuyingStation
 * @property Inspection $Inspection
 * @property Production $Production
 */
class FieldOfficer extends AppModel {

	public $name = 'FieldOfficer';

	public $useTable = 'users'; // This model uses a database table 'users'

	public $primaryKey = 'id'; // user_id is the primary key of the users table in the database

	public $displayField = 'username';

	public $virtualFields = array(
		//'name' => "CONCAT(FieldOfficer.first_name, ' ', FieldOfficer.last_name)"
		'full_name' => "CONCAT(FieldOfficer.first_name, ' ', FieldOfficer.mid_name, ' ', FieldOfficer.last_name)"
	);

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(

		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a proper value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a proper value for last name',
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
				'message' => 'This username is invalid. Please try another value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Password entry is invalid. Please try another value',
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
		'UserCategory' => array(
			'className' => 'UserCategory',
			'foreignKey' => 'user_category_id',
			'conditions' => '',
			'fields' => array('UserCategory.id', 'UserCategory.name'),
			'order' => ''
		),
		'BuyingStation' => array(
			'className' => 'BuyingStation',
			'foreignKey' => 'buying_station_id',
			'conditions' => '',
			'fields' => array('BuyingStation.id', 'BuyingStation.name'),
			'order' => ''
		),
		'Admin' => array(
            'className' => 'User',
            'foreignKey' => 'entered_by',
			'fields' => array('Admin.first_name', 'Admin.last_name'),
        )
	);


	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Farmer' => array(
			'className' => 'Farmer',
			'foreignKey' => 'entered_by',
			'dependent' => true,
			'conditions' => '',
			'fields' => array('Farmer.first_name', 'Farmer.last_name'),
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function beforeSave($options = array()) {

		if (isset($this->data[$this->alias]['user_category_id'])) {
		    $this->data[$this->alias]['user_category_id'] = 2;
		}

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

}//end Class FieldOfficer [Model]
