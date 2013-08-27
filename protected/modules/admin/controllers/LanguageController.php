<?php

/**
 * @author   $Author$
 * @license http://www.codebit.org/licence
 */
/**
 * $Revision$
 * $Source$
 * $File$
 * @version $Id$
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 * @since   # $Date$
*/
class LanguageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'view', 'create','update', 'delete', 'read'),
				'roles'=>array('administrator'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);

		//Leeremos el contenido de los ficheros almacenados en messages de admin y de la aplicación root
		$files = new globalcms\components\utils\Files;
		$files->recursive = true;

		$lf = $files->readTreeDirectory(Yii::getPathOfAlias('application.messages.' . $model->dir));

		$this->render('view',array(
			 'model'=>$model
			,'lf'=>$lf
		));
	}

	/**
	 * Lee un fichero y devuelve el contenido parseado en un formulario, listo para ser editado.
	 * @param  integer $id   Identificador del idioma que se editará
	 * @param  string $name Nombre del fichero a editar
	 */
	public function actionRead($id,$name){
		$model = $this->loadModel($id);

		$lang_key_cache = 'language.read.' . $name;
		//Ruta donde se almacena el contenido del lenguaje
		$filedir = Yii::getPathOfAlias('application.messages.' . $model->dir).'/'.$name;

		/**
		 * Averiguamos si la clave $lang_key_cache ya se encuentra cacheada
		 * @var string
		 */
		if(!($lang = Yii::app()->cache->get($lang_key_cache))) {
			$file = new globalcms\components\utils\Files;
			$lang = $file->readContentAsArray($filedir);
			Yii::app()->cache->set('language.read.' . $name, $lang);
		}

		//Formulario que será mostrado para renderizar la vista de edición de lenguajes
		$formModel = new LanguageForm($lang);

		if(isset($_POST['LanguageForm'])) {
			/** @type array $value */
			foreach ($_POST['LanguageForm'] as $key => $value) {
				$formModel->$key = $value;
			}
			
			$formModel->saveToCache($name);
			if(!$formModel->save($filedir)) {
				Yii::app()->user->setFlash('error', Yii::t('adminModule.language', 'Ocurrio un error al guardar el archivo, verifica que tengas los permisos necesarios'));
			}
			else {
				Yii::app()->user->setFlash('success', Yii::t('adminModule.language', 'Guardado con éxito'));
			}

			$lang = Yii::app()->cache->get($lang_key_cache);
		}

		$this->render('read', array('langCollection' => $lang, 'model' => $model, 'formModel' => $formModel));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Language;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Language']))
		{
			$model->attributes=$_POST['Language'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Language']))
		{
			$model->attributes=$_POST['Language'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Language');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Language('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Language']))
			$model->attributes=$_GET['Language'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Language the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Language::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Language $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='language-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
