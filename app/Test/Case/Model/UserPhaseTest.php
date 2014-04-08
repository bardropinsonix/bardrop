<?php
App::uses('UserPhase', 'Model');

/**
 * UserPhase Test Case
 *
 */
class UserPhaseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_phase',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserPhase = ClassRegistry::init('UserPhase');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserPhase);

		parent::tearDown();
	}

}
