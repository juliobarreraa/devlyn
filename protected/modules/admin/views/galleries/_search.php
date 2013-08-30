<?php
/* @var $this GalleriesController */
/* @var $model GalleriesDynamic */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dynamic_id'); ?>
		<?php echo $form->textField($model,'dynamic_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resource_id'); ?>
		<?php echo $form->textField($model,'resource_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->