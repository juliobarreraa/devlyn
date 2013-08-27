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
    <?php Yii::app()->getClientScript()->registerScript('scrollbar', <<<EOF
      $.history.listen()
        $('#nav .nav .scroll').click(function() {
      	$.history.push('<?php echo CHtml::normalizeUrl(array('/')) ?>' + $(this).attr('href')); 
      });
EOF
); ?>
    <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/main.min.js', CClientScript::POS_END) ?>

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

  <!-- activate scrollspy -->
  <body id="top" data-spy="scroll" data-target=".navbar" data-offset="50">

       <!-- Nav button -->
      <a id="toggle"  class="closed">
        <i class="icon-reorder"></i>
      </a>

      <!-- Navigation -->
      <header class="navbar navbar-fixed-top">
        <div class="inner-page">
          <h1 class="logo"><?php echo Yii::app()->name ?></h1>
            <div id="nav">
              <ul class="nav">
                <li class="active"><a title="Home page" class="scroll brand-1" href="<?php echo CHtml::normalizeUrl(array('/')) ?>#home">Home</a></li>
                <li><a title="Check out our awesome services" href="<?php echo CHtml::normalizeUrl(array('/')) ?>#features" class=" scroll brand-4">Features</a></li>
                <li><a title="Themes assets" href="<?php echo CHtml::normalizeUrl(array('/')) ?>#assets" class="scroll brand-3">Assets</a></li>
                <li><a title="Who we are" href="<?php echo CHtml::normalizeUrl(array('/')) ?>#about" class="scroll fadeto brand-4"> About us</a></li>
                <li><a title="Get in touch!" href="<?php echo CHtml::normalizeUrl(array('/')) ?>#contact" class="scroll brand-2">Contact</a></li>
                <li><a title="External page sample" href="sample-page.html" class=" brand-4">Sample Page</a></li>
              </ul>
            </div>
        </div> 
      </header>

      <?php echo $content ?>

      <!-- The footer, social media icons, and copyright -->        
      <footer class="page color-5">
        <div class="inner-page row-fluid">
          <div class="span6 social">
            <a href="index.html#contact"><i class="icon-twitter"></i></a>
            <a href="index.html#contact"><i class="icon-github-sign"></i></a>    
            <a href="index.html#contact"><i class="icon-facebook-sign"></i></a>
            <a href="index.html#contact"><i class="icon-google-plus-sign"></i></a>
          </div>
          <div class="span6 text-right copyright">
            &copy; 2013 <a  href="../../../index.html"  title="twitter bootstrap themes">prettystrap.com</a> | all rights reserved |  <a href="index.html#top"   title="Got to top" class="scroll">To top <i class="icon-caret-up"></i></a>
          </div>
        </div>
      </footer>
	</body>
</html>
