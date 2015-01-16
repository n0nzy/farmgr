<?php
App::uses('AppController', 'Controller');
/**
 * Titles Controller
 *
 * @property Title $Title
 */
class TitlesController extends AppController {

	public $layout = 'admin';

	/**
	 * The Auth->isAuthorized() method
	 *
	 * @param array $user  associative array containing user information to be checked for authorization...by default, uses logged in user's info
	 * @return boolean
	 */
	public function isAuthorized($user) {

		//Attempting to check for logged in user's Category and allowing access to all areas within login area, if an 'admin'
		if (isset($user['user_category_id']) && $user['user_category_id'] === '1') {
			return true;
		}

		return parent::isAuthorized($user);

	}//end isAuthorized()

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Title->recursive = 0;
		$this->set('titles', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Title->id = $id;
		if (!$this->Title->exists()) {
			throw new NotFoundException(__('Invalid title'));
		}
		$this->set('title', $this->Title->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Title->create();
			if ($this->Title->save($this->request->data)) {
				$this->Session->setFlash(__('The title has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The title could not be saved. Please, try again.'));
			}
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Title->id = $id;
		if (!$this->Title->exists()) {
			throw new NotFoundException(__('Invalid title'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Title->save($this->request->data)) {
				$this->Session->setFlash(__('The title has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The title could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Title->read(null, $id);
		}
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
		$this->Title->id = $id;
		if (!$this->Title->exists()) {
			throw new NotFoundException(__('Invalid title'));
		}
		if ($this->Title->delete()) {
			$this->Session->setFlash(__('Title deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Title was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}//end Class TitlesController