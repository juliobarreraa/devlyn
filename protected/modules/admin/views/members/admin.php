<?php
/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Create Members', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#members-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Members</h1>

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
	'id'=>'members-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'lastname',
		'username',
		'date_birth',
		'nationality',
		/*
		'nationality_other',
		'sex',
		'language',
		'email',
		'pass_hash',
		'pass_salt',
		'tmp_hash',
		'tmp_hash_updated_at',
		'partial',
		'fb_uid',
		'twitter_id',
		'twitter_token',
		'twitter_secret',
		'signature',
		'last_login_time',
		'ip_address',
		'block',
		'enabled',
		'validate',
		'updated_at',
		'created_at',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
