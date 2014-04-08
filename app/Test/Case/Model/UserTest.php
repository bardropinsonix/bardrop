<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.state',
		'app.country',
		'app.ethnicity',
		'app.user_ethnicity_preference',
		'app.religion',
		'app.user_religion_preference',
		'app.zodiac_sign',
		'app.user_phase',
		'app.user_role',
		'app.user_bar',
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
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

}
