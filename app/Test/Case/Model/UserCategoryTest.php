<?php
App::uses('UserCategory', 'Model');

/**
 * UserCategory Test Case
 *
 */
class UserCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserCategory = ClassRegistry::init('UserCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserCategory);

		parent::tearDown();
	}

}
