<?php
/* @var $this ResourcesController */
/* @var $model Resources */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'resources-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class' => 'form-horizontal')
		)); ?>
	<div class="alert alert-info"><?php echo Yii::t('adminModule.resources','Los campos con * son necesarios')?></div>

				<div class="control-group">
			<?php echo $form->labelEx($model,'name', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->fileField($model,'name',array('size'=>60,'maxlength'=>100)); ?>

				<?php if ($model->hasErrors('name')): ?>					<small class="text-error"><?php echo $form->error($model,'name'); ?>
</small>
				<?php endif ?>			</div>

		</div>
		

		<div class="form-actions">
			<button class="btn btn-info" type="submit">
				<i class="icon-ok bigger-110"></i>
				<?php echo $model->isNewRecord ? Yii::t('forms', 'Crear') : Yii::t('forms', 'Guardar') ?>			</button>

			&nbsp; &nbsp; &nbsp;
			<button class="btn" type="reset">
				<i class="icon-undo bigger-110"></i>
				<?php echo Yii::t('forms', 'Reiniciar') ?>			</button>
		</div>
<?php $this->endWidget(); ?>
