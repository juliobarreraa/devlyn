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
class ResourcesController extends Controller
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
				'actions'=>array('index', 'view', 'create','update', 'delete', 'connector'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($iframe = false, $gid = null, $did = null)
	{
		if ($iframe) {
			$this->iframe = true;
		}

		$model=new Resources;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Resources']))
		{
			$model->attributes=$_POST['Resources'];
			if($model->save()) {
				// $model->id corresponde al identificador del recurso
				if ($gid == 0 && intval($did)) {
					//Averigiar si la dinámica existe
					if (($dynamic = Dynamics::model()->findByPk($did))) {
						$gallery = new GalleriesDynamic();
						$gallery->setAttributes(array(
							'dynamic_id' => $dynamic->id,
							'resource_id' => $model->id
						));

						$gallery->save();

						Yii::app()->user->setFlash('success', Yii::t('resources', 'Se guardo la galería con éxito'));
						$this->redirect(array('create', 'iframe' => true, 'gid' => 0, 'did' => $dynamic->id));
					}
				}

				$this->redirect(array('view','id'=>$model->id));
			}
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

		if(isset($_POST['Resources']))
		{
			$model->attributes=$_POST['Resources'];
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
		$dataProvider=new CActiveDataProvider('Resources');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Resources('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Resources']))
			$model->attributes=$_GET['Resources'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Nos permite listar archivos de la carpeta de recursos
	 * @return String
	 */
	public function actionConnector() {
		/**
		 * Dirección servidor
		 * @var string
		 */
		$connectorPath = "application.components.connectors.";

		// - Carga de archivos base para funcionamiento
		require_once Yii::getPathOfAlias($connectorPath) . DIRECTORY_SEPARATOR . "config.php";
		require_once Yii::getPathOfAlias($connectorPath) . DIRECTORY_SEPARATOR . "util.php";
		require_once Yii::getPathOfAlias($connectorPath) . DIRECTORY_SEPARATOR . "io.php";
		require_once Yii::getPathOfAlias($connectorPath) . DIRECTORY_SEPARATOR . "basexml.php";
		require_once Yii::getPathOfAlias($connectorPath) . DIRECTORY_SEPARATOR . "commands.php";
		require_once Yii::getPathOfAlias($connectorPath) . DIRECTORY_SEPARATOR . "phpcompat.php";

		if ( !$Config['Enabled'] ) {
			SendError( 1, 'This connector is disabled. Please check the "editor/filemanager/connectors/php/config.php" file' ) ;
		}

	    if (!isset($_GET)) {
	        global $_GET;
	    }
		if ( !isset( $_GET['Command'] ) || !isset( $_GET['Type'] ) || !isset( $_GET['CurrentFolder'] ) )
			return ;

		// Get the main request informaiton.
		$sCommand		= $_GET['Command'] ;
		$sResourceType	= $_GET['Type'] ;
		$sCurrentFolder	= GetCurrentFolder() ;

		// Check if it is an allowed command
		if ( ! IsAllowedCommand( $sCommand ) )
			SendError( 1, 'The "' . $sCommand . '" command isn\'t allowed' ) ;

		// Check if it is an allowed type.
		if ( !IsAllowedType( $sResourceType ) )
			SendError( 1, 'Invalid type specified' ) ;

		// File Upload doesn't have to Return XML, so it must be intercepted before anything.
		if ( $sCommand == 'FileUpload' )
		{
			FileUpload( $sResourceType, $sCurrentFolder, $sCommand ) ;
			return ;
		}

		CreateXmlHeader( $sCommand, $sResourceType, $sCurrentFolder ) ;

		// Execute the required command.
		switch ( $sCommand )
		{
			case 'GetFolders' :
				GetFolders( $sResourceType, $sCurrentFolder ) ;
				break ;
			case 'GetFoldersAndFiles' :
				GetFoldersAndFiles( $sResourceType, $sCurrentFolder ) ;
				break ;
			case 'CreateFolder' :
				CreateFolder( $sResourceType, $sCurrentFolder ) ;
				break ;
		}

		CreateXmlFooter() ;

		Yii::app()->end();
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Resources the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Resources::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Resources $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='resources-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
