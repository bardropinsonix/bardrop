<?php
App::uses('AppController', 'Controller');

class UserBarsController extends AppController {
	public function getUserBars($id) {
		$bars = $this->UserBar->find('all', 
			array(
				'fields' => array('Bar.*'),
				'conditions' => array(
					'UserBar.user_id' => $id,
					'Bar.status' => ACTIVE
				)
			)
		);
				
		return $bars;
	}
	
	public function admin_getUserBars($id) {
		return $this->getUserBars($id);
	}
}