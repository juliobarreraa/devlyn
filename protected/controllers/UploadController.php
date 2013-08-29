<?php 
	/**
	* 
	*/
	class UploadController extends Controller
	{
		
		public function actionCreate()
		{
			$dir = Yii::getPathOfAlias('application.uploads');
			$uploaded = false;

			$model =  new Upload();

			if (isset($_POST['Upload'])) 
			{
				$model->attributes=$_POST['Upload'];
				$model->file=CuploadedFile::getInstance($model,'name');
				if ($model->validate()) 
					$uploaded=$model->file->saveAs($dir.'/'.$model->file->getName());
			}

			$this->render('create', array(
				'model' =>	$model,
				'uploaded' => $uploaded,
				'dir' => $dir,
				));
		}
	}
 ?>