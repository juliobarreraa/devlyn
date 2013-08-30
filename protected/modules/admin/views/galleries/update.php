<?php
/* @var $this GalleriesController */
/* @var $model GalleriesDynamic */

$this->breadcrumbs=array(
	'Galleries Dynamics'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GalleriesDynamic', 'url'=>array('index'), 'thumb' => '_list'),
	array('label'=>'Create GalleriesDynamic', 'url'=>array('create'), 'thumb' => '_create'),
	array('label'=>'View GalleriesDynamic', 'url'=>array('view', 'id'=>$model->id), 'thumb' => '_view'),
);
?>
<!--start row-fluid sortable -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span><?php echo Yii::t('adminModule.galleries dynamic','Actualizar Galleries Dynamic: <b>{{galleries dynamic_name}}</b>', array( '{{galleries dynamic_name}}' => $model->name )) ?> </h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>

		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div><!--/span-->

</div><!--end row-fluid sortable -->

