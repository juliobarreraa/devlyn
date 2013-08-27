<?php
/* @var $this ForumsController */
/* @var $model Forums */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'forums-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class' => 'form-horizontal')
		)); ?>
	<div class="alert alert-info"><?php echo Yii::t('adminModule.forums','Los campos con * son necesarios')?></div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'last_poster_id', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'last_poster_id'); ?>

				<?php if ($model->hasErrors('last_poster_id')): ?>
					<small class="text-error"><?php echo $form->error($model,'last_poster_id'); ?></small>
				<?php endif ?>			
			</div>

		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'name', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>

				<?php if ($model->hasErrors('name')): ?>
					<small class="text-error"><?php echo $form->error($model,'name'); ?></small>
				<?php endif ?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'description', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>

				<?php if ($model->hasErrors('description')): ?>
					<small class="text-error"><?php echo $form->error($model,'description'); ?></small>
				<?php endif ?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'password', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32)); ?>

				<?php if ($model->hasErrors('password')): ?>
					<small class="text-error"><?php echo $form->error($model,'password'); ?></small>
				<?php endif ?>
			</div>

		</div>
			
		<div class="control-group">
			<?php echo $form->labelEx($model,'show_rules', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'show_rules'); ?>

				<?php if ($model->hasErrors('show_rules')): ?>
					<small class="text-error"><?php echo $form->error($model,'show_rules'); ?></small>
				<?php endif ?>
			</div>

		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'parent_id', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'parent_id'); ?>

				<?php if ($model->hasErrors('parent_id')): ?>
					<small class="text-error"><?php echo $form->error($model,'parent_id'); ?></small>
				<?php endif ?>
			</div>

		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'rules_title', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'rules_title',array('size'=>60,'maxlength'=>255)); ?>

				<?php if ($model->hasErrors('rules_title')): ?>
					<small class="text-error"><?php echo $form->error($model,'rules_title'); ?></small>
				<?php endif ?>
			</div>

		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'rules_text', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textArea($model,'rules_text',array('rows'=>6, 'cols'=>50)); ?>

				<?php if ($model->hasErrors('rules_text')): ?>
					<small class="text-error"><?php echo $form->error($model,'rules_text'); ?></small>
				<?php endif ?>
			</div>

		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'enabled', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'enabled'); ?>

				<?php if ($model->hasErrors('enabled')): ?>
					<small class="text-error"><?php echo $form->error($model,'enabled'); ?></small>
				<?php endif ?>
			</div>

		</div>

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
