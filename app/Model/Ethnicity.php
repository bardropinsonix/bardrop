<?php
App::uses('AppModel', 'Model');
/**
 * Ethnicity Model
 *
 * @property UserEthnicityPreference $UserEthnicityPreference
 * @property User $User
 */
class Ethnicity extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'ethnicity';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'ethnicity_id',
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
