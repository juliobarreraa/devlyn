<?php
/* @var $this MembersController */
/* @var $model Members */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'members-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class' => 'form-horizontal')
)); ?>

	<div class="alert alert-info">Fields with <span class="required">*</span> are required.</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'name', array('class' => 'control-label')); ?>

		<div class="controls">
			<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
			<?php if ($model->hasErrors('name')): ?>
				<small class="text-error"><?php echo $model->getError('name'); ?></small>
			<?php endif ?>
		</div>

	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'username', array('class' => 'control-label')); ?>

		<div class="controls">
			<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
			<?php if ($model->hasErrors('username')): ?>
				<small class="text-error"><?php echo $model->getError('username'); ?></small>
			<?php endif ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'email', array('class' => 'control-label')); ?>

		<div class="controls">
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
			<?php if ($model->hasErrors('email')): ?>
				<small class="text-error"><?php echo $model->getError('email'); ?></small>
			<?php endif ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model->getMemberProfile(),'department', array('class' => 'control-label')); ?>

		<div class="controls">
			<?php echo $form->textField($model->getMemberProfile(),'department',array('size'=>60,'maxlength'=>100)); ?>
			<?php if ($model->getMemberProfile()->hasErrors('department')): ?>
				<small class="text-error"><?php echo $model->getMemberProfile()->getError('department'); ?></small>
			<?php endif ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model->getMemberProfile(),'region', array('class' => 'control-label')); ?>

		<div class="controls">
			<?php echo $form->textField($model->getMemberProfile(),'region',array('size'=>60,'maxlength'=>100)); ?>
			<?php if ($model->getMemberProfile()->hasErrors('region')): ?>
				<small class="text-error"><?php echo $model->getMemberProfile()->getError('region'); ?></small>
			<?php endif ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model->getMemberProfile(),'team', array('class' => 'control-label')); ?>

		<div class="controls">
			<?php echo $form->textField($model->getMemberProfile(),'team',array('size'=>60,'maxlength'=>100)); ?>
			<?php if ($model->getMemberProfile()->hasErrors('team')): ?>
				<small class="text-error"><?php echo $model->getMemberProfile()->getError('team'); ?></small>
			<?php endif ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model->getMemberProfile(),'leader', array('class' => 'control-label')); ?>

		<div class="controls">
			<?php echo $form->textField($model->getMemberProfile(),'leader',array('size'=>60,'maxlength'=>100)); ?>
			<?php if ($model->getMemberProfile()->hasErrors('leader')): ?>
				<small class="text-error"><?php echo $model->getMemberProfile()->getError('leader'); ?></small>
			<?php endif ?>
		</div>
	</div>
<!-- 
	<div class="control-group">
		<?php $this->widget('ext.wysiwyg.wysiwyg', array('title' => $model->getAttributeLabel('signature'), 'textarea' => $form->textarea($model,'signature', array('class' => 'span12', 'data-provide' => 'markdown', 'rows' => 3)))); ?>
		<?php if ($model->hasErrors('signature')): ?>
			<small class="text-error"><?php echo $model->getError('signature'); ?></small>
		<?php endif ?>
	</div> -->
	<div class="form-actions">
		<button class="btn btn-info" type="submit">
			<i class="icon-ok bigger-110"></i>
			<?php echo $model->isNewRecord ? 'Crear' : 'Guardar' ?>
		</button>

		&nbsp; &nbsp; &nbsp;
		<button class="btn" type="reset">
			<i class="icon-undo bigger-110"></i>
			Reiniciar
		</button>
	</div>

<?php $this->endWidget(); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/markdown/markdown.min.js', CClientScript::POS_END) ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/markdown/bootstrap-markdown.min.js', CClientScript::POS_END) ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.hotkeys.min.js', CClientScript::POS_END) ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-wysiwyg.min.js', CClientScript::POS_END) ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootbox.min.js', CClientScript::POS_END) ?>

<?php Yii::app()->getClientScript()->registerScript('widget_wysiwyg', <<<EOF
    function initToolbarBootstrapBindings() {
      var fonts = ['Arial', 'Courier', 'Comic Sans MS', 'Helvetica', 'Open Sans', 'Tahoma', 'Verdana'],
            fontTarget = \$('[title=Font]').siblings('.dropdown-menu');
      \$.each(fonts, function (idx, fontName) {
          fontTarget.append(\$('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
      });
      \$('a[title]').tooltip({container:'body',animation:false});
    	\$('.dropdown-menu input').click(function() {return false;})
		    .change(function () {\$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';\$(this).change();});


      \$('.wysiwyg-toolbar input[type=file]').prev().on('click', function () { 
        \$(this).next().click();//the image icon
      });

	  \$('#colorpicker').ace_colorpicker({pull_right:true,caret:false}).change(function(){
		\$(this).nextAll('input').eq(0).val(this.value).change();
	  }).next().tooltip({title: \$('#colorpicker').attr('title'), container:'body',animation:false}).next().hide();
	};
	function showErrorAlert (reason, detail) {
		var msg='';
		if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
		else {
			console.log("error uploading file", reason, detail);
		}
		\$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
		 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	};
    initToolbarBootstrapBindings(); 
EOF
) ?>