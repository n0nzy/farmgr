<?php
App::uses('AppModel', 'Model');
/**
 * Production Model
 *
 * @property User $User
 * @property Product $Product
 */
class Production extends AppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'production';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'product_id' => array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
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
			'foreignKey' => 'production_id',
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

	/**
	 * This method checks to see that the $productionId was actually entered by $field_officer_id, returns false if not.
	 *
	 * @param string $productionId			The ID of the production info to check
	 * @param string $field_officer_id		The ID of the field-officer who entered the farmer's production info
	 * @return boolean
	 */
	public function isEnteredBy($productionId, $field_officer_id) {

		//This returns the currently set model's ID, where production.id = $productionId and production.field_officer_id = $user
		return $this->field('id', array('id' => $productionId, 'field_officer_id' => $field_officer_id)) === $productionId;

	}//end function isEnteredBy()

}//end Class Production [Model]