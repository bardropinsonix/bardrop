<?php
App::uses('AppController', 'Controller');

class ZodiacSignsController extends AppController {
	public function getZodiacs() {
		$zodiacs = $this->Zodiac->find('list', 
			array(
				'order' => array('Zodiac.id ASC')
			)
		);
		return $zodiacs;
	}
	
	public function admin_getZodiacs() {
		return $this->getZodiacs();
	}
}