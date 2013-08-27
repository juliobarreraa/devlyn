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
class ParamsTest extends CTestCase
{
	
	public function testParamEmail() {
		$this->assertNotEquals(NULL, Yii::app()->params['adminEmail']);
		$this->assertNotEquals('', Yii::app()->params['adminEmail']);
	}
}