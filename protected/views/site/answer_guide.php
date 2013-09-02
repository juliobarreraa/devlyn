<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.flexslider-min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/flexslider.css'); ?>
<?php Yii::app()->clientScript->registerScript('load_slider', <<<EOF
  $('#guide').flexslider({
    animation: "slide"
  });
EOF
, CClientScript::POS_READY); ?>

<div id="guide" class="flexslider">
	<ul class="slides">
	<?php if ($model->articlesDynamics): ?>
	<?php foreach ($model->articlesDynamics as $key => $value): ?>
		<li><?php echo $value->content ?></li>
	<?php endforeach ?>
	<?php endif ?>
	<li>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'answer-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>
			<div class="row">
				<?php echo $form->labelEx($dynamics,'answer'); ?>
				<?php echo $form->textField($dynamics,'answer'); ?>
				<?php echo $form->error($dynamics,'answer'); ?>
				<?php echo CHtml::submitButton(Yii::t('answers', 'Enviar')); ?>
			</div>
		<?php $this->endWidget(); ?>
	</li>
	</ul>
</div>