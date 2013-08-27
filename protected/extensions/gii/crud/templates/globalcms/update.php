<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Update',
);\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index'), 'thumb' => '_list'),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create'), 'thumb' => '_create'),
	array('label'=>'View <?php echo $this->modelClass; ?>', 'url'=>array('view', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>), 'thumb' => '_view'),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin'), 'thumb' => '_manage'),
);
?>
<!--start row-fluid sortable -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span><?php echo "<?php echo Yii::t('adminModule.".strtolower($this->class2name($this->modelClass))."','Actualizar ".$this->class2name($this->modelClass).": <b>{{".strtolower($this->class2name($this->modelClass))."_name}}</b>', array( '{{".strtolower($this->class2name($this->modelClass))."_name}}' => \$model->name )) ?>" ?> </h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>

		<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
	</div><!--/span-->

</div><!--end row-fluid sortable -->

<?php /*
<h1>Update <?php echo $this->modelClass." <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

*/ ?>
