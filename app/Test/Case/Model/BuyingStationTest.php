<?php
App::uses('BuyingStation', 'Model');

/**
 * BuyingStation Test Case
 *
 */
class BuyingStationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.buying_station',
		'app.state',
		'app.farmer_group',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BuyingStation = ClassRegistry::init('BuyingStation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BuyingStation);

		parent::tearDown();
	}

}
