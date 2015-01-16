<?php
App::uses('AppModel', 'Model');
/**
 * FarmerGroup Model
 *
 * @property BuyingStation $BuyingStation
 * @property Farmer $Farmer
 */
class FarmerGroup extends AppModel {

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You have to enter a name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'buying_station_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'created_by' => array(
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
		'BuyingStation' => array(
			'className' => 'BuyingStation',
			'foreignKey' => 'buying_station_id',
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
	//This should be renamed from User to Farmer later on....
	public $hasMany = array(
		'Farmer' => array(  //This should be Farmer, change it later!
			'className' => 'Farmer',
			'foreignKey' => 'farmer_group_id',
			'dependent' => true,
			'conditions' => array('Farmer.user_category_id' => 3),
			'fields' => array('Farmer.id', 'Farmer.full_name', 'Farmer.gender', 'Farmer.alias', 'Farmer.code'),
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/**
	 * This method checks to see that the $farmerGroupId belongs to $buyingStationId, returns false if not.
	 *
	 * @param string $farmerGroupId   The ID of the farmer group to check
	 * @param string $buyingStationId The ID of the buying station to check with
	 * @return boolean
	 */
	public function belongsToBuyingStation($farmerGroupId, $buyingStationId) {
		//This returns the currently set model's ID, where farmer_group.id = $farmerId and farmer_group.buying_station_id = $buyingStationId
		return $this->field('id', array('id' => $farmerGroupId, 'buying_station_id' => $buyingStationId)) === $farmerGroupId;
	}//end belongsToBuyingStation

}//end FarmerGroup [Model]