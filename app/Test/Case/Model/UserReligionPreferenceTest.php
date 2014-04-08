<?php
App::uses('UserReligionPreference', 'Model');

/**
 * UserReligionPreference Test Case
 *
 */
class UserReligionPreferenceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_religion_preference',
		'app.user',
		'app.religion'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserReligionPreference = ClassRegistry::init('UserReligionPreference');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserReligionPreference);

		parent::tearDown();
	}

}
