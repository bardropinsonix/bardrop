<?php
App::uses('AppModel', 'Model');
/**
 * ZodiacSign Model
 *
 * @property User $User
 */
class ZodiacSign extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'zodiac_sign';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'zodiac_sign_id',
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
