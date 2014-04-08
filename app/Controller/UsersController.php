<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public $components = array(
		'Stripe.Stripe'
	);
	
	public function route($phase = null){
		switch ($phase){
			case 1:
				return $this->redirect(array('action' => 'profile'));
				break;
			case 2:
				
				break;
			case 3:
				
				break;
			case 4:
				return $this->redirect(array('action' => 'calendar'));
				break;
			case 5:
				
				break;
			case 6:
				
				break;
			
			default:
				return $this->redirect(array('controller' => 'home', 'action' => 'index'));
		}
	}
	
	public function facebook_request() {
		$Facebook = new FB();
		
		$params = array(
				'scope' => 'user_about_me, user_activities, user_birthday, user_education_history, user_friends, user_hometown, user_interests, user_likes, user_location, user_photos, user_religion_politics, user_work_history, email, read_friendlists, user_photos',
				'redirect_uri' => 'http://' . $_SERVER['HTTP_HOST'] . '/users/facebook_response',
				'response_type' => 'token'
		);
		
		$this->redirect($Facebook->getLoginUrl($params));
	}
	
	public function facebook_response() {
		
	}
	
	public function login() {
		$newUser = false;
		
		$facebookToken = $this->Session->read('userFacebookToken');
		
		$userRecord = $this->User->find('first', array(
			'conditions' => array('User.facebook_token' => $facebookToken)
		));
		
		if (!$userRecord && $facebookToken != ''){
			$Facebook = new FB();
			$me = $Facebook->api('/me');
			
			$name = $me['name'];
			$email = $me['email'];
			
			$this->Connect->FB->setExtendedAccessToken();
			$accessToken = $this->Connect->FB->getAccessToken();
			
			$city = null;
			$state = null;
			$location = $this->Connect->me['location'];
			
			if (isset($location)){
				$locationArray = explode(',', $location);
				$city = $locationArray[0];
				$state = $locationArray[1];
			}
			
			$this->User->create();
			$this->User->set(array(
					'facebook_token' => $facebookToken,
					'access_token' => $accessToken,
					'name' => $name,
					'email_address' => $email,
					'user_phase_id' => 1,
					'user_role_id' => 2
			));
			$this->User->save();
			
			$this->saveFriends($facebookToken);
			
			$userRecord = $this->User->find('first', array(
				'conditions' => array('User.facebook_token' => $facebookToken)
			));
			
			$newUser = true;
		}
		else {			
			$this->Connect->FB->setExtendedAccessToken();
			$accessToken = $this->Connect->FB->getAccessToken();
			
			$this->User->set(array(
				'facebook_token' => $facebookToken,
				'access_token' => $accessToken
			));
				
			$this->User->save($this->request->data);
		}
		
		$this->Session->write('userFacebookToken', $facebookToken);
		
		$this->set('userRecord', $userRecord);
		
		if ($newUser)
			return $this->redirect(array('action' => 'profile'));
		else
			return $this->redirect(array('controller' => 'home', 'action' => 'index'));
	}
	
	public function logout() {
		//Uncomment if destruction of FB link is needed
		//$Facebook = new FB();
		//$Facebook->api('/me/permissions', 'DELETE');
				
		return $this->redirect(array('controller' => 'home', 'action' => 'index'));
	}
	
	public function profile() {
		$id = $this->Session->read('userFacebookToken');
		
		if (!$this->User->exists($id)) {
			return $this->redirect(array('controller' => 'home', 'action' => 'index'));
		}
		
		$options = array(
			'fields' => array('User.*'),
			'conditions' => array('User.' . $this->User->primaryKey => $id)
		);
		$userRecord = $this->User->find('first', $options);
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$phase = $userRecord['User']['user_phase_id'];
			
			if ($phase == 1)
				$phase = 2;
			
			$this->User->set(array(
				'facebook_token' => $id,
				'user_phase_id' => $phase
			));
			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				
				$options = array(
					'conditions' => array('UserBar.user_id = ' . $id)
				);
				$userBarsRecord = $this->User->UserBar->find('list', $options);
				
				if (count($userBarsRecord) == 0)
					return $this->redirect(array('controller' => 'users', 'action' => 'bars'));
				else
					return $this->redirect(array('controller' => 'home', 'action' => 'index'));
			} 
			else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} 
		else { 
			$this->request->data = $userRecord;
		}
		
		$states = $this->User->State->find('list');
		$countries = $this->requestAction(array('controller' => 'countries', 'action' => 'getCountries'));
		$ethnicities = $this->User->Ethnicity->find('list');
		$religions = $this->User->Religion->find('list');
		$zodiacSigns = $this->User->ZodiacSign->find('list');
		
		$this->set(compact('states', 'countries', 'ethnicities', 'religions', 'zodiacSigns'));
	}
	
	//TODO: Clean up this logic
	public function bars() {
		$id = $this->Session->read('userFacebookToken');
		
		if (!$this->User->exists($id)) {
			return $this->redirect(array('controller' => 'home', 'action' => 'index'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$userBarsSaveable = array();
			
			$this->UserBar = ClassRegistry::init('UserBar');
			$this->UserBar->deleteAll(array('user_id' => $id), false);
			
			$userBars = $this->request->data['UserBar'];
			
			foreach($userBars as $userBar) {
				$userBarsSaveable[] = array('user_id' => $id, 'bar_id' => $userBar);
			}
			
			if ($this->UserBar->saveAll($userBarsSaveable)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('controller' => 'home', 'action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		
		$bars = $this->requestAction(array('controller' => 'bars', 'action' => 'getBars'));
		$barTypes = $this->requestAction(array('controller' => 'bar_types', 'action' => 'getBarTypes'));
		
		$this->set(compact('bars', 'barTypes'));
	}
	
	public function calendar() {
		$id = $this->Session->read('userFacebookToken');
		
		if (!$this->User->exists($id)) {
			return $this->redirect(array('controller' => 'home', 'action' => 'index'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->request->data;
			
			$dropDate = $data['drop-date'];
				
			$this->User->set(array(
				'facebook_token' => $id,
				'preferred_date' => date("Y-m-d H:i:s", $dropDate)
			));
				
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
			
				return $this->redirect(array('action' => 'reserve'));
			}
			else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}
		
	public function reserve() {
		$id = $this->Session->read('userFacebookToken');
		
		if (!$this->User->exists($id)) {
			return $this->redirect(array('controller' => 'home', 'action' => 'index'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$userRecord = $this->User->find('first', array(
				'conditions' => array('User.facebook_token' => $id)
			));
			
			$data = $this->request->data;
			
			$data = array(
				'stripeToken' => $data['stripeToken'],
				'description' => $userRecord['User']['name'] . ' - ' . $userRecord['User']['email_address'] 
			);
			
			$customer = $this->Stripe->customerCreate($data);
			
			$data = array(
				'stripeCustomer' => $customer['stripe_id'],
				'amount' => '30.00'
			);
			
			$result = $this->Stripe->charge($data);
			
			$customerToken = $result['stripe_id'];
			
			$this->User->set(array(
				'facebook_token' => $id,
				'user_phase_id' => PHASE_4,
				'vault_token' => $customerToken
			));
			
			$this->User->save();
			
			//TODO: Redirect to Facebook Messenger
			$this->redirect(array('controller' => 'home', 'action' => 'index'));
		}
	}
	
	private function saveFriends($facebookToken) {
		$this->User->UserFriend->deleteAll(array('UserFriend.user_id' => $facebookToken), false);
	
		$Facebook = new FB();
		$friends = $Facebook->api('/me/friends');
		$friendsData = $friends['data'];
	
		$friendsArray = array();
	
		for($i = 0; $i < count($friendsData); $i++){
			$userFriend = array('user_id' => $facebookToken, 'friend_facebook_token' => $friendsData[$i]['id']);
			$friendsArray[$i] = array('UserFriend' => $userFriend);
		}
	
		$this->User->UserFriend->saveAll($friendsArray);
	}
	
	public function admin_getUsersByPhase($user_phase_id = 0) {
		$users = $this->User->find('all', array(
			'fields' => array('User.*'),
			'conditions' => array(
				'User.user_phase_id' => $user_phase_id,
				'User.status' => ACTIVE
			)
		));
		
		return $users;
	}
	
	public function admin_getUser($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user = $this->User->find('first', $options);
		
		$this->autoRender=false;
		
		$return = array('response' => $user);
		
		return json_encode($return);
	}
	
	public function admin_getUserBars($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		$userBars = $this->requestAction(array('controller' => 'userBars', 'action' => 'getUserBars'),
			array('pass' => array($id))
		);
		
		$this->autoRender=false;
		
		$return = array('userBars' => $userBars);
		
		return json_encode($return);
	}
	
	public function admin_findMatches($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user = $this->User->find('first', $options);
		
		$lat = $user['User']['lat'];
		$long = $user['User']['long'];
		$interstedIn = $user['User']['interested_in'] == true ? 1 : 0;
		
		//TODO: Disjoint with User Friends table
		$users = $this->User->query('SELECT *
				FROM (
					SELECT *,
						(3959 *
						acos(cos(radians(' . $lat . ')) * cos(radians(`lat`)) *
						cos(radians(`long`) - radians(' . $long . ')) +
						sin(radians('. $lat . ')) *
						sin(radians(`lat`)))) AS distance
					FROM users
				) AS User
				WHERE distance < 25 AND sex = ' . $interstedIn . ' AND status = ' . ACTIVE . ' AND user_phase_id = ' . PHASE_4);
		
		$this->autoRender=false;
		
		$return = array('response' => $users);
		
		return json_encode($return);
	}
	
	public function admin_index() {
		$this->User->unbindModel(array('belongsTo' => array('State')));
		$usersActive = $this->User->find('all', array(
			'fields' => array('User.*', 'State.*', 'Country.*'),
        	'conditions' => array(
        		'User.status' => ACTIVE
        	),
			'joins' => array(
				array(
					'table' => 'states',
					'alias' => 'State',
					'type' => 'left',
					'foreignKey' => true,
					'conditions'=> array('User.state_id = State.id')
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
		
		$this->User->unbindModel(array('belongsTo' => array('State')));
		$usersInactive = $this->User->find('all', array(
			'fields' => array('User.*', 'State.*', 'Country.*'),
        	'conditions' => array(
        		'User.status' => INACTIVE
        	),
			'joins' => array(
				array(
					'table' => 'states',
					'alias' => 'State',
					'type' => 'left',
					'foreignKey' => true,
					'conditions'=> array('User.state_id = State.id')
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
		
		$this->set(compact('usersActive', 'usersInactive'));
	}

	public function admin_data($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	public function admin_profile($id = null) {
		if (!$this->User->exists($id)) {
			return $this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		
		$this->User->unbindModel(array('belongsTo' => array('State')));
		$options = array(
			'fields' => array('User.*', 'State.*', 'Country.*'),
			'conditions' => array('User.' . $this->User->primaryKey => $id),
			'joins' => array(
				array(
					'table' => 'states',
					'alias' => 'State',
					'type' => 'left',
					'foreignKey' => true,
					'conditions'=> array('User.state_id = State.id')
				),
				array(
					'table' => 'countries',
					'alias' => 'Country',
					'type' => 'left',
					'foreignKey' => true,
					'conditions'=> array('Country.id = State.country_id')
				)
			)
		);
		$userRecord = $this->User->find('first', $options);
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		else {
			$this->request->data = $userRecord;
		}
		
		$states = $this->User->State->find('list');
		$countries = $this->requestAction(array('controller' => 'countries', 'action' => 'getCountries'));
		$ethnicities = $this->User->Ethnicity->find('list');
		$religions = $this->User->Religion->find('list');
		$zodiacSigns = $this->User->ZodiacSign->find('list');
		$userPhases = $this->User->UserPhase->find('list');
		
		$this->set(compact('states', 'countries', 'ethnicities', 'religions', 'zodiacSigns', 'userPhases'));
	}

	public function admin_delete($id = null) {
		$this->User->id = $id;
		
		if (!$this->User->exists()) {
			return $this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		
		if ($this->User->saveField('status', 0)) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller' => 'users', 'action' => 'index'));
	}
	
	public function admin_restore($id = null) {
		$this->User->id = $id;
		
		if (!$this->User->exists()) {
			return $this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		
		if ($this->User->saveField('status', 1)) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller' => 'users', 'action' => 'index'));
	}
}