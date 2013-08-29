<?php
/* @var $this DynamicsController */
/* @var $model Dynamics */

$this->breadcrumbs=array(
	Yii::t('dynamics', 'Dinámicas')=>array('index'),
	Yii::t('dynamics', 'Crear dinámica'),
);

$this->menu=array(
	array('label'=>Yii::t('dyna', 'Listado de dinámicas'), 'url'=>array('index'),'thumb' => '_list'),
);
?>
<!--start row-fluid sortable -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span><?php echo Yii::t('adminModule.dynamics','Crear nueva dinámica') ?>  </h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div><!--/span-->
</div><!--end row-fluid sortable -->