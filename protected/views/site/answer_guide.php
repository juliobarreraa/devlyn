<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.flexslider-min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/flexslider.css'); ?>
<?php Yii::app()->clientScript->registerScript('load_slider', <<<EOF
  $('#guide').flexslider({
    animation: "slide"
  });
EOF
, CClientScript::POS_READY); ?>

<div id="guide" class="flexslider">
	<ul class="slides">
	<?php foreach ($model->articlesDynamics as $key => $value): ?>
		<li><?php echo $value->content ?></li>
	<?php endforeach ?>
	</ul>
</div>