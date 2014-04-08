<?php
App::uses('AppController', 'Controller');

class StatesController extends AppController {
	public $components = array('RequestHandler');
	
	public function getStates() {
		$states = $this->State->find('list',
			array(
				'order' => array('State.state ASC', 'State.country_id ASC')
			)
		);
		return $states;
	}
	
	public function admin_getStates() {
		return $this->getStates();
	}
	
	public function getByCountry() {
     	$this->autoRender = false;
    
		$country_id = $this->request->data['countryId'];
		
		$states = $this->State->find('list', 
			array(
				'conditions' => array('State.country_id' => $country_id),
				'order' => array('State.state ASC')
			)
		);
		
		return json_encode($states);
	}
	
	public function admin_getByCountry() {
		return $this->getByCountry();
	}
}