<?php
App::uses('AppModel', 'Model');
/**
 * Drop Model
 *
 * @property UserOne $UserOne
 * @property UserTwo $UserTwo
 * @property Bar $Bar
 */
class Drop extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'UserOne' => array(
			'className' => 'User',
			'foreignKey' => 'user_one_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserTwo' => array(
			'className' => 'User',
			'foreignKey' => 'user_two_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Bar' => array(
			'className' => 'Bar',
			'foreignKey' => 'bar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
