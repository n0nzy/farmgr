<?php
/**
 * ProductFixture
 *
 */
class ProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'key' => 'primary', 'comment' => 'The product ID'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'comment' => 'The name of the product ', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => 'date this product was created'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => 'last time this product was edited'),
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
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-02-23 22:07:56',
			'modified' => '2013-02-23 22:07:56'
		),
	);

}
