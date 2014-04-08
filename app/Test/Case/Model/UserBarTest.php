<?php
App::uses('UserBar', 'Model');

/**
 * UserBar Test Case
 *
 */
class UserBarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_bar',
		'app.user',
		'app.bar',
		'app.bar_type',
		'app.drop',
		'app.user_one',
		'app.user_two'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserBar = ClassRegistry::init('UserBar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserBar);

		parent::tearDown();
	}

}
