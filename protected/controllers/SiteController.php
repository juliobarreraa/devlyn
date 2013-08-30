<?php
/**
 * $Source$
 * $File$
 * $Revision$
 * @version $Id$
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 * @author   $Author$
 * @since   # $Date$
*/
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$login=$this->controllerRenderHelper->getLoginForm();

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($login);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$login->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($login->validate() && $login->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}

		$this->controllerRenderHelper->setLoginForm($login);

		$model = Dynamics::model()->getDynamic("now");
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index', array('model' => $model));
	}

	/**
	 * Muestra el conjunto de instrucciones
	 * @return String
	 */
	public function actionInstructions() {
		$model = Dynamics::model()->getDynamic("now");

		$this->render('instructions', array('model' => $model));
	}

	public function actionGallery() {
		$model = Dynamics::model()->getDynamic("now");

		$this->render('gallery', array('model' => $model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}


	/**
	 * Listado de artículos de dinámica
	 * @return String
	 */
	public function actionGuide() {
		$model = Dynamics::model()->getDynamic("now");

		$this->render('answer_guide', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}