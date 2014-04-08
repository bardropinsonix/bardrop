<?php
App::uses('AppController', 'Controller');

class CountriesController extends AppController {
	public function getCountries() {
		$countries = $this->Country->find('list', 
			array(
				'order' => array('Country.id ASC')
			)
		);
		return $countries;
	}
	
	public function admin_getCountries() {
		return $this->getCountries();
	}
}