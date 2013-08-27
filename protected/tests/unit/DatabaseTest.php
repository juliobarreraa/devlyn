<?php 

/**
 * $Source$
 * $File$
 * @version $Id$
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 * @author   $Author$
 * @since   # $Date$
*/
class DatabaseTest extends CDbTestCase {
	/**
	 * Nos aseguramos de que exista una conexión activa, configurada.
	 */
	public function testDbConnection() {
		$this->assertNotEquals(NULL, Yii::app()->db);
	}
}