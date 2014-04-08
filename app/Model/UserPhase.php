<?php
App::uses('AppModel', 'Model');
/**
 * UserPhase Model
 *
 * @property User $User
 */
class UserPhase extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'user_phase';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_phase_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
