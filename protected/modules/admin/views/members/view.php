<?php
/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	Yii::t('adminModule.members', 'Usuarios')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Create Members', 'url'=>array('create')),
	array('label'=>'Update Members', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Members', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Members', 'url'=>array('admin')),
);
?>

<!-- widget-box transparent -->
<div class="widget-box transparent">
	<!-- widget-header -->
	<div class="widget-header">
		<h2 class="lighter smaller"><?php echo Yii::t('adminModule.members', '<i class="icon-male"></i> Perfil <small><i class="icon-double-angle-right"></i> {{username}}</small>', array('{{username}}' => $model->username)) ?></h2>
		<div class="widget-toolbar no-border">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#member-tab" data-toggle="tab"><?php echo Yii::t('adminModule.members', 'Mi Perfil'); ?></a></li>
				<li><a href="#wargame-tab" data-toggle="tab"><?php echo Yii::t('adminModule.members', 'Wargames'); ?></a></li>
			</ul>
		</div>
	</div>
	<!-- /widget-header -->
	<!-- widget-body -->
	<div class="widget-body">
		<!-- widget-main padding-4 -->
		<div class="widget-main padding-4">
			<!-- tab-content padding-8 -->
			<div class="tab-content padding-8">
				<!-- #member-tab -->
				<div id="member-tab" class="tab-pane active">
					<?php echo $this->renderPartial('partials/profile', array('model' => $model)) ?>
				</div>
				<div id="wargame-tab">
				</div>
				<!-- /#member-tab -->
			</div>
			<!-- /tab-content padding-8 -->
		</div>
		<!-- /widget-main padding-4 -->
	</div>
	<!-- /widget-body -->
</div>
<!-- /widget-box transparent -->