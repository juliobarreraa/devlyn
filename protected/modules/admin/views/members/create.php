<?php
/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index'), 'thumb' => '_list'),
);
?>

<h1>Create Members</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>