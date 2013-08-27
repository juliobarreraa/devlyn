<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $data <?php echo $this->getModelClass(); ?> */
?>
<tr>
	<?php $primaryKey =  null; ?>
	<?php foreach($this->tableSchema->columns as $column): ?>
	<?php if($column->isPrimaryKey): ?>
	<?php $primaryKey = $column->name ?>
	<td><?php echo "<?php echo CHtml::link(CHtml::encode(\$data->{$column->name}), array('view', '{$column->name}' => \$data->{$column->name})); ?>" ?></td>
	<?php else: ?>
	<td class="center"><?php echo "<?php echo CHtml::encode(\$data->{$column->name}); ?>" ?></td>
	<?php endif ?>
	<?php endforeach ?>

	<td class="center">
		<a class="btn btn-success" href="<?php echo "<?php echo CHtml::normalizeUrl(array('/admin/" . strtolower($this->class2name($this->modelClass)) . "/view','id'=>\$data->{$primaryKey})) ?>"?>">
			<i class="halflings-icon zoom-in halflings-icon"></i>                                            
		</a>
		<a class="btn btn-info" href="<?php echo "<?php echo CHtml::normalizeUrl(array('/admin/" . strtolower($this->class2name($this->modelClass)) . "/update','id'=>\$data->{$primaryKey})) ?>"?>">
			<i class="halflings-icon edit halflings-icon"></i>                                            
		</a>
		<a class="btn btn-danger" href="<?php echo "<?php CHtml::normalizeUrl(array('/admin/". strtolower($this->class2name($this->modelClass))."/delete','id'=>\$data->{$primaryKey})) ?>"?>">
			<i class="halflings-icon trash halflings-icon"></i> 
			
		</a>
	</td>
</tr>