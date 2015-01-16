<?php
App::uses('AppController', 'Controller');
/**
 * FarmerGroups Controller
 *
 * @property FarmerGroup $FarmerGroup
 */
class FarmerGroupsController extends AppController {

	//public $layout = 'admin';

	/**
	 * The Auth->isAuthorized() method
	 * Note: Logged in user's info can be accessed in two ways, namely:
	 *	a) the user[] array
	 *  b) the $this->Auth->user() method
	 *
	 * @param array $user  associative array containing user information to be checked for authorization...by default, uses logged in user's info
	 * @return boolean
	 */
	public function isAuthorized($user) {

		//This section applies to Field Officers ONLY
		if ($this->Auth->user('user_category_id') == '2' ) {

			//Field-Officers are limited to the two actions below
			if (in_array($this->action, array('index', 'view'))) {

				//Specific check for the view action
				if ($this->action === 'view') {

					$farmerGroupId	 = $this->request->params['pass'][0];
					$buyingStationId = $user['buying_station_id'];

					//Perform a check at Model level, to see if buyingStation belongs to farmerGroup
					if (!$this->FarmerGroup->belongsToBuyingStation($farmerGroupId, $buyingStationId)) {
					    return FALSE;
					}

				}//end if ($this->action === 'view')

				return TRUE;

			}//end if (in_array($this->action, array('index', 'view')))

		}//end if ($this->Auth->user('user_category_id') == '2' )

		//This section applies to Administrators ONLY :
		//If logged-in User is Admin, then allow access to the following actions (in the ffg lines of code) below:
		if (isset($user['user_category_id']) && $user['user_category_id'] === '1') {

			//Allow access to the following actions (in the line of code) below
			if (in_array($this->action, array('admin_index', 'admin_view', 'edit', 'delete', 'report_farmers', 'report_by_station') )) {

				return TRUE;

			}//end if (in_array($this->action, array('') ))

		}//end if (isset($user['user_category_id']) && $user['user_category_id'] === '1')

		return parent::isAuthorized($user);

	}//end isAuthorized()

	/**
	 * index method: Should be accessible only by Field Officers
	 * returns all Farmer Groups in Field Officer's Buying Station
	 *
	 * @return void
	 */
	public function index() {

		$this->FarmerGroup->recursive = 0;

		//set $buyingStationId to currently logged in Field-Officer's Buying Station ID
		$buyingStationId = '';$buyingStationId = $this->Auth->user('buying_station_id');

		$this->set('farmerGroups', $this->paginate(array('FarmerGroup.buying_station_id' => $buyingStationId)));

	}//end function index

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {

		$this->FarmerGroup->recursive = 0;
		$this->set('farmerGroups', $this->paginate());

	}//end function admin_index

	/**
	 * view method: accessible by Field Officers and ...
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->FarmerGroup->id = $id;
		if (!$this->FarmerGroup->exists()) {
			throw new NotFoundException(__('Invalid farmer group'));
		}
		$this->set('farmerGroup', $this->FarmerGroup->read(null, $id));
		$this->set('farmersNum', $this->FarmerGroup->Farmer->find('count', array(
			'conditions' => array('Farmer.farmer_group_id' => $id, 'Farmer.user_category_id' => 3)
		) ));
	}//end view()

	/**
	 * admin_view method: accessible ONLY by administrators
	 * responsible for fetching more detailed info about a farmer group
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->FarmerGroup->id = $id;
		if (!$this->FarmerGroup->exists()) {
			throw new NotFoundException(__('Invalid farmer group'));
		}
		$this->set('farmerGroup', $this->FarmerGroup->read(null, $id));
		$this->set('farmersNum', $this->FarmerGroup->Farmer->find('count', array(
			'conditions' => array('Farmer.farmer_group_id' => $id, 'Farmer.user_category_id' => 3)
		) ));
	}//end admin_view()

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {

		if ($this->request->is('post')) {

			//i am setting the entry person of this record to the currently logged in user.
			$this->request->data['FarmerGroup']['entered_by'] = $this->Auth->user('id');

			$this->FarmerGroup->create();
			if ($this->FarmerGroup->save($this->request->data)) {
				$name = $this->request->data['FarmerGroup']['name'];
				$this->Session->setFlash(__('A new Farmer Group: '.$name.', has been entered'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Farmer group could not be entered. Please, check entry & try again.'));
			}
		}
		$buyingStations = $this->FarmerGroup->BuyingStation->find('list');
		$this->set(compact('buyingStations'));

	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->FarmerGroup->id = $id;
		if (!$this->FarmerGroup->exists()) {
			throw new NotFoundException(__('Invalid farmer group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FarmerGroup->save($this->request->data)) {
				$name = $this->request->data['FarmerGroup']['name'];
				$this->Session->setFlash(__('The farmer group: '.$name.', has been updated'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('There is an error. Please, check your entry & try again.'));
			}
		} else {
			$this->request->data = $this->FarmerGroup->read(null, $id);
		}
		$buyingStations = $this->FarmerGroup->BuyingStation->find('list');
		$this->set(compact('buyingStations'));
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
		$this->FarmerGroup->id = $id;
		$name = $this->FarmerGroup->field('name');
		if (!$this->FarmerGroup->exists()) {
			throw new NotFoundException(__('Invalid farmer group'));
		}
		if ($this->FarmerGroup->delete()) {
			$this->Session->setFlash(__('Farmer group: '.$name.', has been deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Farmer group: '.$name.', was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * report_farmers method: displays a list of all farmers grouped according to their farmer groups
	 *
	 * @return void
	 */
	public function report_farmers() {

		$this->FarmerGroup->recursive = 0;
		$this->set( 'farmers', $this->FarmerGroup->Farmer->find('all',
			array(
				'conditions' => array('Farmer.user_category_id' => 3),
				'order' => array('Farmer.farmer_group_id ASC')
			)
		) );

	}//end report_farmers

	/**
	 * report_by_station method: displays a list of all farmer groups grouped by Buying Station
	 *
	 * @return void
	 */
	public function report_by_station() {

		$this->FarmerGroup->recursive = 0;
		$this->set( 'farmerGroups', $this->FarmerGroup->find('all',
			array(
				 //'group' => array('FarmerGroup.buying_station_id'), //fields to GROUP BY
				 'order' => array('FarmerGroup.buying_station_id', 'FarmerGroup.name ASC')
			)
		) );

	}//end report_by_station

}//End Class FarmerGroupsController