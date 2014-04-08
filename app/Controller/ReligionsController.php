<?php
App::uses('AppController', 'Controller');

class ReligionsController extends AppController {
	public function getReligions() {
		$religions = $this->Religion->find('list', 
			array(
				'order' => array('Religion.religion ASC')
			)
		);
		return $religions;
	}
	
	public function admin_getReligions() {
		return $this->getReligions();
	}
}