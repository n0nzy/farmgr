<?php
/**
 * ProductionFixture
 *
 */
class ProductionFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'production';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'land_area' => array('type' => 'float', 'null' => false, 'default' => null),
		'production_area_size' => array('type' => 'float', 'null' => false, 'default' => null),
		'estimated_production' => array('type' => 'float', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'product_id' => 1,
			'land_area' => 1,
			'production_area_size' => 1,
			'estimated_production' => 1,
			'created' => '2013-02-23 22:03:36',
			'modified' => '2013-02-23 22:03:36'
		),
	);

}
