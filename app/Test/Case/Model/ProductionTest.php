<?php
App::uses('Production', 'Model');

/**
 * Production Test Case
 *
 */
class ProductionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.production',
		'app.user',
		'app.title',
		'app.gender',
		'app.user_category',
		'app.farmer_group',
		'app.buying_station',
		'app.state',
		'app.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Production = ClassRegistry::init('Production');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Production);

		parent::tearDown();
	}

}
