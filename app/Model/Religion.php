<?php
App::uses('AppModel', 'Model');
/**
 * Religion Model
 *
 * @property UserReligionPreference $UserReligionPreference
 * @property User $User
 */
class Religion extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'religion';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'religion_id',
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
