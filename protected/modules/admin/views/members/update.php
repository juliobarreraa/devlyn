<?php
/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	Yii::t('adminModules.members', 'Usuarios')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('adminModules.members', 'Actualizar'),
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index'), 'thumb' => '_list'),
	array('label'=>'Create Members', 'url'=>array('create'), 'thumb' => '_create'),
	array('label'=>'Update Members', 'url'=>array('update', 'id'=>$model->id), 'thumb' => '_update'),
	array('label'=>'elete Members', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'thumb' => '_delete'),


);
?>

<div class="page-header position-relative">
	<h1>
		Usuarios
		<small>
			<i class="icon-double-angle-right"></i>
			Actualizando <?php echo $model->name ?>
		</small>
	</h1>
</div><!--/.page-header-->

<div class="row-fluid">
	<!--PAGE CONTENT BEGINS HERE-->
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	<!--PAGE CONTENT ENDS HERE-->
</div>