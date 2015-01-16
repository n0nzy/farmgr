<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property Production $Production
 */
class FarmersController extends AppController {

	public $uses = array('User', 'Farmer');

	public $paginate = array(
		'conditions' => array('User.user_category_id' => '3' ),
        //'fields' => array('User.id', 'User.first_name', 'User.last_name', 'User.created'),
        'limit' => 10,
        'order' => array(
            'User.id' => 'asc'
        )
    );

	public function beforeFilter() {

		$this->Auth->allow('login', 'logout');

    }//end public beforeFilter()

	/**
	 * The Auth->isAuthorized() method
	 *
	 * @param array $user a non-numerically indexed associative array containing user information to be checked for authorization...by default, uses logged in user's info
	 * @return boolean
	 */
	public function isAuthorized($user) {

		// All logged in users can view the list of farmers
		if ($this->action === 'index') {
		    return true;
		}

		//This applies to logged in Field-Officers ONLY...
		if ($this->Auth->user('user_category_id') == '2' ) {
			if ($this->action === 'add') {
				return true;
			}
			if ($this->action === 'entered') {
				return true;
			}
			//Only the person who entered a farmer's information can view it (cannot edit/delete anymore)
			if ( in_array($this->action, array('view')) ) {

				//Trying to obtain the information from the URL by accessing the 'passed' arguments from the Request Parameters
				$farmerId = $this->request->params['pass'][0];

				//Perform a check at Model level, to see if $user[id] is authorized to access $farmerId
				if ($this->User->isEnteredBy($farmerId, $user['id'])) {
				    return true;
				}

			}//end if (in_array($this->action, array('view', 'edit', 'delete')))

		}//if ($this->Auth->user('user_category_id') == '2' )

		//Checks if the currently logged in user is an Administrator
		if ($this->Auth->user('user_category_id') == '1') {

			//Allows the Administrator to only view farmer information
			if ( in_array($this->action, array('admin_view', 'report_by_group', 'report_by_officer')) ) {
				    return true;
			}//end if (in_array($this->action, array('view')))

		}//if ($this->Auth->user('user_category_id') == '1')

		return parent::isAuthorized($user);

	}//end function isAuthorized()

