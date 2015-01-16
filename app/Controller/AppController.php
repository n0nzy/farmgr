<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	//some comment...
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect'  => array('controller' => 'farmers', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users',   'action' => 'login'),
			'authorize' => array('Controller') // i am using the Auth's 'Controller' authorization object
        )
    );

    public function beforeFilter() {

		$this->Auth->allow('login', 'logout');
		$this->Auth->deny('delete');

    }//end public beforeFilter()

	public function isAuthorized($user) {

		//Attempting to check for logged in user's Category and allowing access to all areas within login area, if an 'admin'
//		if (isset($user['user_category_id']) && $user['user_category_id'] === '1') {
//			return true;
//		}

		// Default deny
		return false;

	}//end isAuthorized()

	public function beforeRender() {

		parent::beforeRender();
		//if (!empty($this->Auth->user('full_name'))):
			//$this->set('user_full_name', $this->Auth->user('full_name'));
		//endif;

	}//end beforeRender()

}//end Class AppController
