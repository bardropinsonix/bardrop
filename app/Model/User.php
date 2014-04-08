<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property State $State
 * @property Ethnicity $Ethnicity
 * @property Religion $Religion
 * @property ZodiacSign $ZodiacSign
 * @property UserPhase $UserPhase
 * @property UserRole $UserRole
 * @property UserBar $UserBar
 * @property UserEthnicityPreference $UserEthnicityPreference
 * @property UserReligionPreference $UserReligionPreference
 */
class User extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'facebook_token';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'State' => array(
			'className' => 'State',
			'foreignKey' => 'state_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Ethnicity' => array(
			'className' => 'Ethnicity',
			'foreignKey' => 'ethnicity_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Religion' => array(
			'className' => 'Religion',
			'foreignKey' => 'religion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ZodiacSign' => array(
			'className' => 'ZodiacSign',
			'foreignKey' => 'zodiac_sign_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserPhase' => array(
			'className' => 'UserPhase',
			'foreignKey' => 'user_phase_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserRole' => array(
			'className' => 'UserRole',
			'foreignKey' => 'user_role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'UserBar' => array(
			'className' => 'UserBar',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'UserFriend' => array(
			'className' => 'UserFriend',
			'foreignKey' => 'user_id',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Ethnicity' => array(
			'className' => 'Ethnicity',
			'joinTable' => 'user_ethnicity_preferences',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'ethnicity_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Religion' => array(
			'className' => 'Religion',
			'joinTable' => 'user_religion_preferences',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'religion_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

	public function beforeSave($options = array()){
		// Get and loop all the HABTM models related to the POST
		foreach (array_keys($this->hasAndBelongsToMany) as $model){
			// transform the data so instead of having
			// $this->data['Post']['Tag'] you'll get $this->data['Tag']['Tag']
			if(isset($this->data[$this->name][$model])){
				$this->data[$model][$model] = $this->data[$this->name][$model];
				unset($this->data[$this->name][$model]);
			}
		}
		return true;
	}
}
