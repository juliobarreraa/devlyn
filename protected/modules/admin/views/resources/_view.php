<?php
/* @var $this ResourcesController */
/* @var $data Resources */
?>
<tr>
					<td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>
				<td class="center"><?php echo CHtml::encode($data->name); ?></td>
				<td class="center"><?php echo CHtml::encode($data->updated_at); ?></td>
				<td class="center"><?php echo CHtml::encode($data->created_at); ?></td>
		
	<td class="center">
		<a class="btn btn-success" href="<?php echo CHtml::normalizeUrl(array('/admin/resources/view','id'=>$data->id)) ?>">
			<i class="halflings-icon zoom-in halflings-icon"></i>                                            
		</a>
		<a class="btn btn-info" href="<?php echo CHtml::normalizeUrl(array('/admin/resources/update','id'=>$data->id)) ?>">
			<i class="halflings-icon edit halflings-icon"></i>                                            
		</a>
		<a class="btn btn-danger" href="<?php CHtml::normalizeUrl(array('/admin/resources/delete','id'=>$data->id)) ?>">
			<i class="halflings-icon trash halflings-icon"></i> 
			
		</a>
	</td>
</tr>