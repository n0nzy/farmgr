<?php
App::uses('AppController', 'Controller');
/**
 * Inspections Controller
 *
 * @property Inspection $Inspection
 * @property Production $Production
 */
class InspectionsController extends AppController {

	public $uses = array('Inspection','Production');

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

		// All logged in users can view the list of every farmer whose production has inspection information
		if ($this->action === 'index') {
		    return true;
		}

	    // General: Only the person who entered a farmer's information can edit and/or delete it
		// Specific: This checks if the action contains view, edit, delete or entered and performs check.
	    if (in_array($this->action, array('add', 'view', 'edit', 'delete'))) {

			//Trying to obtain the information from the URL by accessing the 'passed' arguments from the Request Parameters
	        $productionId = $this->request->params['pass'][0];	//'pass' stands for 'passed' arguments in URL

			if ( ($this->action === 'add') || ($this->action === 'edit') || ($this->action === 'delete') ) {
				//For 'add' actions, you consult the Production Model for authorization...
				if ($this->Production->isEnteredBy($productionId, $user['id'])) {	return TRUE; }
			}//end if($this->action)

	    }//end if (in_array())

		//Checks if the currently logged in user is an Administrator
		if ($this->Auth->user('user_category_id') == '1' ) {
			if (in_array($this->action, array('iindex', 'registry', 'iedit', 'iview'))) {
				return TRUE;
			}
		}

	}//end isAuthorized()

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {

		//Call the method that 'fetches' inspection information
		$inspectionInfo = $this->_fetchAll();

		//Extract the farmer's ID from the inspection information returned
		foreach ($inspectionInfo as $inspection):
			$farmerIds[] = $inspection['Production']['user_id'];
		endforeach;

		$farmerNames = $this->Inspection->Production->User->find( 'all', array(
				'fields' => array('User.full_name'),
				'conditions' =>  array('User.id' => $farmerIds),
			) );
		$this->set('farmerNames', $farmerNames);

		// send to the 'view' an array of all inspections returned by the _fetchAll() method.
		$this->set('inspections', $inspectionInfo);

	}//end function index()

	public function iindex() {

		//Call the method that 'fetches' inspection information
		$inspectionInfo = $this->_fetchAll();

		//Extract the farmer's ID from the inspection information returned
		foreach ($inspectionInfo as $inspection):
			$farmerIds[] = $inspection['Production']['user_id'];
		endforeach;

		$farmerNames = $this->Inspection->Production->User->find( 'all', array(
				'fields' => array('User.full_name', 'User.first_name'),
				'conditions' =>  array('User.id' => $farmerIds),
				'order' => array(
					//'Production.id' => 'asc'
				)
		)	);
		$this->set('farmerNames', $farmerNames);

		// send to the 'view' an array of all inspections returned by the _fetchAll() method.
		$this->set('inspections', $inspectionInfo);

		$this->render('admin_index');

	}//end function adminIndex()

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {

		$this->Inspection->id = $id;
		if (!$this->Inspection->exists()) {
			throw new NotFoundException(__('Invalid inspection'));
		}
		$this->set('inspection', $this->Inspection->read(null, $id));

	}//end function view()

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add($id = null) {

		$this->Production->id = $id;
		if (!$this->Production->exists()) {
			throw new NotFoundException(__('This production info does not exist!'));
		}

		if ($this->request->is('post')) {
			//This manually sets the 'production_id' field of the 'Inspection' table.
			$this->request->data['Inspection']['production_id'] = $id;

			//This manually sets the 'entered_by' field of the currently logged in Field Officer
			$this->request->data['Inspection']['entered_by'] = $this->Auth->user('id');

			//I have to over-ride this manually because the value the form returns for this field is an array instead of a string...which will cause it NOT to save the data
			$this->request->data['Inspection']['compliance_year'] = $this->request->data['Inspection']['compliance_year']['year'];

			$this->Inspection->create();
			if ($this->Inspection->save($this->request->data)) {
				$this->Session->setFlash(__('The inspection information has been entered'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inspection information could not be saved. Please, check your entry & try again.'));
			}
		}

		//This returns an array of all users who are inspectors
		$inspectors = $this->Inspection->Inspector->all();

		$production = $this->Inspection->Production->find( 'first', array(
			'conditions' => array('Production.id' => $id)
		) );

		$this->set( compact('production', 'inspectors') );
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Inspection->id = $id;
		if (!$this->Inspection->exists()) {
			throw new NotFoundException(__('Invalid inspection'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Inspection->save($this->request->data)) {
				$this->Session->setFlash(__('The inspection has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inspection could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Inspection->read(null, $id);
		}
		$users = $this->Inspection->User->find('list');
		$products = $this->Inspection->Product->find('list');
		$this->set(compact('users', 'products'));
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
		$this->Inspection->id = $id;
		if (!$this->Inspection->exists()) {
			throw new NotFoundException(__('Invalid inspection'));
		}
		if ($this->Inspection->delete()) {
			$this->Session->setFlash(__('Inspection deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Inspection was not deleted'));
		$this->redirect(array('action' => 'index'));
	}//end function delete()

	/**
	 * the private _fetchAll() method
	 *
	 * @return array
	 */
	private function _fetchAll() {

		$this->Inspection->recursive = 0;

		// if user is not an administrator, then execute below:
		if ($this->Auth->user('user_category_id') != '1') {

			//set $myId to currently logged in user's ID
			$myId = '';$myId = $this->Auth->user('id');
			//var_dump($myId);

			//return inspections entered by currently logged in user (or field-officer)
			$this->paginate = array(
				'conditions' =>  array('Inspection.entered_by' => $myId),
				'limit' => 10,
				'order' => array(
					'Inspection.production_id' => 'asc'
				)
			);
			return $this->paginate('Inspection');

		}//end if ($this->Auth->user('user_category_id') != '1')

		//This line is only executed if the logged in user is an Administrator
		return $this->paginate();

	}//end function _fetchAll()

	public function registry() {

		//Call the method that 'fetches' inspection information
		$inspectionInfo = $this->_fetchAll();

		//Extract the farmer's ID from the inspection information returned
		foreach ($inspectionInfo as $inspection):
			$farmerIds[] = $inspection['Production']['user_id'];
		endforeach;

		$farmers = $this->Inspection->Production->User->find( 'all', array(
				'fields' => array('User.code', 'User.full_name', 'User.gender', 'User.address', 'User.phone'),
				'conditions' =>  array('User.id' => $farmerIds),
			) );
		$this->set('farmers', $farmers);

		// send to the 'view' an array of all inspections returned by the _fetchAll() method.
		$this->set('inspections', $inspectionInfo);

	}//end function registry()

}//end Class InspectionsController
