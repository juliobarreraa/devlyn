<?php
/* @var $this LanguageController */
/* @var $model Language */

$this->breadcrumbs=array(
	Yii::t('adminModule.language', 'Idiomas')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('adminModule.language', 'Editar'),
);

$this->menu=array(
	array('label'=>'List Language', 'url'=>array('index'),'thumb' => '_list'),
	array('label'=>'Manage Language', 'url'=>array('admin'),'thumb' => '_manage'),
);
?>

<div class="row-fluid">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'language-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class' => 'form-horizontal')
		)); ?>
		<div class="alert alert-info"><?php echo Yii::t('adminModule.language','Los campos con * son necesarios')?></div>

		<?php foreach ($langCollection as $key => $value): ?>
		<div class="control-group">
			<?php echo $form->labelEx($formModel, htmlentities($key), array('class' => 'control-label', 'for' => Helpers::encrypt($key))); ?>

			<div class="controls">
				<?php echo $form->textField($formModel, Helpers::encrypt(CHtml::encode($key)), array('class' => 'span12', 'value' => CHtml::encode($value))); ?>

				<?php if ($formModel->hasErrors($key)): ?>
					<small class="text-error"><?php echo $form->error($formModel, $key); ?></small>
				<?php endif ?>
			</div>

		</div>
		<?php endforeach ?>
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
<?php $this->endWidget() ?>
</div>