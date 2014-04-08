<?php
App::uses('BarType', 'Model');

/**
 * BarType Test Case
 *
 */
class BarTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bar_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BarType = ClassRegistry::init('BarType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BarType);

		parent::tearDown();
	}

}
