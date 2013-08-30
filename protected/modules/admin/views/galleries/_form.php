<?php
/* @var $this GalleriesController */
/* @var $model GalleriesDynamic */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'galleries-dynamic-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class' => 'form-horizontal')
		)); ?>
	<div class="alert alert-info"><?php echo Yii::t('adminModule.galleries dynamic','Los campos con * son necesarios')?></div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'resource_id', array('class' => 'control-label'); ?>

			<div class="controls">
				<?php echo $form->textField($model,'resource_id'); ?>

				<?php if ($model->hasErrors('resource_id')): ?>
					<small class="text-error"><?php echo $form->error($model,'resource_id'); ?></small>
				<?php endif ?>
			</div>

		</div>

		<iframe src="<?php echo CHtml::normalizeUrl(array('resources/create', 'iframe' => true, 'gid' => 0)) ?>" id="iframe-resources"></iframe>
		

		<div class="form-actions">
			<button class="btn btn-info" type="submit">
				<i class="icon-ok bigger-110"></i>
				<?php echo $model->isNewRecord ? Yii::t('forms', 'Crear') : Yii::t('forms', 'Guardar') ?>
			</button>

			&nbsp; &nbsp; &nbsp;
			<button class="btn" type="reset">
				<i class="icon-undo bigger-110"></i>
				<?php echo Yii::t('forms', 'Reiniciar') ?>
			</button>
		</div>
<?php $this->endWidget(); ?>
