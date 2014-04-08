<?php
App::uses('ZodiacSign', 'Model');

/**
 * ZodiacSign Test Case
 *
 */
class ZodiacSignTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.zodiac_sign',
		'app.user',
		'app.state',
		'app.country',
		'app.ethnicity',
		'app.user_ethnicity_preference',
		'app.religion',
		'app.user_religion_preference',
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
		$this->ZodiacSign = ClassRegistry::init('ZodiacSign');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ZodiacSign);

		parent::tearDown();
	}

}
