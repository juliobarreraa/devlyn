<?php
/**
 * Login, logout, pantalla principal del sitio
 * @author   $Author$
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 */
/**
 * $Source$
 * $File$
 * @version $Id$
 * @since   # $Date$
*/
class DefaultController extends Controller
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('login', 'error', 'logout'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'chat'),
				'roles'=>array('administrator'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Permite realizar la instalación del sistema, base de datos, alta de usuario root admin
	 * @param  string $step El paso que se esta llevando a cabo.
	 * @return string
	 */
	public function actionInstall($step=null) {
		$this->pageTitle = 'Registration Wizard';
		$this->render('install/index');
		//$this->process($step);
	}

	/**
	 * Acceso: /admin/default/index
	 * Renderiza la página principal
	 * @return string
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Acceso: /admin/default/chat
	 * Renderiza la ventana de chat
	 * @return string
	 */
	public function actionChat() {
		$this->render('chat');
	}

	/**
	 * Muestra pantalla de error con el mensaje de lo que ha sucedido, solo es visible cuando se genera un error en el sitio,
	 * el más común es error 404.
	 * @return string
	 */
	public function actionError() {
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else {
				if($error['code'] == 403 && Yii::app()->user->isGuest)
					$this->redirect(array('default/login'));
				elseif($error['code'] == 404)
					$this->render('error404', $error);
				else
					$this->render('error500', $error);
			}
		}
	}

	/**
	 * Acceso: /admin/default/login
	 * Muestra la pantalla de identificarse
	 * @return string
	 */
	public function actionLogin() {
		//Layout basic sin encabezado ni pie de página
		$this->layout = '//layouts/basic';

		if(!Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->homeUrl);
		}

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Acceso: /admin/default/logout
	 * Elimina la sesión del usuario actual y lo redirige a la pantalla de login
	 * @return string
	 */
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(array('default/login'));
	}
}