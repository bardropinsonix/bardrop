<?php
App::uses('Drop', 'Model');

/**
 * Drop Test Case
 *
 */
class DropTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.drop',
		'app.user_one',
		'app.user_two',
		'app.bar',
		'app.bar_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Drop = ClassRegistry::init('Drop');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Drop);

		parent::tearDown();
	}

}
