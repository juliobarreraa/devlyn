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
	\$model->{$nameColumn},
);\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index'), 'thumb' => '_list'),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create'), 'thumb' => '_create'),
	array('label'=>'Update <?php echo $this->modelClass; ?>', 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>), 'thumb' => '_update'),
	array('label'=>'Delete <?php echo $this->modelClass; ?>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Are you sure you want to delete this item?'), 'thumb' => '_delete'),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin'), 'thumb' => '_manage'),
);
?>
<!-- start row-fluid sortable -->
<div class="row-fluid sortable">
	<!-- start box span12 -->
	<div class="box span12">
		<!-- start box-header -->
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon user"></i><span class="break"></span>
				<?php echo "<?php echo Yii::t( 'adminModule.".strtolower($this->class2name($this->modelClass))."', '".$this->class2name($this->modelClass).": <b><a href=\"{{link}}\">{{name}}</a></b>', array( '{{name}}' => \$model->{$nameColumn},'{{link}}'=>
				CHtml::normalizeUrl(array('/admin/".strtolower($this->class2name($this->modelClass))."/view','id'=>\$model->{$this->tableSchema->primaryKey})) ) ) ?>" ?></h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
			</div>
		</div>
		<!-- end box-header -->
		<!-- start box-content -->
		<div class="box-content">
			<div class="row-fluid">
				<div class="span8">
					<?php
					foreach($this->tableSchema->columns as $column): ?>
					<p><b><?php echo "<?php echo \$model->getAttributeLabel('{$column->name}') ?>:</b>" ?> <?php echo "<?php echo \$model->{$column->name} ?>" ?></p>
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<!-- end box-content -->
	</div>
	<!-- end box span12 -->
</div>
<!-- end row-fluid sortable -->
