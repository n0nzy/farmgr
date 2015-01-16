<?php
App::uses('AppModel', 'Model');
/**
 * BuyingStation Model
 *
 * @property State $State
 * @property FarmerGroup $FarmerGroup
 * @property User $User
 */
class BuyingStation extends AppModel {

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'state_id' => array(
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
		'State' => array(
			'className' => 'State',
			'foreignKey' => 'state_id',
			'conditions' => '',
			'fields' => array('State.id','State.name'),
			'order' => ''
		)
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'FarmerGroup' => array(
			'className' => 'FarmerGroup',
			'foreignKey' => 'buying_station_id',
			'dependent' => true,
			'conditions' => '',
			//'fields' => array('FarmerGroup.name'),
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'FieldOfficer' => array(
			'className' => 'FieldOfficer',
			'foreignKey' => 'buying_station_id',
			'dependent' => false,
			'conditions' => array('user_category_id' => 2),
			'fields' => array(
				'FieldOfficer.full_name',
				'FieldOfficer.id',
				'FieldOfficer.email',
				'FieldOfficer.gender'
			),
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}//end Class BuyingStation