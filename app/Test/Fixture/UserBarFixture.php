<?php
/**
 * UserBarFixture
 *
 */
class UserBarFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'bar_id' => array('type' => 'binary', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_bars_user_id_idx' => array('column' => 'user_id', 'unique' => 0),
			'user_bars_bar_id_idx' => array('column' => 'bar_id', 'unique' => 0)
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
			'id' => 1,
			'user_id' => 1,
			'bar_id' => 'Lorem ipsum dolor sit amet'
		),
	);

}
