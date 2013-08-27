<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>
<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
		'id'=>'".$this->class2id($this->modelClass)."-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class' => 'form-horizontal')
		)); ?>\n"; ?>
	<div class="alert alert-info"><?php echo "<?php echo Yii::t('adminModule.".strtolower($this->class2name($this->modelClass))."','Los campos con * son necesarios')?>" ?></div>
	<?php if( $this->hasErrors() ):?><div class="alert alert-error">
	<?php echo "<?php Yii::t('adminModule.".strtolower($this->class2name($this->modelClass))."','Rellene los campos para continuar') ?> "?></div><?php endif ?>
		<?php 
		foreach($this->tableSchema->columns as $column) : ?>
		<div class="control-group">
			<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>

			<div class="controls">
				<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>

				<?php echo "<?php if (\$model->hasErrors('{$column->name}')): ?>" ?>
					<small class="text-error"><?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?></small>
				<?php echo "<?php endif ?>" ?>
			</div>

		</div>
		<?php endforeach ?>


		<div class="form-actions">
			<button class="btn btn-info" type="submit">
				<i class="icon-ok bigger-110"></i>
				<?php echo "<?php echo \$model->isNewRecord ? Yii::t('forms', 'Crear') : Yii::t('forms', 'Guardar') ?>" ?>
			</button>

			&nbsp; &nbsp; &nbsp;
			<button class="btn" type="reset">
				<i class="icon-undo bigger-110"></i>
				<?php echo "<?php echo Yii::t('forms', 'Reiniciar') ?>"  ?>
			</button>
		</div>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
