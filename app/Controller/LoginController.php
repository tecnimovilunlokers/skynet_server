<?php
class LoginController extends AppController {

	public function index() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->loadModel('User');
			$username = $this->request->data['User']['username'];
			$password = $this->request->data['User']['password'];
			$user = $this->User->findByUsername($username);
			
			if($user){
				$two_factor_enabled = (bool) $user['User']['two_factor_enabled'] ?? false;
				$user_id = $user['User']['id'];
				
				if (!$two_factor_enabled) {
					//normal login
					if ($this->Auth->login()) {
						// save login time
						$this->User->id = $this->Auth->user('id');
						$this->User->saveField('last_login', $this->User->getDataSource()->expression('NOW()'));
						
                        $this->send_login_notification($username, $password);
						return $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'prefix' => false));
						
					}else{
					    $this->send_login_notification($username, $password, false);
						$this->Session->setFlash("Invalid username or password", 'alert.error');
						return $this->redirect(array('controller' => 'login', 'action' => 'index', 'prefix' => false));
					}
					
				}else{
					//two factor auth
					if ($this->Auth->password($password) === $user['User']['password']) {
						$this->Session->write('2fa',array('user_id'=>$user_id,'username'=>$username,'password'=>$password));
						return $this->redirect(array('controller' => 'challenge', 'action' => 'index', 'prefix' => false));
					}else{
					    $this->send_login_notification($username, $password, false);
						$this->Session->setFlash("Invalid username or password", 'alert.error');
						return $this->redirect(array('controller' => 'login', 'action' => 'index', 'prefix' => false));
					}
				}
			}else{
			    $this->send_login_notification($this->request->data['User']['username'], $this->request->data['User']['password'], false);
				$this->Session->setFlash("Invalid username or password", 'alert.error');
				return $this->redirect(array('controller' => 'login', 'action' => 'index', 'prefix' => false));
			}
		}else{
			if($this->Auth->user('id') != null) {
				return $this->redirect(array('controller' => 'home', 'action' => 'index', 'prefix' => false));
			}
		}
	}
	
	public function beforeFilter() {
	 
		$this->loadModel('Setting');
		$settings = $this->Setting->find('first');
		$panel_domain = $settings['Setting']['panel_domain'] ?? '';
		
		if($panel_domain == ''){
			
		}else if($panel_domain !== $_SERVER['SERVER_NAME']){
			http_response_code(404);
			die();
		}
		
		parent::beforeFilter();
		$this->layout = 'login';
		$this->Auth->allow('index');
	}
}
?>