<?php
App::uses('AppController', 'Controller');
/**
 * BuyingStations Controller
 *
 * @property BuyingStation $BuyingStation
 */
class BuyingStationsController extends AppController {

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
		$this->BuyingStation->recursive = 0;
		$this->set('buyingStations', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {

		$this->BuyingStation->id = $id;
		if (!$this->BuyingStation->exists()) {
			throw new NotFoundException(__('Invalid buying station'));
		}

		$this->set('buyingStation', $this->BuyingStation->read(null, $id));

		//Query to get total number of farmers in this Buying Station
		$this->set('farmersNum', $this->BuyingStation->FarmerGroup->Farmer->find('count', array(
			'conditions' => array('Farmer.buying_station_id' => $id, 'Farmer.user_category_id' => 3)
		) ));

		//Query to get total number of Farmer Groups in this Buying Station
		$this->set('farmerGroupNum', $this->BuyingStation->FarmerGroup->find('count', array(
			'conditions' => array('FarmerGroup.buying_station_id' => $id)
		) ));

		//Unbind the association between Production and Inspection
		$this->BuyingStation->FarmerGroup->Farmer->Production->unbindModel(
			array('hasMany' => array('Inspection'))
		);

		//Query to get all Production info for each farmer(user_category_id=3) in this buying station
		$allProduction = $this->BuyingStation->FarmerGroup->Farmer->Production->find('all', array(
			'fields' => array('Production.land_area', 'Production.production_area_size', 'Production.yield'),
			'conditions' => array('User.buying_station_id' => $id, 'User.user_category_id' => 3)
		)	);

		$total_land_area = 0; $total_production_estimate = 0;
		foreach ($allProduction as $production) {
			$total_land_area			+= $production['Production']['land_area']; //echo 'land area'.$total_land_area.'<br />';
			$total_production_estimate	+= $production['Production']['production_area_size'] * $production['Production']['yield'];
		}
		//echo 'Total Land Area: '.$total_land_area.'<br />';//echo 'Total Expected Production: '.$total_expected_production;
		$this->set('total_land_area', $total_land_area);
		$this->set('total_production_estimate', $total_production_estimate);

	}//end function view()

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BuyingStation->create();
			if ($this->BuyingStation->save($this->request->data)) {
				$this->Session->setFlash(__('A new buying station has been added'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Buying station could not be added. Please, try again.'));
			}
		}
		$states = $this->BuyingStation->State->find('list');
		$this->set(compact('states'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->BuyingStation->id = $id;
		if (!$this->BuyingStation->exists()) {
			throw new NotFoundException(__('Invalid buying station'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BuyingStation->save($this->request->data)) {
				//$name = $this->BuyingStation->field('name');
				$name = $this->request->data['BuyingStation']['name'];
				$this->Session->setFlash(__('The buying station: '.$name.', has been updated'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('There is an error. Please, check your entry & try again.'));
			}
		} else {
			$this->request->data = $this->BuyingStation->read(null, $id);
		}
		$states = $this->BuyingStation->State->find('list');
		$this->set(compact('states'));
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
		$this->BuyingStation->id = $id;
		$name = $this->BuyingStation->field('name');
		if (!$this->BuyingStation->exists()) {
			throw new NotFoundException(__('Invalid buying station'));
		}
		if ($this->BuyingStation->delete()) {
			$this->Session->setFlash(__('Buying station '.$name.' has been  deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Buying station '.$name.' was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function report_by_state() {

		$this->BuyingStation->recursive = 3;
		$this->set( 'stations', $this->BuyingStation->find('all',
			array(
				 'order' => array('BuyingStation.state_id DESC'),
				// 'limit' => 3
			)
		) );

//		$this->BuyingStation->FarmerGroup->recursive = 3;
//		$this->set( 'groups', $this->BuyingStation->FarmerGroup->find('all',
//			array(
//				'fields' => array('FarmerGroup.name'),
//				//'conditions' => array('Farmer.user_category_id' => 3),
//				//'limit' => 1
//			)
//		) );

	}//end report_by_state

}//end Class BuyingStationController
