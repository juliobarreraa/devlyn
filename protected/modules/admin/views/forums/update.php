<?php
/* @var $this ForumsController */
/* @var $model Forums */

$this->breadcrumbs=array(
	Yii::t('adminModule.Forums', 'Foros') => array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('adminModule.Forums', 'Actualizar')
);

$this->menu=array(
	array('label'=>'List Forums', 'url'=>array('index'), 'thumb' => '_list'),
	array('label'=>'Create Forums', 'url'=>array('create'), 'thumb' => '_create'),
	array('label'=>'View Forums', 'url'=>array('view', 'id'=>$model->id), 'thumb' => '_view'),
	array('label'=>'Manage Forums', 'url'=>array('admin'), 'thumb' => '_manage'),
);
?>
<!--start row-fluid sortable -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span><?php echo Yii::t('adminModule.forums','Actualizar Forums: <b>{{forums_name}}</b>', array( '{{forums_name}}' => $model->name )) ?> </h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>

		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div><!--/span-->

</div><!--end row-fluid sortable -->

