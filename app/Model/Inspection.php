<?php
App::uses('AppModel', 'Model');
/**
 * Inspection Model
 *
 * @property User $User
 * @property Production $Production
 */
class Inspection extends AppModel {

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
		'production_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'This production I.D is invalid',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date_inspected' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Please enter a valid date!!!',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_time' => array(
			'time' => array(
				'rule' => array('time'),
				'message' => 'Please enter a valid start time',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_time' => array(
			'time' => array(
				'rule' => array('time'),
				'message' => 'Please enter a valid end time',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'inspected_by' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'utz_status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'compliance_year' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please choose a valid year!!!',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'entered_by' => array(
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
		'Production' => array(
			'className' => 'Production',
			'foreignKey' => 'production_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Inspector' => array(
			'className' => 'Inspector',
			'foreignKey' => 'inspector_id',
		//	'conditions' => array('Inspector.user_category_id' => '4'),
			'fields' => '',
			'order' => ''
		),
		'FieldOfficer' => array(
			'className' => 'FieldOfficer',
			'foreignKey' => 'entered_by',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 * This method checks to see that the $inspectionId was actually entered by $field_officer_id, returns false if not.
	 *
	 * @param string $inspectionId			The ID of the inspection info to check
	 * @param string $field_officer_id		The ID of the field-officer who entered the farmer's inspection info
	 * @return boolean
	 */
	public function isEnteredBy($inspectionId, $field_officer_id) {

		//This returns the currently set model's ID, where inspection.id = $inspectionId and production.field_officer_id = $user
		return $this->field('id', array('id' => $inspectionId, 'entered_by' => $field_officer_id)) === $inspectionId;

	}//end function isEnteredBy()

}//end Class Inspection [Model]