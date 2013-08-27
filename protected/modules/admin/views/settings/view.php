<?php
/* @var $this SettingsController */
/* @var $model SettingsApp */

$this->breadcrumbs=array(
	Yii::t('adminModule.settings', 'Panel de Configuración')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SettingsApp', 'url'=>array('index'), 'thumb' => '_list'),
	array('label'=>'Create SettingsApp', 'url'=>array('create'), 'thumb' => '_create'),
	array('label'=>'Update SettingsApp', 'url'=>array('update', 'id'=>$model->id), 'thumb' => '_update'),
	array('label'=>'Delete SettingsApp', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'thumb' => '_delete'),
	array('label'=>'Manage SettingsApp', 'url'=>array('admin'), 'thumb' => '_manage'),
);
?>
<!-- start row-fluid sortable -->
<div class="row-fluid sortable">
	<!-- start box span12 -->
	<div class="box span12">
		<h3 class="header smaller lighter blue"><?php echo Yii::t('adminModule.settings', 'Configuración para la aplicación: <b>{{application}}</b>', array('{{application}}' => $model->name)) ?></h3>
		<!-- start box-header -->
		<div class="box-header" data-original-title>
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
					<p><b><?php echo $model->getAttributeLabel('member_id') ?>:</b> <?php echo $model->member_id ?></p>
					<p><b><?php echo $model->getAttributeLabel('name') ?>:</b> <?php echo $model->name ?></p>
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
