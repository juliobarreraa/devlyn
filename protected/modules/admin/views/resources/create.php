<?php
/* @var $this ResourcesController */
/* @var $model Resources */

$this->breadcrumbs=array(
	'Resources'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Resources', 'url'=>array('index'),'thumb' => '_list'),

);
?>
<!--start row-fluid sortable -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<?php if (!$this->iframe): ?>
			<h2><i class="halflings-icon edit"></i><span class="break"></span><?php echo Yii::t('adminModule.resources','Crear Nuevo Recurso') ?>  </h2>
			<?php endif ?>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div><!--/span-->
</div><!--end row-fluid sortable -->