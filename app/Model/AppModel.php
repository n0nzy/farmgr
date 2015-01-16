<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	public function afterFind($results, $primary = false) {

		return $results;
	}

	/**
	 * This method counts the query and returns , returns false if not.
	 *
	 * @return boolean
	 */
	public function ifCountIsZero($conditions = false) {

		//This performs a count based on a passed condition, and returns true, IF the result of the count is ZERO.
		$number = $this->find('count', array('conditions' => $conditions));
		//return $number;
		if ($number == '0') {
			return TRUE;
		}
		return FALSE;

	}//end ifCountIsZero()

}//end Class AppModel
