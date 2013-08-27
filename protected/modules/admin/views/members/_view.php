<?php
/* @var $this MembersController */
/* @var $data Members */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastname')); ?>:</b>
	<?php echo CHtml::encode($data->lastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_birth')); ?>:</b>
	<?php echo CHtml::encode($data->date_birth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nationality')); ?>:</b>
	<?php echo CHtml::encode($data->nationality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nationality_other')); ?>:</b>
	<?php echo CHtml::encode($data->nationality_other); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode($data->sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pass_hash')); ?>:</b>
	<?php echo CHtml::encode($data->pass_hash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pass_salt')); ?>:</b>
	<?php echo CHtml::encode($data->pass_salt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tmp_hash')); ?>:</b>
	<?php echo CHtml::encode($data->tmp_hash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tmp_hash_updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->tmp_hash_updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partial')); ?>:</b>
	<?php echo CHtml::encode($data->partial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fb_uid')); ?>:</b>
	<?php echo CHtml::encode($data->fb_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('twitter_id')); ?>:</b>
	<?php echo CHtml::encode($data->twitter_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('twitter_token')); ?>:</b>
	<?php echo CHtml::encode($data->twitter_token); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('twitter_secret')); ?>:</b>
	<?php echo CHtml::encode($data->twitter_secret); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signature')); ?>:</b>
	<?php echo CHtml::encode($data->signature); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login_time')); ?>:</b>
	<?php echo CHtml::encode($data->last_login_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip_address')); ?>:</b>
	<?php echo CHtml::encode($data->ip_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('block')); ?>:</b>
	<?php echo CHtml::encode($data->block); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enabled')); ?>:</b>
	<?php echo CHtml::encode($data->enabled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validate')); ?>:</b>
	<?php echo CHtml::encode($data->validate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	*/ ?>

</div>