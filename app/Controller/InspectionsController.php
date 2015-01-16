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

		//Only Field Officers can access these actions
		if ($this->Auth->user('user_category_id') == '2' ) {
			if ( in_array($this->action, array('index', 'registry')) ) {
				return TRUE;
			}
		}

	    // General: Only the person who entered a farmer's information can edit and/or delete it
		// Specific: This checks if the action contains view, edit, delete or entered and performs check.
	    if (in_array($this->action, array('add', 'view', 'edit', 'delete'))) {

			if ($this->action === 'add') {
				//Trying to obtain the information from the URL by accessing the 'passed' arguments from the Request Parameters
				$productionId = $this->request->params['pass'][0];	//'pass' stands for 'passed' arguments in URL
				//For 'add' actions, you consult the Production Model for authorization...
				if ($this->Inspection->Production->isEnteredBy($productionId, $user['id'])) {	return TRUE; }
			}

			//Trying to obtain the information from the URL by accessing the 'passed' arguments from the Request Parameters
	        $inspectionId = $this->request->params['pass'][0];	//'pass' stands for 'passed' arguments in URL

			if ( ($this->action === 'view') || ($this->action === 'edit') || ($this->action === 'delete') ) {
				if ($this->Inspection->isEnteredBy($inspectionId, $user['id'])) {	return TRUE; }
			}//end if($this->action)

	    }//end if (in_array())

		//Execute actions for Administrators ONLY....
		if ($this->Auth->user('user_category_id') == '1' ) {
			if ( in_array($this->action, array('registry', 'latest_each', 'current_each')) ) {
				return TRUE;
			}
		}//end if ($this->Auth->user())

	}//end isAuthorized()

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {

		// send to the 'view' an array of all inspections returned by the _fetchAssigned() method.
		$this->set('inspections', $this->_fetchAssigned());

	}//end function index()

	public function admin_index() {

		// send to the 'view' an array of all inspections returned by the _fetchAll() method.
		$this->set('inspections', $this->_fetchAll());

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
		$inspection = $this->Inspection->read(null, $id);

		$this->set('inspection', $inspection);

		//Obtain Production Id for further queries
		$productionId = $inspection['Production']['id'];

		$farmer = $this->Inspection->Production->find('first', array(
			//'fields' => array('Production.id','User.code', 'User.full_name', 'User.id'),
			'conditions' => array('Production.id' => $productionId)
		) );

		$this->set('farmer', $farmer);

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

		//Get the Production info that this inspection info to-be-created is as associated with for display in the View layer
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
			throw new NotFoundException(__('Invalid inspection selected'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

			//I have to over-ride this manually because the value the form returns for this field is an array instead of a string...which will cause it NOT to save the data
			$this->request->data['Inspection']['compliance_year'] = $this->request->data['Inspection']['compliance_year']['year'];

			if ($this->Inspection->save($this->request->data)) {
				$this->Session->setFlash(__('Inspection information has been updated'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Inspection information could not be updated. Please, check your entry & try again.'));
				$this->request->data = $this->Inspection->read(null, $id);
			}
		} else {
			$this->request->data = $this->Inspection->read(null, $id);
		}

		$inspection = $this->request->data; //echo '<hr />';var_dump($inspection);echo '<hr />';

		//Get the production id that this inspection is associated with
		$productionId = $inspection['Inspection']['production_id'];

		//Get the associated Production info to this Inspection info
		$production = $this->Inspection->Production->find('first', array(
			'conditions' => array('Production.id' => $productionId )
		));

		//This returns an array of all users who are inspectors
		$inspectors = $this->Inspection->Inspector->all();

		//Set variables for the View Layer
		$this->set( compact('inspection', 'production', 'inspectors') );

		//$users = $this->Inspection->User->find('list');
		//$products = $this->Inspection->Product->find('list');
		//$this->set(compact('users', 'products'));
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
	 * Returns values ONLY IF logged in User is an Administrator
	 *
	 * @return array
	 */
	private function _fetchAll($options = null) {

		//initializing index counter for array
		$indexCounter = 0;

		$this->Inspection->recursive = 0;

		$conditions = null;

		//$date_from = $options['date_from'].' 00:';
		if (isset($options)) {
			$conditions = array(
				'Inspection.date_inspected BETWEEN ? AND ?' => array($options['date_from'],$options['date_to']),
				//'Inspection.date_inspected >=' => $options['date_from'],
				//'Inspection.date_inspected <=' => $options['date_to'],
				'Inspection.utz_status ' => $options['utz_status']
			);
		}

//		array('Post.read_count BETWEEN ? AND ?' => array(1,10))

		//array("Post.title !=" => "This is a post")

		// if user is an administrator, then execute below:
		if ($this->Auth->user('user_category_id') == '1') {

			$this->paginate = array(
				//'fields' => array('DISTINCT Inspection.production_id', 'Inspection.id', 'date_inspected', 'start_time', 'end_time', 'inspector_id', 'utz_status', 'compliance_year', 'entered_by', 'Production.user_id'),
				'limit' => 10,
				'conditions' => $conditions,
				//'order' => array('Inspection.date_inspected' => 'desc')
				'order' => array('User.id', 'Inspection.date_inspected DESC'), //string or array defining order
			);

			//returns all inspection information, using paginate() to return info in batches
			$inspections = $this->paginate('Inspection');

			$indexCounter = 0;

			foreach ($inspections as $inspection):
				//Extract the farmer's ID from the inspection information returned
				$farmerId = $inspection['Production']['user_id'];

				$farmer = $this->Inspection->Production->User->find('first', array(
					'fields' => array('User.code', 'User.full_name', 'User.gender', 'User.address', 'User.phone', 'FarmerGroup.name'),
					'conditions' => array('User.id' => $farmerId)
				) );
				//				echo "Farmer ID = $farmerId ";						print_r($farmer);
				$inspections[$indexCounter]['User']['code']							= $farmer['User']['code'];
				$inspections[$indexCounter]['User']['full_name']					= $farmer['User']['full_name'];
				$inspections[$indexCounter]['User']['gender']						= $farmer['User']['gender'];
				$inspections[$indexCounter]['User']['address']						= $farmer['User']['address'];
				$inspections[$indexCounter]['User']['phone']						= $farmer['User']['phone'];
				$inspections[$indexCounter]['FarmerGroup']['name']					= $farmer['FarmerGroup']['name'];
				$inspections[$indexCounter]['Production']['land_area']				= $farmer['Production'][0]['land_area'];
				$inspections[$indexCounter]['Production']['yield']					= $farmer['Production'][0]['yield'];
				$inspections[$indexCounter]['Production']['production_area_size']	= $farmer['Production'][0]['production_area_size'];
				$inspections[$indexCounter]['Production']['estimated_production']	= $farmer['Production'][0]['estimated_production'];
				$indexCounter++;
			endforeach;

			return $inspections;

		}//end if ($this->Auth->user('user_category_id') != '1')

		//This line is only executed if the logged in user is NOT an Administrator
		return FALSE;

	}//end function _fetchAll()

	/**
	 * Returns values ONLY IF logged in User is a Field Officer
	 *
	 * @return array
	 */
	private function _fetchAssigned() {

		//initializing index counter for array
		$indexCounter = 0;

		$this->Inspection->recursive = 0;

		// if user is not an administrator, then execute below:
		if ($this->Auth->user('user_category_id') != '1') {

			//set $myId to currently logged in user's ID
			$myId = '';$myId = $this->Auth->user('id');

			//return inspections entered by currently logged in user (or field-officer)
			$this->paginate = array(
				'conditions' =>  array('Inspection.entered_by' => $myId),
				'limit' => 10,
				//'order' => array('Inspection.production_id' => 'asc')
			);
			$inspections = $this->paginate('Inspection');

			foreach ($inspections as $inspection):
				//Extract the farmer's ID from the inspection information returned
				$farmerId = $inspection['Production']['user_id'];

				$farmer = $this->Inspection->Production->User->find('first', array(
					//'fields' => array('User.code', 'User.full_name', 'User.gender', 'User.address', 'User.phone'),
					'conditions' => array('User.id' => $farmerId)
				) );
				$inspections[$indexCounter]['User']['code'] = $farmer['User']['code'];
				$inspections[$indexCounter]['User']['full_name'] = $farmer['User']['full_name'];
				$inspections[$indexCounter]['User']['gender'] = $farmer['User']['gender'];
				$inspections[$indexCounter]['User']['address'] = $farmer['User']['address'];
				$indexCounter++;
			endforeach;

			return $inspections;

		}//end if ($this->Auth->user('user_category_id') != '1')

	}//end function _fetchAssigned()

	public function registry() {

		if ($this->request->is('post')) {
			//var_dump($this->request->data);
			//print_r($this->request->data);
                    
			$extract['utz_status'] = array();
                        
                        
                        if (array_key_exists('From', $this->request->data['DateInspected'] )) {  #you can try if ( isset() ) , instead!
                            $extract['date_from'] = '2011-03-11'; //default value
                            $extract['date_from'] = $this->request->data['DateInspected']['From'];
                        }
			
                        $extract['date_to'] = '2013-03-11'; //default value
                        if (array_key_exists('To', $this->request->data['DateInspected'] )) {                            
                            $extract['date_to'] = $this->request->data['DateInspected']['To'];
                        }
                        
			if (!empty($this->request->data['UtzStatus-approved'])) {
				$extract['utz_status']['approved'] = $this->request->data['UtzStatus-approved'];
			}
			if (!empty($this->request->data['UtzStatus-suspended'])) {
				$extract['utz_status']['suspended'] = $this->request->data['UtzStatus-suspended'];
			}
			if (!empty($this->request->data['UtzStatus-sanctioned'])) {
				$extract['utz_status']['sanctioned'] = $this->request->data['UtzStatus-sanctioned'];
			}
			
                        //echo '<hr/>';
			//var_dump($extract);

			//$this->redirect(array('action' => 'current_each'));

			//Call the method that 'fetches' inspection information
			$inspectionInfo = $this->_fetchAll($extract);
			// send to the 'view' an array of all inspections returned by the _fetchAll() method.
			$this->set('inspections', $inspectionInfo);
			//$this->render('registry');
		}
		else {
			$inspectionInfo = $this->_fetchAll();
			$this->set('inspections', $inspectionInfo);
			$this->render('registry');
		}


	}//end function registry()

	public function oldregistry() {
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
	}//end function oldregistry

	/**
	 * Returns the latest inspection for each farmer whose inspection info has been entered...
	 *
	 * @return array
	 */
	public function latest_each() {

		if ($this->request->is('post')) {
			var_dump($this->request->data) ;
		}

		//This returns an array of all users who are inspectors
		//$inspectors = $this->Inspection->Inspector->all();

	}//end function latest_each

	/**
	 * Returns the current inspection info for each farmer whose inspection info has been entered...
	 *
	 * @return array
	 */
	public function current_each() {

		//Fetch the latest production information for every farmer with production (& therefore, inspection) information
		$production = $this->Inspection->find( 'all', array(
			'fields' => array('production_id', 'MAX(date_inspected) AS date_inspected'),
			'group'  => array('Inspection.production_id'), //fields to GROUP BY
		) );

		//For each production information gotten above, fetch the inspection info...
		for ($i=0; $i < count($production); $i++) {
			$production_id  = $production[$i]['Inspection']['production_id'];
			$date_inspected = $production[$i][0]['date_inspected'];

			$options['fields'] = array(
				//'Farmer.code', CONCAT(Farmer.first_name, ' ', Farmer.mid_name, ' ', Farmer.last_name) AS 'Farmer__full_name', 'Farmer.first_name', 'Farmer.mid_name', 'Farmer.last_name', 'Farmer.gender', 'Farmer.address', 'Farmer.phone',
				//'Farmer.code', 'CONCAT(Farmer.first_name, Farmer.last_name) AS Farmer__full_name', 'Farmer.first_name', 'Farmer.mid_name', 'Farmer.last_name', 'Farmer.gender', 'Farmer.address', 'Farmer.phone',
				'Farmer.code', 'Farmer.first_name', 'Farmer.mid_name', 'Farmer.last_name', 'Farmer.gender', 'Farmer.address', 'Farmer.phone',
				'Production.land_area', 'Production.production_area_size', 'Production.estimated_production', 'Production.yield',
				'Inspection.date_inspected', 'Inspection.start_time', 'Inspection.end_time','Inspection.utz_status', 'Inspection.compliance_year',
				'Inspector.first_name', 'Inspector.last_name',
				'FarmerGroup.name'
			);

			$options['joins'] = array(
			    array('table' => 'production',
					'alias' => 'Production',
					'type' => 'LEFT',
					'conditions' => array(
						'Production.id = Inspection.production_id'
					)
				),
				array('table' => 'users',
				    'alias' => 'Farmer',
					'type' => 'LEFT',
					'conditions' => array(
						'Farmer.id = Production.user_id',
					)
				),
				array('table' => 'farmer_groups',
					'alias' => 'FarmerGroup',
					'type' => 'LEFT',
					'conditions' => array(
						'FarmerGroup.id = Farmer.farmer_group_id'
					)
				)
			);

			$options['conditions'] = array(
				'Inspection.production_id'  => $production_id,
				'Inspection.date_inspected' => $date_inspected
			);

			$this->Inspection->unbindModel(
				array('belongsTo' => array('Production'))
			);

			$inspections[] = $this->Inspection->find('first', $options);
		}//end for

		$this->set('inspections', $inspections);

	}//end function current_each()

}//end Class InscpectionsController
