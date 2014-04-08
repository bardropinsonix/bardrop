<?php
App::uses('AppController', 'Controller');

class BarTypesController extends AppController {
	public function getBarTypes() {
		$barTypes = $this->BarType->find('list',
			array(
				'order' => array('BarType.bar_type ASC')
			)
		);
		return $barTypes;
	}
	
	public function admin_getBarTypes() {
		return $this->getBarTypes();
	}
}