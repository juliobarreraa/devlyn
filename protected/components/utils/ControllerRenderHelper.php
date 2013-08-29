<?php 
/**
 * $Source$
 * $File$
 * $Revision$
 * @version $Id$
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera
 * @author   $Author$
 * @since   # $Date$
*/
class ControllerRenderHelper
{
	/**
	 * Muestra el formulario de identificarse
	 * @var LoginForm
	 */
	private $loginForm;

	/**
	 * Funciones globales a todo controlador
	 */
	public function __construct() {
		//Quitamos jQuery de los assets del controlador
		Yii::app()->clientScript->scriptMap=array(
		 	'jquery.js'=>false,
		 	'jquery.ajaxqueue.js'=>false,
		 	'jquery.metadata.js'=>false,
		);
	}

	/**
	 * Muestra el formulario de identificación
	 * @param $loginForm LoginForm Si es null se inicializa con un formulario por defecto
	 */
	public function setLoginForm(LoginForm $loginForm = null) {
		$this->loginForm = $loginForm;

		//Se inicializa el objeto si es nulo
		if(!$this->loginForm)
			$this->loginForm = new LoginForm;

		//Retornamos la instancia
		return $this;
	}

	public function getLoginForm() {
		//Si existe el loginForm entonces se retorna
		if($this->loginForm) return $this->loginForm;
		//si no entonces se inicializa y se retorna
		return $this->setLoginForm()->getLoginForm();
	}

	public function getBaseUrl($absolute = false) {
		if($absolute)
			return Yii::app()->createAbsoluteUrl('/');

		return Yii::app()->baseUrl;
	}
}
 ?>