<?php
App::uses('Bar', 'Model');

/**
 * Bar Test Case
 *
 */
class BarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bar',
		'app.bar_type',
		'app.drop'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Bar = ClassRegistry::init('Bar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Bar);

		parent::tearDown();
	}

}
