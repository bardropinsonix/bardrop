<?php
App::uses('AppController', 'Controller');
/**
 * UserReligionPreferences Controller
 *
 * @property UserReligionPreference $UserReligionPreference
 * @property PaginatorComponent $Paginator
 */
class UserReligionPreferencesController extends AppController {

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
		$this->UserReligionPreference->recursive = 0;
		$this->set('userReligionPreferences', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserReligionPreference->exists($id)) {
			throw new NotFoundException(__('Invalid user religion preference'));
		}
		$options = array('conditions' => array('UserReligionPreference.' . $this->UserReligionPreference->primaryKey => $id));
		$this->set('userReligionPreference', $this->UserReligionPreference->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserReligionPreference->create();
			if ($this->UserReligionPreference->save($this->request->data)) {
				$this->Session->setFlash(__('The user religion preference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user religion preference could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserReligionPreference->User->find('list');
		$religions = $this->UserReligionPreference->Religion->find('list');
		$this->set(compact('users', 'religions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserReligionPreference->exists($id)) {
			throw new NotFoundException(__('Invalid user religion preference'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserReligionPreference->save($this->request->data)) {
				$this->Session->setFlash(__('The user religion preference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user religion preference could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserReligionPreference.' . $this->UserReligionPreference->primaryKey => $id));
			$this->request->data = $this->UserReligionPreference->find('first', $options);
		}
		$users = $this->UserReligionPreference->User->find('list');
		$religions = $this->UserReligionPreference->Religion->find('list');
		$this->set(compact('users', 'religions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserReligionPreference->id = $id;
		if (!$this->UserReligionPreference->exists()) {
			throw new NotFoundException(__('Invalid user religion preference'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserReligionPreference->delete()) {
			$this->Session->setFlash(__('The user religion preference has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user religion preference could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
