<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $dataProvider CActiveDataProvider */

<?php
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	Yii::t('adminModule." . $this->class2name($this->modelClass) . "', '" . $this->class2name($this->modelClass) . "'),
);\n";
?>

$this->menu=array(
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create'),'thumb' => '_create'),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin'), 'thumb' => '_manage'),
);
?>

<?php echo <<<EOD
<?php Yii::app()->clientScript->registerScript('table_report', <<<EOF
				var oTable1 = \$('#table_report').dataTable( {
				"oLanguage": {
					"sUrl": gcms.baseUrlLanguageTables
				},
				"aoColumns": [
			      { "bSortable": false },
			      null, null,null, null, null,
				  { "bSortable": false }
				] } );
				
				
				\$('table th input:checkbox').on('click' , function(){
					var that = this;
					\$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						\$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
				\$('[data-rel=tooltip]').tooltip();
EOF
) ?>
EOD;

?>


<!-- start row-fluid -->
<div class="row-fluid">
	<!--PAGE CONTENT BEGINS HERE-->
	<div class="row-fluid">
		<div class="span12">
			<h3 class="header smaller lighter blue"><?php echo "<?php echo Yii::t('adminModule." . $this->class2name($this->modelClass) . "', '" . $this->class2name($this->modelClass) . "') ?>" ?></h3>
			<table id="table_report" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">
							<label>
								<input type="checkbox" />
								<span class="lbl"></span>
							</label>
						</th>
						<?php $count=0; ?>
						<?php foreach($this->tableSchema->columns as $column): ?>
						<?php if(++$count==6)
							echo "\t<?php /*\n"; ?>
						<th><?php echo "<?php echo Yii::t('adminModule." . $this->class2name($this->modelClass) . "', '{$column->name}') ?>" ?></th>
						<?php endforeach ?>
						<?php if($count>=7)
							echo "\t*/ ?>\n"; ?>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php echo "<?php foreach (\$dataProvider->getData() as \$key => \$value): ?>" ?>
					<tr>
						<td class="center">
							<label>
								<input type="checkbox" />
								<span class="lbl"></span>
							</label>
						</td>
						<td><?php echo "\t<?php echo CHtml::link(CHtml::encode(\$value->{$this->tableSchema->primaryKey}), array('view', 'id'=>\$value->{$this->tableSchema->primaryKey})); ?>\n"; ?></td>
						<?php $count=0; ?>
						<?php foreach($this->tableSchema->columns as $column): ?>
						<?php if($column->isPrimaryKey)
							continue; ?>

						<?php if(++$count==7)
							echo "\t<?php /*\n"; ?>
						<td><?php echo "<?php echo \$value->{$column->name} ?>" ?></td>
						<?php endforeach ?>
						<?php if($count>=6)
							echo "\t*/ ?>\n"; ?>
						<td class="td-actions">
							<div class="hidden-phone visible-desktop btn-group">
								<a href="#" class="btn btn-mini btn-success">
									<i class="icon-ok bigger-120"></i>
								</a>

								<a href="<?php echo "<?php echo CHtml::normalizeURl(array('update', 'id' => \$value->id)) ?>" ?>" class="btn btn-mini btn-info">
									<i class="icon-edit bigger-120"></i>
								</a>

								<?php echo "<?php echo CHtml::link('<i class=\"icon-trash bigger-120\"></i>', '#', array(\"submit\"=>array('delete', 'id'=>\$value->id), 'confirm' => Yii::t('adminModule.general', '¿Estás seguro?'), 'csrf'=>true, 'class' => 'btn btn-mini btn-danger')) ?>" ?>

								<a class="btn btn-mini btn-warning">
									<i class="icon-flag bigger-120"></i>
								</a>
							</div>

							<div class="hidden-desktop visible-phone">
								<div class="inline position-relative">
									<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
										<i class="icon-caret-down icon-only bigger-120"></i>
									</button>

									<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
										<li>
											<a href="<?php echo "<?php echo CHtml::normalizeURl(array('view', 'id' => \$value->id)) ?>" ?>" class="tooltip-success" data-rel="tooltip" title="Edit" data-placement="left">
												<span class="green">
													<i class="icon-edit"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="tooltip-warning" data-rel="tooltip" title="Flag" data-placement="left">
												<span class="blue">
													<i class="icon-flag"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete" data-placement="left">
												<span class="red">
													<i class="icon-trash"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
					<?php echo "<?php endforeach ?>" ?>
				</tbody>
			</table>
		</div>
	</div>
</div>