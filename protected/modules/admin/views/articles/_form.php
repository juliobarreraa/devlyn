<?php
/* @var $this ArticlesController */
/* @var $model ArticlesDynamic */
/* @var $form CActiveForm */
?>
<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/ckeditor/ckeditor.js', CClientScript::POS_END); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'articles-dynamic-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class' => 'form-horizontal')
		)); ?>
	<div class="alert alert-info"><?php echo Yii::t('adminModule.articles dynamic','Los campos con * son necesarios')?></div>

<div class="control-group">
	<?php echo $form->labelEx($model,'dynamic_id', array('class' => 'control-label')); ?>
	<div class="controls">
	<?php echo $form->textField($model,'dynamic_id'); ?>
	<?php if ($model->hasErrors('dynamic_id')): ?>
		<small class="text-error"><?php echo $form->error($model,'dynamic_id'); ?></small>
	<?php endif ?>			</div>

</div>
<div class="control-group">
	<?php echo $form->labelEx($model,'title', array('class' => 'control-label')); ?>

	<div class="controls">
	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>

	<?php if ($model->hasErrors('title')): ?>					<small class="text-error"><?php echo $form->error($model,'title'); ?>
	</small>
	<?php endif ?>			</div>

</div>
<div class="control-group">
	<?php echo $form->labelEx($model,'content', array('class' => 'control-label')); ?>

	<div class="controls">
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'ckeditor')); ?>

		<?php if ($model->hasErrors('content')): ?>					<small class="text-error"><?php echo $form->error($model,'content'); ?>
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
