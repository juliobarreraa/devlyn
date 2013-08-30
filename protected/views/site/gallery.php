<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.flexslider-min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/flexslider.css'); ?>
<?php Yii::app()->clientScript->registerScript('load_slider', <<<EOF
  $('#galleries').flexslider({
    animation: "slide"
  });
EOF
, CClientScript::POS_READY); ?>

<div id="galleries" class="flexslider">
	<ul class="slides">
	<?php foreach ($model->galleriesDynamics as $key => $value): ?>
		<li><img src="<?php echo Yii::app()->baseUrl ?>/uploads/resources/<?php echo $value->resource->name ?>" /></li>
	<?php endforeach ?>
	</ul>
</div>