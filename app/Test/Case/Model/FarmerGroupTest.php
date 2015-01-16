<?php
App::uses('FarmerGroup', 'Model');

/**
 * FarmerGroup Test Case
 *
 */
class FarmerGroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.farmer_group',
		'app.state',
		'app.buying_station',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FarmerGroup = ClassRegistry::init('FarmerGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FarmerGroup);

		parent::tearDown();
	}

}
