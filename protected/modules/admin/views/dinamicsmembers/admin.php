<?php
/* @var $this DinamicsmembersController */
/* @var $model DynamicsMembers */

$this->breadcrumbs=array(
	'Dynamics Members'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DynamicsMembers', 'url'=>array('index')),
	array('label'=>'Create DynamicsMembers', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#dynamics-members-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Dynamics Members</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'dynamics-members-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'member_id',
		'dynamic_id',
		'answer',
		'updated_at',
		'created_at',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
