<?php
/* @var $this ForumsController */
/* @var $data Forums */
?>
<tr>
					<td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>
				<td class="center"><?php echo CHtml::encode($data->last_poster_id); ?></td>
				<td class="center"><?php echo CHtml::encode($data->name); ?></td>
				<td class="center"><?php echo CHtml::encode($data->description); ?></td>
				<td class="center"><?php echo CHtml::encode($data->position); ?></td>
				<td class="center"><?php echo CHtml::encode($data->password); ?></td>
				<td class="center"><?php echo CHtml::encode($data->last_topic_id); ?></td>
				<td class="center"><?php echo CHtml::encode($data->show_rules); ?></td>
				<td class="center"><?php echo CHtml::encode($data->parent_id); ?></td>
				<td class="center"><?php echo CHtml::encode($data->rules_title); ?></td>
				<td class="center"><?php echo CHtml::encode($data->rules_text); ?></td>
				<td class="center"><?php echo CHtml::encode($data->enabled); ?></td>
				<td class="center"><?php echo CHtml::encode($data->updated_at); ?></td>
				<td class="center"><?php echo CHtml::encode($data->created_at); ?></td>
		
	<td class="center">
		<a class="btn btn-success" href="<?php echo CHtml::normalizeUrl(array('/admin/forums/view','id'=>$data->id)) ?>">
			<i class="halflings-icon zoom-in halflings-icon"></i>                                            
		</a>
		<a class="btn btn-info" href="<?php echo CHtml::normalizeUrl(array('/admin/forums/update','id'=>$data->id)) ?>">
			<i class="halflings-icon edit halflings-icon"></i>                                            
		</a>
		<a class="btn btn-danger" href="<?php CHtml::normalizeUrl(array('/admin/forums/delete','id'=>$data->id)) ?>">
			<i class="halflings-icon trash halflings-icon"></i> 
			
		</a>
	</td>
</tr>