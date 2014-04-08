<?php
App::uses('Religion', 'Model');

/**
 * Religion Test Case
 *
 */
class ReligionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.religion',
		'app.user_religion_preference',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Religion = ClassRegistry::init('Religion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Religion);

		parent::tearDown();
	}

}
