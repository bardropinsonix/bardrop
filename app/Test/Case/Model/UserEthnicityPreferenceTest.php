<?php
App::uses('UserEthnicityPreference', 'Model');

/**
 * UserEthnicityPreference Test Case
 *
 */
class UserEthnicityPreferenceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_ethnicity_preference',
		'app.user',
		'app.ethnicity'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserEthnicityPreference = ClassRegistry::init('UserEthnicityPreference');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserEthnicityPreference);

		parent::tearDown();
	}

}
