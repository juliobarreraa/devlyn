<?php
/* @var $this ResourcesController */
/* @var $model Resources */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'resources-form',
'enableAjaxValidation'=>false,
'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
<?php if (!$this->iframe): ?>
<div class="alert alert-info"><?php echo Yii::t('adminModule.resources','Los campos con * son necesarios')?></div>
<?php endif ?>

<?php if ($uploaded): ?>
<div class="alert alert-success"><?php echo Yii::t('adminModule.resources','Archivo cargado correctamente')?> </div>
<?php endif; ?>

<fieldset>
<legend><?php echo Yii::t('resources', 'Selecciona el fichero a subir. Recuerda que este no puede superar {{size}}', array('{{size}}' => $this->controllerRenderHelper->getIniMaxUploadFileSize())); ?></legend>
	<div class="control-group">
			<div class="controls">
				<?php echo $form->fileField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
				<?php if ($model->hasErrors('name')): ?>					
					<small class="text-error"><?php echo $form->error($model,'name'); ?></small>
				<?php endif ?>			
			</div>
	</div>

	<div class="form-actions">
		<button class="btn btn-info" type="submit">
			<i class="icon-ok bigger-110"></i>
			<?php echo $model->isNewRecord ? Yii::t('forms', 'Crear') : Yii::t('forms', 'Guardar') ?>			</button>
			&nbsp; &nbsp; &nbsp;
	</div>
</fieldset>
<?php $this->endWidget(); ?>
