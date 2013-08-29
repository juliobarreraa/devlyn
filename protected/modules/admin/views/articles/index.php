<?php
/* @var $this ArticlesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('adminModule.Articles Dynamic', 'Articles Dynamic'),
);

$this->menu=array(
	array('label'=>'Create ArticlesDynamic', 'url'=>array('create'),'thumb' => '_create'),
	array('label'=>'Manage ArticlesDynamic', 'url'=>array('admin'), 'thumb' => '_manage'),
);
?>

<?php Yii::app()->clientScript->registerScript('table_report', <<<EOF
				var oTable1 = $('#table_report').dataTable( {
				"oLanguage": {
					"sUrl": gcms.baseUrlLanguageTables
				},
				"aoColumns": [
			      { "bSortable": false },
			      null, null,null, null, null,
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
				$('[data-rel=tooltip]').tooltip();
EOF
) ?>

<!-- start row-fluid -->
<div class="row-fluid">
	<!--PAGE CONTENT BEGINS HERE-->
	<div class="row-fluid">
		<div class="span12">
			<h3 class="header smaller lighter blue"><?php echo Yii::t('adminModule.Articles Dynamic', 'Instrucciones para dinámicas') ?></h3>
			<?php echo CHtml::link(Yii::t('articles', 'Crear Instrucciones'), array('articles/create')) ?>
			<table id="table_report" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">
							<label>
								<input type="checkbox" />
								<span class="lbl"></span>
							</label>
						</th>
						<th><?php echo Yii::t('adminModule.Articles Dynamic', 'ID') ?></th>
						<th><?php echo Yii::t('adminModule.Articles Dynamic', 'Dinámica id') ?></th>
						<th><?php echo Yii::t('adminModule.Articles Dynamic', 'Tìtulo') ?></th>
						<th><?php echo Yii::t('adminModule.Articles Dynamic', 'Contenido') ?></th>
						<th><?php echo Yii::t('adminModule.Articles Dynamic', 'Actualizado el') ?></th>
						<th><?php echo Yii::t('adminModule.Articles Dynamic', 'Creado el') ?></th>
																		<th></th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($dataProvider->getData() as $key => $value): ?>					<tr>
						<td class="center">
							<label>
								<input type="checkbox" />
								<span class="lbl"></span>
							</label>
						</td>
						<td>	<?php echo CHtml::link(CHtml::encode($value->id), array('view', 'id'=>$value->id)); ?>
</td>
																								
												<td><?php echo $value->dynamic_id ?></td>
												
												<td><?php echo $value->title ?></td>
												
												<td><?php echo $value->content ?></td>
												
												<td><?php echo $value->updated_at ?></td>
												
												<td><?php echo $value->created_at ?></td>
																		<td class="td-actions">
							<div class="hidden-phone visible-desktop btn-group">
								<a href="#" class="btn btn-mini btn-success">
									<i class="icon-ok bigger-120"></i>
								</a>

								<a href="<?php echo CHtml::normalizeURl(array('update', 'id' => $value->id)) ?>" class="btn btn-mini btn-info">
									<i class="icon-edit bigger-120"></i>
								</a>

								<?php echo CHtml::link('<i class="icon-trash bigger-120"></i>', '#', array("submit"=>array('delete', 'id'=>$value->id), 'confirm' => Yii::t('adminModule.general', '¿Estás seguro?'), 'csrf'=>true, 'class' => 'btn btn-mini btn-danger')) ?>
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
											<a href="<?php echo CHtml::normalizeURl(array('view', 'id' => $value->id)) ?>" class="tooltip-success" data-rel="tooltip" title="Edit" data-placement="left">
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
					<?php endforeach ?>				</tbody>
			</table>
		</div>
	</div>
</div>