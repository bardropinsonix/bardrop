<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'facebook_token' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 90, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email_address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 180, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'birthday' => array('type' => 'date', 'null' => true, 'default' => null),
		'city' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 90, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'state_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'interested_in' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'ethnicity_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'religion_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'zodiac_sign_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'user_phase_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'user_role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'preferred_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'vault_token' => array('type' => 'integer', 'null' => true, 'default' => null),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'facebook_token', 'unique' => 1),
			'facebook_token_UNIQUE' => array('column' => 'facebook_token', 'unique' => 1),
			'user_user_role_id_idx' => array('column' => 'user_role_id', 'unique' => 0),
			'user_phase_id_idx' => array('column' => 'user_phase_id', 'unique' => 0),
			'user_state_id_idx' => array('column' => 'state_id', 'unique' => 0),
			'user_ethnicity_id_idx' => array('column' => 'ethnicity_id', 'unique' => 0),
			'user_religion_id_idx' => array('column' => 'religion_id', 'unique' => 0),
			'user_zodiac_sign_idx' => array('column' => 'zodiac_sign_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'facebook_token' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'email_address' => 'Lorem ipsum dolor sit amet',
			'birthday' => '2013-09-12',
			'city' => 'Lorem ipsum dolor sit amet',
			'state_id' => 1,
			'interested_in' => 1,
			'ethnicity_id' => 1,
			'religion_id' => 1,
			'zodiac_sign_id' => 1,
			'user_phase_id' => 1,
			'user_role_id' => 1,
			'preferred_date' => '2013-09-12',
			'vault_token' => 1,
			'status' => 1,
			'created' => '2013-09-12 23:29:24',
			'modified' => '2013-09-12 23:29:24'
		),
	);

}
