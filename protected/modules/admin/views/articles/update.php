<?php
/* @var $this ArticlesController */
/* @var $model ArticlesDynamic */

$this->breadcrumbs=array(
	'Articles Dynamics'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ArticlesDynamic', 'url'=>array('index'), 'thumb' => '_list'),
	array('label'=>'Create ArticlesDynamic', 'url'=>array('create'), 'thumb' => '_create'),
	array('label'=>'View ArticlesDynamic', 'url'=>array('view', 'id'=>$model->id), 'thumb' => '_view'),
	array('label'=>'Manage ArticlesDynamic', 'url'=>array('admin'), 'thumb' => '_manage'),
);
?>
<!--start row-fluid sortable -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span><?php echo Yii::t('adminModule.articles dynamic','Actualizar Articles Dynamic: <b>{{articles dynamic_name}}</b>', array( '{{articles dynamic_name}}' => $model->title )) ?> </h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>

		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div><!--/span-->

</div><!--end row-fluid sortable -->

