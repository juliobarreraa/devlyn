<?php
/* @var $this DinamicsmembersController */
/* @var $model DynamicsMembers */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'dynamics-members-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class' => 'form-horizontal')
		)); ?>
	<div class="alert alert-info"><?php echo Yii::t('adminModule.dynamics members','Los campos con * son necesarios')?></div>
					<div class="control-group">
			<?php echo $form->labelEx($model,'id'); ?>

			<div class="controls">
				<?php echo $form->textField($model,'id'); ?>

				<?php if ($model->hasErrors('id')): ?>					<small class="text-error"><?php echo $form->error($model,'id'); ?>
</small>
				<?php endif ?>			</div>

		</div>
				<div class="control-group">
			<?php echo $form->labelEx($model,'member_id'); ?>

			<div class="controls">
				<?php echo $form->textField($model,'member_id'); ?>

				<?php if ($model->hasErrors('member_id')): ?>					<small class="text-error"><?php echo $form->error($model,'member_id'); ?>
</small>
				<?php endif ?>			</div>

		</div>
				<div class="control-group">
			<?php echo $form->labelEx($model,'dynamic_id'); ?>

			<div class="controls">
				<?php echo $form->textField($model,'dynamic_id'); ?>

				<?php if ($model->hasErrors('dynamic_id')): ?>					<small class="text-error"><?php echo $form->error($model,'dynamic_id'); ?>
</small>
				<?php endif ?>			</div>

		</div>
				<div class="control-group">
			<?php echo $form->labelEx($model,'answer'); ?>

			<div class="controls">
				<?php echo $form->textArea($model,'answer',array('rows'=>6, 'cols'=>50)); ?>

				<?php if ($model->hasErrors('answer')): ?>					<small class="text-error"><?php echo $form->error($model,'answer'); ?>
</small>
				<?php endif ?>			</div>

		</div>
				<div class="control-group">
			<?php echo $form->labelEx($model,'updated_at'); ?>

			<div class="controls">
				<?php echo $form->textField($model,'updated_at',array('size'=>10,'maxlength'=>10)); ?>

				<?php if ($model->hasErrors('updated_at')): ?>					<small class="text-error"><?php echo $form->error($model,'updated_at'); ?>
</small>
				<?php endif ?>			</div>

		</div>
				<div class="control-group">
			<?php echo $form->labelEx($model,'created_at'); ?>

			<div class="controls">
				<?php echo $form->textField($model,'created_at',array('size'=>10,'maxlength'=>10)); ?>

				<?php if ($model->hasErrors('created_at')): ?>					<small class="text-error"><?php echo $form->error($model,'created_at'); ?>
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
