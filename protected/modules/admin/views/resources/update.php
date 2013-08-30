<?php
/* @var $this ResourcesController */
/* @var $model Resources */

$this->breadcrumbs=array(
	'Resources'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Resources', 'url'=>array('index'), 'thumb' => '_list'),
	array('label'=>'Create Resources', 'url'=>array('create'), 'thumb' => '_create'),
	array('label'=>'View Resources', 'url'=>array('view', 'id'=>$model->id), 'thumb' => '_view'),
);
?>
<!--start row-fluid sortable -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span><?php echo Yii::t('adminModule.resources','Actualizar Resources: <b>{{resources_name}}</b>', array( '{{resources_name}}' => $model->name )) ?> </h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>

		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div><!--/span-->

</div><!--end row-fluid sortable -->

