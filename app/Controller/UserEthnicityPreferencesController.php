<?php
App::uses('AppController', 'Controller');
/**
 * UserEthnicityPreferences Controller
 *
 * @property UserEthnicityPreference $UserEthnicityPreference
 * @property PaginatorComponent $Paginator
 */
class UserEthnicityPreferencesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserEthnicityPreference->recursive = 0;
		$this->set('userEthnicityPreferences', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserEthnicityPreference->exists($id)) {
			throw new NotFoundException(__('Invalid user ethnicity preference'));
		}
		$options = array('conditions' => array('UserEthnicityPreference.' . $this->UserEthnicityPreference->primaryKey => $id));
		$this->set('userEthnicityPreference', $this->UserEthnicityPreference->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserEthnicityPreference->create();
			if ($this->UserEthnicityPreference->save($this->request->data)) {
				$this->Session->setFlash(__('The user ethnicity preference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user ethnicity preference could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserEthnicityPreference->User->find('list');
		$ethnicities = $this->UserEthnicityPreference->Ethnicity->find('list');
		$this->set(compact('users', 'ethnicities'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserEthnicityPreference->exists($id)) {
			throw new NotFoundException(__('Invalid user ethnicity preference'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserEthnicityPreference->save($this->request->data)) {
				$this->Session->setFlash(__('The user ethnicity preference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user ethnicity preference could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserEthnicityPreference.' . $this->UserEthnicityPreference->primaryKey => $id));
			$this->request->data = $this->UserEthnicityPreference->find('first', $options);
		}
		$users = $this->UserEthnicityPreference->User->find('list');
		$ethnicities = $this->UserEthnicityPreference->Ethnicity->find('list');
		$this->set(compact('users', 'ethnicities'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserEthnicityPreference->id = $id;
		if (!$this->UserEthnicityPreference->exists()) {
			throw new NotFoundException(__('Invalid user ethnicity preference'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserEthnicityPreference->delete()) {
			$this->Session->setFlash(__('The user ethnicity preference has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user ethnicity preference could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
