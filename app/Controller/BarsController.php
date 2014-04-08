<?php
App::uses('AppController', 'Controller');

class BarsController extends AppController {
	public function getBars() {
		$bars = $this->Bar->find('all', array(
			'conditions' => array(
				'Bar.status' => ACTIVE
			),
				'order' => array('Bar.name ASC')
			)
		);
		return $bars;
	}
	
	public function admin_getBars() {
		return $this->getBars();
	}

	public function index() {
		$this->Bar->recursive = 0;
		$this->set('bars', $this->Paginator->paginate());
	}
	
	public function view($id = null) {
		if (!$this->Bar->exists($id)) {
			throw new NotFoundException(__('Invalid bar'));
		}
		$options = array('conditions' => array('Bar.' . $this->Bar->primaryKey => $id));
		$this->set('bar', $this->Bar->find('first', $options));
	}
	
	public function admin_index() {
		$this->Bar->unbindModel(array('belongsTo' => array('State')));
		$barsActive = $this->Bar->find('all', array(
			'fields' => array('Bar.*', 'State.*', 'Country.*'),
			'conditions' => array(
				'Bar.status' => ACTIVE
			),
			'joins' => array(
				array(
					'table' => 'states',
					'alias' => 'State',
					'type' => 'left',
					'foreignKey' => true,
					'conditions'=> array('Bar.state_id = State.id')
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
		
		$this->Bar->unbindModel(array('belongsTo' => array('State')));
		$barsInactive = $this->Bar->find('all', array(
			'fields' => array('Bar.*', 'State.*', 'Country.*'),
			'conditions' => array(
				'Bar.status' => INACTIVE
			),
			'joins' => array(
				array(
					'table' => 'states',
					'alias' => 'State',
					'type' => 'left',
					'foreignKey' => true,
					'conditions'=> array('Bar.state_id = State.id')
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
		
		//$barTypes = $this->requestAction(array('controller' => 'barTypes', 'action' => 'admin_getBarTypes'));
		
		$this->set(compact('barsActive', 'barsInactive', 'barTypes'));
	}
	
	public function admin_view($id = null) {
		if (!$this->Bar->exists($id)) {
			throw new NotFoundException(__('Invalid bar'));
		}
		$options = array('conditions' => array('Bar.' . $this->Bar->primaryKey => $id));
		$this->set('bar', $this->Bar->find('first', $options));
	}
	
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Bar->create();
			if ($this->Bar->save($this->request->data)) {
				$this->Session->setFlash(__('The bar has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bar could not be saved. Please, try again.'));
			}
		}
		
		$barTypes = $this->Bar->BarType->find('list');
		$states = $this->Bar->State->find('list');
		$countries = $this->requestAction(array('controller' => 'countries', 'action' => 'getCountries'));
		
		$this->set(compact('barTypes', 'states', 'countries'));
	}
	
	public function admin_edit($id = null) {
		if (!$this->Bar->exists($id)) {
			throw new NotFoundException(__('Invalid bar'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Bar->save($this->request->data)) {
				$this->Session->setFlash(__('The bar has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bar could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bar.' . $this->Bar->primaryKey => $id));
			$this->request->data = $this->Bar->find('first', $options);
		}
		
		$barTypes = $this->Bar->BarType->find('list');
		$states = $this->Bar->State->find('list');
		$countries = $this->requestAction(array('controller' => 'countries', 'action' => 'getCountries'));
		
		$this->set(compact('barTypes', 'states', 'countries'));
	}

	public function admin_delete($id = null) {
		$this->Bar->id = $id;
		
		if (!$this->Bar->exists()) {
			return $this->redirect(array('controller' => 'bars', 'action' => 'index'));
		}
		
		if ($this->Bar->saveField('status', 0)) {
			$this->Session->setFlash(__('The bar has been deleted.'));
		} else {
			$this->Session->setFlash(__('The bar could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller' => 'bars', 'action' => 'index'));
	}
	
	public function admin_restore($id = null) {
		$this->Bar->id = $id;
		
		if (!$this->Bar->exists()) {
			return $this->redirect(array('controller' => 'bars', 'action' => 'index'));
		}
		
		if ($this->Bar->saveField('status', 1)) {
			$this->Session->setFlash(__('The bar has been deleted.'));
		} else {
			$this->Session->setFlash(__('The bar could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller' => 'bars', 'action' => 'index'));
	}
}
