<?php
/* @var $this DinamicsmembersController */
/* @var $model DynamicsMembers */

$this->breadcrumbs=array(
	'Dynamics Members'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DynamicsMembers', 'url'=>array('index'), 'thumb' => '_list'),
	array('label'=>'Create DynamicsMembers', 'url'=>array('create'), 'thumb' => '_create'),
	array('label'=>'View DynamicsMembers', 'url'=>array('view', 'id'=>$model->id), 'thumb' => '_view'),
	array('label'=>'Manage DynamicsMembers', 'url'=>array('admin'), 'thumb' => '_manage'),
);
?>
<!--start row-fluid sortable -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span><?php echo Yii::t('adminModule.dynamics members','Actualizar Dynamics Members: <b>{{dynamics members_name}}</b>', array( '{{dynamics members_name}}' => $model->name )) ?> </h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>

		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div><!--/span-->

</div><!--end row-fluid sortable -->

