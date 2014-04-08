<?php 
App::uses('Component', 'Controller');
class UtilityComponent extends Component {
    public $components = array('Session');
    
    public function isAdmin() {
    	$role = $this->Session->read('userRole');
    		
    	if (ROLE_ADMIN == $role)
    		return true;
    		
    	return false;
    }
}
?>