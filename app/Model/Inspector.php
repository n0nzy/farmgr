<?php
App::uses('AppModel', 'Model');
/**
 * Inspector Model
 *
 * @property Inspector $Inspector
 * @property UserCategory $UserCategory
 * @property Inspection $Inspection
 *
 */
class Inspector extends AppModel {

	public $name = 'Inspector';

	public $useTable = 'users'; // This model uses a database table 'users'

	public $primaryKey = 'id'; // user_id is the primary key of the users table in the database

	public $virtualFields = array(
		'name'		=> "CONCAT(Inspector.first_name, ' ', Inspector.last_name)",
		'full_name'	=> "CONCAT(Inspector.first_name, ' ', Inspector.mid_name, ' ', Inspector.last_name)"
	);

	public $displayField = 'full_name';

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
			'fields' => '',
			'order' => ''
		),
		'User' => array(
            'className' => 'User',
            'foreignKey' => 'entered_by'
        )
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Inspection' => array(
			'className' => 'Inspection',
			'foreignKey' => 'inspector_id',
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
		    $this->data[$this->alias]['user_category_id'] = 4;
		}

		if (isset($this->data[$this->alias]['password'])) {
		    $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;

	}//end function beforeSave()

	/**
	 * This method queries the 'users' table and returns an array of all users who are 'Inspectors'.
	 *
	 * @return array
	 */
	public function all() {

		return $this->find('list', array(
			'conditions' => array('Inspector.user_category_id' => '4')
		) );

	}//end function all()

}//end Class Inspector [Model]