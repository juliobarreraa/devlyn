<?php
/* @var $this ArticlesController */
/* @var $model ArticlesDynamic */

$this->breadcrumbs=array(
	'Articles Dynamics'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ArticlesDynamic', 'url'=>array('index'), 'thumb' => '_list'),
	array('label'=>'Create ArticlesDynamic', 'url'=>array('create'), 'thumb' => '_create'),
	array('label'=>'Update ArticlesDynamic', 'url'=>array('update', 'id'=>$model->id), 'thumb' => '_update'),
	array('label'=>'Delete ArticlesDynamic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'thumb' => '_delete'),
	array('label'=>'Manage ArticlesDynamic', 'url'=>array('admin'), 'thumb' => '_manage'),
);
?>
<!-- start row-fluid sortable -->
<div class="row-fluid sortable">
	<!-- start box span12 -->
	<div class="box span12">
		<!-- start box-header -->
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon user"></i><span class="break"></span>
				<?php echo Yii::t( 'adminModule.articles dynamic', 'Articles Dynamic: <b><a href="{{link}}">{{name}}</a></b>', array( '{{name}}' => $model->title,'{{link}}'=>
				CHtml::normalizeUrl(array('/admin/articles dynamic/view','id'=>$model->id)) ) ) ?></h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
			</div>
		</div>
		<!-- end box-header -->
		<!-- start box-content -->
		<div class="box-content">
			<div class="row-fluid">
				<div class="span8">
										<p><b><?php echo $model->getAttributeLabel('id') ?>:</b> <?php echo $model->id ?></p>
										<p><b><?php echo $model->getAttributeLabel('dynamic_id') ?>:</b> <?php echo $model->dynamic_id ?></p>
										<p><b><?php echo $model->getAttributeLabel('title') ?>:</b> <?php echo $model->title ?></p>
										<p><b><?php echo $model->getAttributeLabel('content') ?>:</b> <?php echo $model->content ?></p>
										<p><b><?php echo $model->getAttributeLabel('updated_at') ?>:</b> <?php echo $model->updated_at ?></p>
										<p><b><?php echo $model->getAttributeLabel('created_at') ?>:</b> <?php echo $model->created_at ?></p>
									</div>
			</div>
		</div>
		<!-- end box-content -->
	</div>
	<!-- end box span12 -->
</div>
<!-- end row-fluid sortable -->
