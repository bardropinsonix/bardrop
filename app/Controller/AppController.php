<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller', 'FB', 'Facebook.Lib');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('Session', 'Facebook.Connect' => array('model' => 'User'), 'Utility');
	
	public $helpers = array('Facebook.Facebook');
	
	public function beforeFilter(){
		$action = $this->params['action'];
		
		if ($action != LOGOUT){
			//Get the user's Facebook token from the Session
			$facebookToken = $this->Session->read('userFacebookToken');
				
			//Set the user's Facebook token to the session if it isn't already set
			if (!isset($facebookToken) || $facebookToken == 0){
				$facebookToken = $this->Connect->FB->getUser();
				$this->Session->write('userFacebookToken', $facebookToken);
			}
			
			//Set user data
			if($facebookToken != 0){
				//Set the user's record
				$this->loadModel('User');
				$userRecord = $this->User->find('first', array(
					'conditions' => array('User.facebook_token' => $facebookToken)
				));
				$this->set('userRecord', $userRecord);
				
				//Check the user's role
				$role = $this->Session->read('userRole');
				
				if (!isset($role) && ($userRecord))
					$this->Session->write('userRole', $userRecord['User']['user_role_id']);
				
				//Check the user's rights
				$path = substr($this->here, 1);
				$pathPieces = explode('/', $path);
				
				if ('admin' == $pathPieces[0] && !$this->Utility->isAdmin())
					return $this->redirect('/');
			}
		}
		else {
			$this->Connect->FB->destroySession();
			$this->Session->destroy();
		}
	}
}