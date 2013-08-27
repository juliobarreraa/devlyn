<?php
/* @var $this LanguageController */
/* @var $model Language */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'language-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class' => 'form-horizontal')
		)); ?>
		<div class="alert alert-info"><?php echo Yii::t('adminModule.language','Los campos con * son necesarios')?></div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'id', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'id'); ?>

				<?php if ($model->hasErrors('id')): ?>
					<small class="text-error"><?php echo $form->error($model,'id'); ?></small>
				<?php endif ?>
			</div>

		</div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'dir', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'dir',array('size'=>60,'maxlength'=>64)); ?>

				<?php if ($model->hasErrors('dir')): ?>
					<small class="text-error"><?php echo $form->error($model,'dir'); ?></small>
				<?php endif ?>
			</div>

		</div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'name', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250)); ?>

				<?php if ($model->hasErrors('name')): ?>
					<small class="text-error"><?php echo $form->error($model,'name'); ?></small>
				<?php endif ?>
			</div>

		</div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'author', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>250)); ?>

				<?php if ($model->hasErrors('author')): ?>
					<small class="text-error"><?php echo $form->error($model,'author'); ?></small>
				<?php endif ?>
			</div>

		</div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'email', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>

				<?php if ($model->hasErrors('email')): ?>
					<small class="text-error"><?php echo $form->error($model,'email'); ?></small>
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