	/**
	 * Returns to the view, a detailed list of all users who are limited to farmers
	 *
	 * @return void
	 */
	public function index() {

		//		$allFarmers = array();//		$allFarmers = $this->User->find('all', array(//			'conditions' => array('User.user_category_id' => '3')//		));

		// if user is not an administrator, then execute below:
		if ($this->Auth->user('user_category_id') != '1') {
			//set $myId to currently logged in user's ID
			$myId = '';$myId = $this->Auth->user('id');
			$conditions =''; $conditions = array('User.user_category_id' => '3', 'User.entered_by' => $myId) ; //$query = $this->User->find( 'all', array('conditions' => array('User.user_category_id' => '3')) );

			//Make use of the AppModel->ifCountIsZero() method to check if the number of rows returned by the query is ZERO
			if ($this->User->ifCountIsZero($conditions)) {

				//if yes, then render a seperate page('View/Farmers/zero_record.ctp') to notify user that he/she has not entered any record.
				$this->render('zero_record');
				return true;
			}

			//if number of records is NOT equal to zero, then render normal page for the view.
			$this->set('allFarmers', $this->paginate(array('User.entered_by' => $myId)));
			return true;
		}

		$this->layout = 'admin';
		//This line is only executed if the logged in user is an Administrator
		$this->set('allFarmers', $this->paginate());
		$this->render('admin_index');

	}//end function index()

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
			throw new NotFoundException(__('Farmer was not found!!!'));
		}
		//$this->set('user', $this->User->read(null, $id));
		$farmerinfo = $this->User->find('first', array(
			'conditions' => array('User.id' => $id)
		 ));
		$this->set('user', $farmerinfo);

	}//end function view()

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Farmer was not found!!!'));
		}
		//$this->set('user', $this->User->read(null, $id));
		 $farmerinfo = $this->User->find('first', array(
			'conditions' => array('User.id' => $id)
		 ));
		 $this->set('user', $farmerinfo);

	}//end function admin_view()

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {

		//Initializing variables
		$titles = ''; $farmerGroups = '';

		if ($this->request->is('post')) {

			//i am manually setting the 'users.user_category_id' field to a value equivalent to farmers in the 'user_category' table
			$this->request->data['User']['user_category_id'] = 3;

			//i am setting the entry person of this record to the currently logged in user.
			$this->request->data['User']['entered_by'] = $this->Auth->user('id');

			//i am setting the buying station of the farmer to that of the currently logged in Field-Officer
			$this->request->data['User']['buying_station_id'] = $this->Auth->user('buying_station_id');

			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Information has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The info about the farmer could not be saved. Please, review your entry & try again!'));
			}
		}

		$titles = $this->User->Title->find('list');
		$farmerGroups = $this->User->FarmerGroup->find('list', array(
			'conditions' =>  array('FarmerGroup.buying_station_id' => $this->Auth->user('buying_station_id')),
		));
		$this->set(compact('titles', 'genders', 'farmerGroups'));

	}//end function add()

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {

		//Initializing variables
		$titles = ''; $farmerGroups = '';

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('This farmer does not exist!'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

			//i am setting the buying station of the farmer to that of the currently logged in Field-Officer
			$this->request->data['User']['buying_station_id'] = $this->Auth->user('buying_station_id');

			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Farmer '.$this->request->data['User']['first_name'].' '.$this->request->data['User']['last_name'].'\'s bio-data has been updated.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Farmer '.$this->request->data['User']['first_name'].' '.$this->request->data['User']['last_name'].'\'s bio-data could not be updated. Please, check your entry & re-try.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}

		$titles = $this->User->Title->find('list');
		$farmerGroups = $this->User->FarmerGroup->find('list', array(
			'conditions' =>  array('FarmerGroup.buying_station_id' => $this->Auth->user('buying_station_id')),
		));
		$this->set(compact('titles', 'genders', 'farmerGroups'));

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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('Farmer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Farmer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}//end function delete()

	/**
	 * Returns to the view, a detailed list of all users who are limited to farmers
	 *
	 * @return void
	 */
	public function entered() {

		// if user is not an administrator, then execute below:
		if ($this->Auth->user('user_category_id') != '1') {
			//set $myId to currently logged in user's ID
			$myId = '';$myId = $this->Auth->user('id');
			$conditions =''; $conditions = array('User.user_category_id' => '3', 'User.entered_by' => $myId) ; //$query = $this->User->find( 'all', array('conditions' => array('User.user_category_id' => '3')) );

			$query = '';
			$query = array(
			  //  'conditions' => array('User.user_category_id' => '3', 'User.entered_by' => $myId), //array of conditions
			   // 'recursive' => 1,
			    //'fields' => array('User.first_name', 'User.mid_name', 'User.last_name', 'User.alias', 'User.gender', 'FarmerGroup.name'), //array of field names
			   // 'order' => array('User.created', 'User.farmer_group'), //string or array defining order
			);

			//if number of records is NOT equal to zero, then render normal page for the view.
			$this->set('allFarmers', $this->paginate($conditions));
			return true;
		}

		//This line is only executed if the logged in user is an Administrator
		$this->set('allFarmers', $this->paginate());

	}//end function entered()

	public function register() {

		$farmersInfo = ''; $farmerIds = '';

		//Call the method that 'fetches' farmers information
		$farmersInfo = $this->_fetchAll();

		//Extract the farmer's ID from the inspection information returned
		foreach ($farmersInfo as $farmer):
			$farmerIds[] = $farmer['User']['id'];
		endforeach;

		//$this->User->recursive = 0;
		//$this->set('allFarmers', $this->paginate());
		$this->set('allFarmers', $farmersInfo);

		$this->User->Production->find('all', array(
			'conditions' => array('Production.user_id' => $farmerIds)
		));

	}//end function register()

	/**
	 * the private _fetchAll() method
	 *
	 * @return array
	 */
	private function _fetchAll() {

		$this->User->recursive = 0;

		//return all farmers, 10 at a time
		$this->paginate = array(
			//'conditions' =>  array('Inspection.entered_by' => $myId),
			//'fields' => array('User.id', 'User.full_name'),
			'limit' => 10
		);
		return $this->paginate();

	}//end function _fetchAll()

	/**
	 *
	 */
	public function report_by_group() {

		//$this->User->recursive = 0;
		$this->set( 'farmers', $this->User->find('all',
			array(
				'conditions' => array('User.user_category_id' => 3),
				'order' => array('User.buying_station_id', 'FarmerGroup.name ASC'),
				//'limit' => 2
			)
		) );

	}

	/**
	 *
	 */
	public function report_by_officer() {

		//$this->User->recursive = 0;
		$this->set( 'farmers', $this->Farmer->find('all',
			array(
				'conditions' => array('Farmer.user_category_id' => 3),
				'order' => array('Farmer.entered_by ASC'),
				//'limit' => 2
			)
		) );

	}

}//end Class FarmersController