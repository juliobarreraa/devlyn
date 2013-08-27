			<table id="table_report" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">
							<label>
								<input type="checkbox" />
								<span class="lbl"></span>
							</label>
						</th>
						<th><?php echo Yii::t('adminModule.Forums', 'Paquete') ?></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php /** @type Directory $value */ ?>
					<?php foreach ($lf as $key => $value): ?>
					<tr>
						<td class="center">
							<label>
								<input type="checkbox" />
								<span class="lbl"></span>
							</label>
						</td>
						<td><?php echo CHtml::link(CHtml::encode(Helpers::toString($value->name)), array('read', 'id' => $model->id, 'name'=>$value->name)); ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td class="td-actions">
							<div class="hidden-phone visible-desktop btn-group">
								<a href="#" class="btn btn-mini btn-success">
									<i class="icon-ok bigger-120"></i>
								</a>

								<a href="<?php echo CHtml::normalizeURl(array('update', 'name' => $value->name)) ?>" class="btn btn-mini btn-info">
									<i class="icon-edit bigger-120"></i>
								</a>

								<?php echo CHtml::link('<i class="icon-trash bigger-120"></i>', '#', array("submit"=>array('delete', 'name'=>$value->name), 'confirm' => Yii::t('adminModule.general', '¿Estás seguro?'), 'csrf'=>true, 'class' => 'btn btn-mini btn-danger')) ?>
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
											<a href="<?php echo CHtml::normalizeURl(array('view', 'name' => $value->name)) ?>" class="tooltip-success" data-rel="tooltip" title="Edit" data-placement="left">
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
					<?php endforeach ?>		
				</tbody>
			</table>