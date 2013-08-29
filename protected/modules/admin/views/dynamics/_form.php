<?php
/* @var $this DynamicsController */
/* @var $model Dynamics */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'dynamics-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class' => 'form-horizontal')
		)); ?>
	<div class="alert alert-info"><?php echo Yii::t('adminModule.dynamics','Los campos con * son necesarios')?></div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'title', array('class' => 'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
				<?php if ($model->hasErrors('title')): ?>
					<small class="text-error"><?php echo $form->error($model,'title'); ?></small>
				<?php endif ?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'content', array('class' => 'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
				<?php if ($model->hasErrors('content')): ?>
					<small class="text-error"><?php echo $form->error($model,'content'); ?></small>
				<?php endif ?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'instructions_content', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textArea($model,'instructions_content',array('rows'=>6, 'cols'=>50)); ?>

				<?php if ($model->hasErrors('instructions_content')): ?>					<small class="text-error"><?php echo $form->error($model,'instructions_content'); ?>
</small>
				<?php endif ?>			</div>

		</div>
				<div class="control-group">
			<?php echo $form->labelEx($model,'answer', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textArea($model,'answer',array('rows'=>6, 'cols'=>50)); ?>

				<?php if ($model->hasErrors('answer')): ?>					<small class="text-error"><?php echo $form->error($model,'answer'); ?>
</small>
				<?php endif ?>			</div>

		</div>

		<div class="control-group">
			<?php echo $form->labelEx($model,'enabled_at', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'enabled_at',array('size'=>10,'maxlength'=>10)); ?>
				<?php if ($model->hasErrors('enabled_at')): ?>
					<small class="text-error"><?php echo $form->error($model,'enabled_at'); ?></small>
				<?php endif ?>
			</div>

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
