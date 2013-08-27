<?php
/**
 * @author   $Author$
 */
/**
 * Modulo administrador, backend
 * $Source$
 * $File$
 * @version $Id$
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 * @since   # $Date$
*/
class AdminModule extends CWebModule
{
	public function init()
	{
		Yii::app()->theme = 'globalcms/backend';
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));

		Yii::app()->setComponents(array(
			'errorHandler'=>array(
				// use 'site/error' action to display errors
				'errorAction'=>'admin/default/error',
			),
			'user' => array(
				'loginUrl' => array('admin/default/login'),
			),
		));
		Yii::app()->setHomeUrl(array('default/index'));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
