<?php
App::uses('AppController', 'Controller');

class EthnicitiesController extends AppController {
	public function getEthnicities() {
		$ethnicities = $this->Ethnicity->find('list', 
			array(
				'order' => array('Ethnicity.ethnicity ASC')
			)
		);
		return $ethnicities;
	}
	
	public function admin_getEthnicities() {
		return $this->getEthnicities();
	}
}