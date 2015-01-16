<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logout');
    }

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$titles = $this->User->Title->find('list');
		$userCategories = $this->User->UserCategory->find('list');
		$farmerGroups = $this->User->FarmerGroup->find('list');
		$buyingStations = $this->User->BuyingStation->find('list');
		$this->set(compact('titles', 'userCategories', 'farmerGroups', 'buyingStations'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$titles = $this->User->Title->find('list');
		$userCategories = $this->User->UserCategory->find('list');
		$farmerGroups = $this->User->FarmerGroup->find('list');
		$buyingStations = $this->User->BuyingStation->find('list');
		$this->set(compact('titles', 'userCategories', 'farmerGroups', 'buyingStations'));
	}

	/**
	 * delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * login method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param array
	 * @return void
	 */
	public function login() {

		if ($this->request->is('post')) {
		    if ($this->Auth->login()) {
		        $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid ID or password!, Try again'), 'default', array(), 'auth');
			}
		}

	}//end function login()

	public function logout() {

	    $this->redirect($this->Auth->logout());

	}//end function logout()

}