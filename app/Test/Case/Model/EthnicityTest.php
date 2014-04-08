<?php
App::uses('Ethnicity', 'Model');

/**
 * Ethnicity Test Case
 *
 */
class EthnicityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ethnicity',
		'app.user_ethnicity_preference',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ethnicity = ClassRegistry::init('Ethnicity');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ethnicity);

		parent::tearDown();
	}

}
