<?php
/**
 * DropFixture
 *
 */
class DropFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'binary', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
		'user_one_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'user_two_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'bar_id' => array('type' => 'binary', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index'),
		'date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'drops_user_one_id_idx' => array('column' => 'user_one_id', 'unique' => 0),
			'drops_user_two_id_idx' => array('column' => 'user_two_id', 'unique' => 0),
			'drops_bar_id_idx' => array('column' => 'bar_id', 'unique' => 0),
			'drops_created_by_idx' => array('column' => 'created_by', 'unique' => 0),
			'drops_modified_by_idx' => array('column' => 'modified_by', 'unique' => 0)
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
			'id' => '52324d4b-bf98-4751-9d0b-0b385ca972af',
			'user_one_id' => 1,
			'user_two_id' => 1,
			'bar_id' => 'Lorem ipsum dolor sit amet',
			'date' => '2013-09-12 23:24:59',
			'created' => '2013-09-12 23:24:59',
			'created_by' => 1,
			'modified' => '2013-09-12 23:24:59',
			'modified_by' => 1
		),
	);

}
