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

		<iframe src="<?php echo CHtml::normalizeUrl(array('resources/create', 'iframe' => true, 'gid' => 0, 'did' => $model->dynamic_id)) ?>" id="iframe-resources"></iframe>
<?php $this->endWidget(); ?>
