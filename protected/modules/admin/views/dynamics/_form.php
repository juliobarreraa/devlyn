<?php
/* @var $this DynamicsController */
/* @var $model Dynamics */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/bootstrap-datetimepicker.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/bootstrap-datetimepicker.min.js', CClientScript::POS_END);
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/ckeditor/ckeditor.js', CClientScript::POS_END); ?>
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
				<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50, 'id' => 'ckeditorBrowserContent')); ?>
				<?php if ($model->hasErrors('content')): ?>
					<small class="text-error"><?php echo $form->error($model,'content'); ?></small>
				<?php endif ?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'instructions_content', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textArea($model,'instructions_content',array('rows'=>6, 'cols'=>50, 'id' => 'ckeditorBrowserInstructions')); ?>

				<?php if ($model->hasErrors('instructions_content')): ?>
					<small class="text-error"><?php echo $form->error($model,'instructions_content'); ?></small>
				<?php endif ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'answer', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textArea($model,'answer',array('rows'=>3, 'cols'=>80)); ?>

				<?php if ($model->hasErrors('answer')): ?>
					<small class="text-error"><?php echo $form->error($model,'answer'); ?></small>
				<?php endif ?>			
			</div>

		</div>

		<div class="control-group input-append date" id="enabled_at_picker">
			<?php echo $form->labelEx($model,'enabled_at', array('class' => 'control-label')); ?>

			<div class="controls">
				<?php echo $form->textField($model,'enabled_at',array('size'=>10,'maxlength'=>10, 'data-format' => 'dd/MM/yyyy HH:mm:ss', 'autocomplete' => 'off')); ?>
			    <span class="add-on">
			      <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
			    </span>
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


<?php Yii::app()->clientScript->registerScript('calendar', <<<EOF
    $('#enabled_at_picker').datetimepicker({
      language: 'es',
      format: 'dd/MM/yyyy HH:mm:ss'
    });
EOF
)?>