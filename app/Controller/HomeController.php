<?php
App::uses('AppController', 'Controller');

class HomeController extends AppController {

	public $components = array('Utility');
	
	public function index() {
		if ($this->Utility->isAdmin())
			return $this->redirect(array('controller' => 'home', 'action' => 'admin_index','admin' => true));
	}
	
	public function admin_index() {
		$drops = $this->requestAction(array('controller' => 'drops', 'action' => 'getDrops'));
		
		$this->User->unbindModel(array('belongsTo' => array('State')));
		$usersActive = $this->User->find('all', array(
			'fields' => array('User.*', 'State.*, Country.*'),
        	'conditions' => array(
        		'User.status' => ACTIVE
        	),
			'joins' => array(
				array(
					'table' => 'states',
					'alias' => 'State',
					'type' => 'left',
					'foreignKey' => true,
					'conditions'=> array('User.state_id = State.id')
				),
				array(
					'table' => 'countries',
					'alias' => 'Country',
					'type' => 'left',
					'foreignKey' => true,
					'conditions'=> array('Country.id = State.country_id')
				)
			)	
    	));
		
		$this->set(compact('drops', 'usersActive'));
	}
}