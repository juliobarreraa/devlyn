<?php
/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	Yii::t('adminModules.members', 'Usuarios')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('adminModules.members', 'Actualizar'),
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Create Members', 'url'=>array('create')),
	array('label'=>'View Members', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Members', 'url'=>array('admin')),
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