<?php
/* @var $this GalleriesController */
/* @var $model GalleriesDynamic */

$this->breadcrumbs=array(
	'Galleries Dynamics'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GalleriesDynamic', 'url'=>array('index'),'thumb' => '_list'),
	array('label'=>'Manage GalleriesDynamic', 'url'=>array('admin'),'thumb' => '_manage'),
);
?>
<!--start row-fluid sortable -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span><?php echo Yii::t('adminModule.galleries dynamic','Crear Nueva Galería') ?>  </h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div><!--/span-->
</div><!--end row-fluid sortable -->