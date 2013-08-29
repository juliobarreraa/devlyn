<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="language" content="en" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php 
	/**
	 * @todo Configuración general, descripción. - https://codebit.springloops.io/project/54009/tasks/t1
	 */
	?>
    <meta name="description" content="">
	<?php 
	/**
	 * @todo Configuración plantilla, descripción. - https://codebit.springloops.io/project/54009/tasks/t2
	 */
	?>
    <meta name="author" content="">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>

    <!-- Le styles -->
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/bootstrap.min.css') ?> 
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/style.css') ?> 

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
      </script>
    <![endif]-->
    <!-- Le fav  -->
    <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl ?>/favicon.ico">
    <?php Yii::app()->getClientScript()->registerScript('loadJquery', <<<EOF
    if (typeof jQuery == 'undefined') {
      document.write(unescape("%3Cscript src='http%3A%2F%2Fcode.jquery.com%2Fjquery-1.10.0.min.js' type='text/javascript'%3E%3C/script%3E"));
    }
EOF
,CClientScript::POS_BEGIN); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

  <!-- activate scrollspy -->
  <body>

      <!-- Navigation -->
      <!-- .inner-page header -->
      <nav class="inner-page" id="header-nav">
        <?php if (!Yii::app()->user->isGuest): ?>
        <ul>
          <li><a href="#" class="active"><?php echo Yii::t('general', 'Home'); ?></a></li>
          <li><a href="#"><?php echo Yii::t('general', 'Instrucciones'); ?></a></li>
          <li><a href="#"><?php echo Yii::t('general', 'Galería'); ?></a></li>
          <li><a href="#"><?php echo Yii::t('general', 'Ingresar respuesta'); ?></a></li>
          <li><a href="<?php echo CHtml::normalizeUrl(array("site/logout")) ?>"><?php echo Yii::t('general', 'Cerrar sesión'); ?></a></li>
        </ul>
        <?php else: ?>
        <?php $form=$this->beginWidget('CActiveForm', array(
          'id'=>'login-form',
          'enableAjaxValidation'=>false,
          'htmlOptions' => array('class' => 'form-inline')
        )); ?>
        <?php echo $form->textField($this->controllerRenderHelper->getLoginForm(), 'username', array('placeholder' => $this->controllerRenderHelper->getLoginForm()->getAttributeLabel('username'), 'size' => '50')) ?>
        <?php echo $form->textField($this->controllerRenderHelper->getLoginForm(), 'password', array('placeholder' => $this->controllerRenderHelper->getLoginForm()->getAttributeLabel('password'))) ?>
        <button class="btn" type="submit">
          <i class="icon-undo bigger-110"></i>
          <?php echo Yii::t('general', 'Identificarse') ?>
        </button>
        <?php $this->endWidget(); ?>
        <?php endif ?>
      </nav>
      <!-- /.inner header -->

      <div class="content-page">
        <?php echo $content ?>
      </div>

      <!-- The footer, social media icons, and copyright -->        
      <footer class="page color-5">
        <div class="inner-page row-fluid footer">
           <div class="logo-dev"></div>
          <div><?php echo Yii::t('general', '{{year}} ÓPTICAS DEVLYN, S.A. DE C.V. // WEBSITE ENGELPLANET //', array('{{year}}' => date('Y'))); ?></div>
        </div>
      </footer>
	</body>
</html>
