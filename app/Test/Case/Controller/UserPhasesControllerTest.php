<?php
App::uses('UserPhasesController', 'Controller');

/**
 * UserPhasesController Test Case
 *
 */
class UserPhasesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_phase',
		'app.user',
		'app.state',
		'app.country',
		'app.ethnicity',
		'app.user_ethnicity_preference',
		'app.religion',
		'app.user_religion_preference',
		'app.zodiac_sign',
		'app.user_role',
		'app.user_bar',
		'app.bar',
		'app.bar_type',
		'app.drop',
		'app.user_one',
		'app.user_two'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
	}

}
