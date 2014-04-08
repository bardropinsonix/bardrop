<?php
App::uses('AppController', 'Controller');

class DropsController extends AppController {
	public function admin_getDrops() {
		$drops = $this->Drop->find('all');
		
		return $drops;
	}
	
	public function admin_index() {
		$date = date('m/d/Y', time());
		
		$dropsUpcoming = $this->Drop->find('all', array(
			'conditions' => array(
				'Drop.drop_date >=' => $date
			)
		));
		
		$dropsPast = $this->Drop->find('all', array(
			'conditions' => array(
				'Drop.drop_date <' => $date
			)
		));
				
		$this->set(compact('dropsUpcoming', 'dropsPast'));
	}
	
	public function admin_view($id = null) {
		if (!$this->Drop->exists($id)) {
			throw new NotFoundException(__('Invalid drop'));
		}
		$options = array('conditions' => array('Drop.' . $this->Drop->primaryKey => $id));
		$this->set('drop', $this->Drop->find('first', $options));
	}
	
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			
			$userOne = $data['user-one'];
			$userTwo = $data['user-two'];
			$userBar = $data['user-bar'];
			$dropDate = $data['drop-date'];
			
			$this->Drop->create();
			$this->Drop->set(array(
				'user_one_id' => $userOne,
				'user_two_id' => $userTwo,
				'bar_id' => $userBar,
				'drop_date' => date("Y-m-d H:i:s", $dropDate)
			));
			
			if ($this->Drop->save()) {
				$this->User = ClassRegistry::init('User');
				$this->User->set(array(
					'facebook_token' => $userOne,
					'user_phase_id' => PHASE_5
				));
					
				$this->User->save();
					
				$this->User = ClassRegistry::init('User');
				$this->User->set(array(
						'facebook_token' => $userTwo,
						'user_phase_id' => PHASE_5
				));
					
				$this->User->save();
				
				$this->Session->setFlash(__('The drop has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The drop could not be saved. Please, try again.'));
			}
		}
		
		$users = $this->requestAction(array('controller' => 'users', 'action' => 'getUsersByPhase'),
			array('pass' => array(PHASE_4))
		);
		
		$this->set(compact('users'));
	}
	
	public function admin_edit($id = null) {
		if (!$this->Drop->exists($id)) {
			throw new NotFoundException(__('Invalid drop'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Drop->save($this->request->data)) {
				$this->Session->setFlash(__('The drop has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The drop could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Drop.' . $this->Drop->primaryKey => $id));
			$this->request->data = $this->Drop->find('first', $options);
		}
		$userOnes = $this->Drop->UserOne->find('list');
		$userTwos = $this->Drop->UserTwo->find('list');
		$bars = $this->Drop->Bar->find('list');
		$this->set(compact('userOnes', 'userTwos', 'bars'));
	}
	
	public function admin_delete($id = null) {
		$this->Drop->id = $id;
		if (!$this->Drop->exists()) {
			throw new NotFoundException(__('Invalid drop'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Drop->delete()) {
			$this->Session->setFlash(__('The drop has been deleted.'));
		} else {
			$this->Session->setFlash(__('The drop could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
