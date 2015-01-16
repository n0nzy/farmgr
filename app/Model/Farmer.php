<?php
App::uses('AppModel', 'Model');
/**
 * Farmer Model
 *
 * @property Farmer $Farmer
 * @property UserCategory $UserCategory
 * @property BuyingStation $BuyingStation
 * @property Production $Production
 */
class Farmer extends AppModel {

	public $name = 'Farmer';

	public $useTable = 'users'; // This model uses a database table 'users'

	public $primaryKey = 'id'; // user_id is the primary key of the users table in the database

	public $displayField = 'first_name';

	public $virtualFields = array(
		'full_name' => "CONCAT(Farmer.first_name, ' ', Farmer.mid_name, ' ',Farmer.last_name)"
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
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'FarmerGroup' => array(
			'className' => 'FarmerGroup',
			'foreignKey' => 'farmer_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FieldOfficer' => array(
            'className' => 'FieldOfficer',
            'foreignKey' => 'entered_by'
        ),
		'UserCategory' => array(
			'className' => 'UserCategory',
			'foreignKey' => 'user_category_id',
			'conditions' => '',
			'fields' => array('UserCategory.id', 'UserCategory.name'),
			'order' => ''
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
			'dependent' => false,
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

		if (isset($this->data[$this->alias]['user_category_id'])) {
		    $this->data[$this->alias]['user_category_id'] = 3;
		}

	}//end function beforeSave()

}//end Class Farmer [Model]
