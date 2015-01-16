<?php
App::uses('AppController', 'Controller');
/**
 * UserCategories Controller
 *
 * @property UserCategory $UserCategory
 */
class UserCategoriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserCategory->recursive = 0;
		$this->set('userCategories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->UserCategory->id = $id;
		if (!$this->UserCategory->exists()) {
			throw new NotFoundException(__('Invalid user category'));
		}
		$this->set('userCategory', $this->UserCategory->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserCategory->create();
			if ($this->UserCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The user category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user category could not be saved. Please, try again.'));
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
		$this->UserCategory->id = $id;
		if (!$this->UserCategory->exists()) {
			throw new NotFoundException(__('Invalid user category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The user category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user category could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->UserCategory->read(null, $id);
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
		$this->UserCategory->id = $id;
		if (!$this->UserCategory->exists()) {
			throw new NotFoundException(__('Invalid user category'));
		}
		if ($this->UserCategory->delete()) {
			$this->Session->setFlash(__('User category deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User category was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
