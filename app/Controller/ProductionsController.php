<?php
App::uses('AppController', 'Controller');
/**
 * Productions Controller
 *
 * @property Production $Production
 */
class ProductionsController extends AppController {

	public $uses = array('Production');

	public function beforeFilter() {

		//$this->Auth->allow('');

    }//end public beforeFilter()

	/**
	 * Extension of the Auth->isAuthorized() method
	 *
	 * @param array $user a non-numerically indexed associative array containing user information to be checked for authorization...by default, uses logged in user's info
	 * @return boolean
	 */
	public function isAuthorized($user) {

		//Only Field Officers can access these actions
		if ($this->Auth->user('user_category_id') == '2' ) {
			if (in_array($this->action, array('index', 'toinspect'))) {
				return TRUE;
			}
		}

	    // General: Only the person who entered a farmer's information can edit and/or delete it (REQUIRES: an eXtra parameter)
		// Specific: This checks if the action contains add, view, edit, delete or toInspect and performs check.
	    if ( in_array($this->action, array('add', 'view', 'edit', 'delete')) ) {

			if ($this->action === 'add') {
				//Trying to obtain the information from the URL by accessing the 'passed' arguments from the Request Parameters
				$farmerId = $this->request->params['pass'][0];	//'pass' stands for 'passed' arguments in URL
				if ($this->Production->User->isEnteredBy($farmerId, $user['id'])) {	return TRUE; }
			}

			$productionId = $this->request->params['pass'][0];	//'pass' stands for 'passed' arguments in URL
			//Perform a check at Model level, to see if $production[id] was entered by logged-in user
	        if ($this->Production->isEnteredBy($productionId, $user['id'])) {
	            return true;
	        }

	    }//end if (in_array())

	}//end isAuthorized()

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {

		//return $this->_listAll();
		// sets 'productions' to whatever the _listAll() method returns
		$this->set('productions', $this->_fetchAll());

	}//end function index()

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Production->id = $id;
		if (!$this->Production->exists()) {
			throw new NotFoundException(__('The selected farm produce is invalid!'));
		}
		$this->set('production', $this->Production->read(null, $id));
	}

	/**
	 * This method adds a passed farmer's farm produce, it accepts the farmer's ID. No Production ID.
	 *
	 * @return void
	 */
	public function add($id = null) {

		$this->Production->User->id = $id;
		if (!$this->Production->User->exists()) {
			throw new NotFoundException(__('This farmer does not exist!'));
		}

		if ($this->request->is('post')) {
			$this->Production->create();

			//Trying to obtain the information from the URL by accessing the 'passed' arguments from the Request Parameters
                        $farmerId = $this->request->params['pass'][0];

			//i am setting the the Farmer's Id of this record to the passed Id in the URL.
			$this->request->data['Production']['user_id'] = $farmerId;

			//i am setting the entry person of this record to the currently logged in user.
			$this->request->data['Production']['field_officer_id'] = $this->Auth->user('id');

			if ($this->Production->save($this->request->data)) {
				$this->Session->setFlash(__('The farmer\'s produce has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('This farmer\'s produce could not be saved. Please, try again.'));
			}
		}//end if ($this->request->is('post'))

		$farmer = $this->Production->User->find( 'first', array(
			'conditions' => array('User.id' => $id)
		) );

		$products = $this->Production->Product->find('list');

		$this->set(compact('farmer', 'products'));

	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {

		$this->Production->id = $id;
		if (!$this->Production->exists()) {
			throw new NotFoundException(__('Produce Info is invalid'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Production->save($this->request->data)) {
				$this->Session->setFlash(__('The farmer\'s produce has been updated'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The farmer\'s produce could not be updated. Please, check your entry.'));
			}
		} else {
			$this->request->data = $this->Production->read(null, $id);
		}

		//This fetches the row information where the Production.id is equal to $id, from there i can fetch the farmer_id
		$info = $this->Production->find('first', array(
			'conditions' => array('Production.id' => $id)
		 ));

		$products = $this->Production->Product->find('list');
		$this->set(compact('info', 'products'));

	}//end function edit()

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
		$this->Production->id = $id;
		if (!$this->Production->exists()) {
			throw new NotFoundException(__('Invalid production'));
		}
		if ($this->Production->delete()) {
			$this->Session->setFlash(__('Farm Produce deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Farm Produce was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * the private _fetchAll() method
	 *
	 * @return array
	 */
	private function _fetchAll() {

		$this->Production->recursive = 0;

		// if user is not an administrator, then execute below:
		if ($this->Auth->user('user_category_id') != '1') {

			//set $myId to currently logged in user's ID
			$myId = '';$myId = $this->Auth->user('id');

			//$this->set('productions', $this->paginate(array('production.field_officer_id' => $myId)));
			return $this->paginate(array('Production.field_officer_id' => $myId));
		}

		//This line is only executed if the logged in user is an Administrator
		//$this->set('productions', $this->paginate());
		return $this->paginate();

	}//end function _fetchAll()

	/**
	 * the public toInspect() method
	 *
	 * @return array
	 */
	public function toInspect() {

		$this->set('productions', $this->_fetchAll());

	}//end function toInspect()

}//end Class ProductionsController