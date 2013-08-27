<?php
/* @var $this LanguageController */
/* @var $model Language */

$this->breadcrumbs=array(
	Yii::t('adminModule.language', 'Idiomas')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Language', 'url'=>array('index'), 'thumb' => '_list'),
	array('label'=>'Create Language', 'url'=>array('create'), 'thumb' => '_create'),
	array('label'=>'Update Language', 'url'=>array('update', 'id'=>$model->id), 'thumb' => '_update'),
	array('label'=>'Delete Language', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'thumb' => '_delete'),
	array('label'=>'Manage Language', 'url'=>array('admin'), 'thumb' => '_manage'),
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

<h3 class="header smaller lighter blue"><?php echo Yii::t('adminModule.language', 'Idioma: <b><a href="{{link}}">{{name}}</a></b>', array('{{name}}' => $model->name, '{{link}}'=>CHtml::normalizeUrl(array('language/view','id'=>$model->id)))); ?></h3>

<div class="tabbable tabs-left">
	<ul class="nav nav-tabs" id="myTab3">
		<li class="active">
			<a data-toggle="tab" href="#home3">
				<i class="blue icon-linux bigger-110"></i>
				<?php echo Yii::t('adminModule.language', 'Sistema'); ?>
			</a>
		</li>

		<li>
			<a data-toggle="tab" href="#profile3">
				<i class="blue icon-user bigger-110"></i>
				<?php echo Yii::t('adminModule.language', 'Wargames'); ?>
			</a>
		</li>
	</ul>

	<div class="tab-content">
		<div id="home3" class="tab-pane in active">
			<?php echo $this->renderPartial('partials/system', array('lf' => $lf, 'model' => $model)) ?>
		</div>

		<div id="profile3" class="tab-pane">
			<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
			<p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
		</div>
	</div>
</div>