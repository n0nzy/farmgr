<?php
App::uses('AppController', 'Controller');
/**
 * FieldOfficers Controller
 *
 * @property FieldOfficer $FieldOfficer
 */
class FieldOfficersController extends AppController {

	public $uses = array('FieldOfficer');

	public $paginate = array(
		'conditions' => array('FieldOfficer.user_category_id' => '2' ),
        'limit' => 10,
        'order' => array(
            'FieldOfficer.id' => 'asc'
        )
    );

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
		$this->FieldOfficer->recursive = 0;
		$this->set('fieldOfficers', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->FieldOfficer->id = $id;
		if (!$this->FieldOfficer->exists()) {
			throw new NotFoundException(__('Invalid FieldOfficer'));
		}
		$this->set('fieldOfficer', $this->FieldOfficer->read(null, $id));
		$this->set('farmersNum', $this->FieldOfficer->BuyingStation->FarmerGroup->Farmer->find('count', array(
			'conditions' => array('Farmer.entered_by' => $id)
		)));
	}//end function view()

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {

		if ($this->request->is('post')) {

			//$this->request->data['FieldOfficer']['user_category_id'] = 2;

			//i am manually setting the 'users.user_category_id' field to a value equivalent to farmers in the 'user_category' table
			$this->request->data['FieldOfficer']['user_category_id'] = 2;

			//i am setting the entry person of this record to the currently logged in user.
			$this->request->data['FieldOfficer']['entered_by'] = $this->Auth->user('id');

			$this->FieldOfficer->create();
			if ($this->FieldOfficer->save($this->request->data)) {
				$this->Session->setFlash(__('The field officer has been added'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The FieldOfficer could not be saved. Please, check your entry & try again.'));
			}
		}
		//$titles = $this->FieldOfficer->Title->find('list');
		//$farmerGroups = $this->FieldOfficer->FarmerGroup->find('list');
		$buyingStations = $this->FieldOfficer->BuyingStation->find('list');
		$this->set(compact('titles', 'genders', 'farmerGroups', 'buyingStations'));

	}//end function add()

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->FieldOfficer->id = $id;
		if (!$this->FieldOfficer->exists()) {
			throw new NotFoundException(__('Invalid FieldOfficer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FieldOfficer->save($this->request->data)) {
				$this->Session->setFlash(__('The field officer has been updated'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The field officer could not be updated. Please, check your entry & re-try.'));
			}
		} else {
			$this->request->data = $this->FieldOfficer->read(null, $id);
		}
		//$titles = $this->FieldOfficer->Title->find('list');

		$buyingStations = $this->FieldOfficer->BuyingStation->find('list');
		$this->set(compact('titles', 'genders', 'buyingStations'));
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
		$this->FieldOfficer->id = $id;
		if (!$this->FieldOfficer->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->FieldOfficer->delete()) {
			$this->Session->setFlash(__('Field Officer has been deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Field Officer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}//end function delete()

	/**
	 *  produces a list of all field officers sorted by Buying Station
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @return void
	 */
	public function report_by_station() {

		$this->set( 'officers', $this->FieldOfficer->find('all',
			array(
				'conditions' => array('FieldOfficer.user_category_id' => 2),
				//'fields' => array('FieldOfficer.id', 'FieldOfficer.first_name', 'FieldOfficer.mid_name', 'FieldOfficer.last_name', 'FieldOfficer.full_name', 'FieldOfficer.gender', 'FieldOfficer.email', 'FieldOfficer.buying_station_id', 'FieldOfficer.entered_by'),
				'order' => array('FieldOfficer.buying_station_id ASC'),
				//'limit' => 2
			)
		) );

	}//end function report_by_station

}//End Class FieldOfficersController