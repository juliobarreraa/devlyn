<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo Yii::app()->name ?></title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="<?php echo Yii::app()->theme->baseUrl ?>/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo Yii::app()->theme->baseUrl ?>/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles if any-->

		<?php Yii::app()->clientScript->registerCss('wizard', <<<EOF
			#main-content{margin-left:0px !important;}
EOF
) ?>
	</head>
	<body>
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<i class="icon-leaf"></i>
							<?php echo Yii::app()->name ?>
						</small>
					</a><!--/.brand-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>

		<div class="container-fluid" id="main-container">
			<div id="main-content" class="clearfix">
				<div id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="#">Home</a>

							<span class="divider">
								<i class="icon-angle-right"></i>
							</span>
						</li>
						<li class="active">Dashboard</li>
					</ul><!--.breadcrumb-->

					<div id="nav-search">
						<form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="input-small search-query" id="nav-search-input" autocomplete="off" />
								<i class="icon-search" id="nav-search-icon"></i>
							</span>
						</form>
					</div><!--#nav-search-->
				</div>

				<div id="page-content" class="clearfix">
					<div class="page-header position-relative">
						<h1>
							Form Wizard
							<small>
								<i class="icon-double-angle-right"></i>
								and Validation
							</small>
						</h1>
					</div><!--/.page-header-->
					<div class="row-fluid">
						<!--PAGE CONTENT BEGINS HERE-->

						<div class="row-fluid">
							<div class="span12">
								<div class="widget-box">
									<div class="widget-header widget-header-blue widget-header-flat wi1dget-header-large">
										<h4 class="lighter">Global CMS 0.0.4</h4>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div class="row-fluid">
												<div id="fuelux-wizard" class="row-fluid hidden">
													<ul class="wizard-steps">
														<li data-target="#step1" class="active">
															<span class="step">1</span>
															<span class="title">Requerimentos</span>
														</li>

														<li data-target="#step2">
															<span class="step">2</span>
															<span class="title">EULA</span>
														</li>

														<li data-target="#step3">
															<span class="step">3</span>
															<span class="title">Aplicaciones</span>
														</li>

														<li data-target="#step4">
															<span class="step">4</span>
															<span class="title">Licencia</span>
														</li>

														<li data-target="#step5">
															<span class="step">5</span>
															<span class="title">Base de datos</span>
														</li>
														<li data-target="#step6">
															<span class="step">6</span>
															<span class="title">Administrador</span>
														</li>

														<li data-target="#step7">
															<span class="step">7</span>
															<span class="title">Instalación</span>
														</li>

														<li data-target="#step8">
															<span class="step">8</span>
															<span class="title">Finalizado</span>
														</li>
													</ul>
												</div>

												<hr />
												<?php echo $content ?>

												<hr />
												<div class="row-fluid wizard-actions">
													<button class="btn btn-prev">
														<i class="icon-arrow-left"></i>
														Prev
													</button>

													<button class="btn btn-success btn-next" data-last="Finish ">
														Next
														<i class="icon-arrow-right icon-on-right"></i>
													</button>
												</div>
											</div>
										</div><!--/widget-main-->
									</div><!--/widget-body-->
								</div>
							</div>
						</div>

						<!--PAGE CONTENT ENDS HERE-->
					</div><!--/row-->
				</div><!--/#page-content-->

				<div id="ace-settings-container">
					<div class="btn btn-app btn-mini btn-warning" id="ace-settings-btn">
						<i class="icon-cog"></i>
					</div>

					<div id="ace-settings-box">
						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
							<label class="lbl" for="ace-settings-header"> Fixed Header</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>
					</div>
				</div><!--/#ace-settings-container-->
			</div><!--/#main-content-->
		</div><!--/.fluid-container#main-container-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo Yii::app()->baseUrl ?>/js/jquery-1.9.1.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo Yii::app()->baseUrl ?>/js/bootstrap.min.js"></script>
		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="/js/"></script>
		<![endif]-->
		<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/fuelux/fuelux.wizard.min.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/bootbox.min.js"></script>
		<script src="<?php echo Yii::app()->baseUrl ?>/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="<?php echo Yii::app()->baseUrl ?>/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo Yii::app()->baseUrl ?>/js/jquery.slimscroll.min.js"></script>
		<script src="<?php echo Yii::app()->baseUrl ?>/js/jquery.easy-pie-chart.min.js"></script>
		<script src="<?php echo Yii::app()->baseUrl ?>/js/jquery.sparkline.min.js"></script>
		<script src="<?php echo Yii::app()->baseUrl ?>/js/flot/jquery.flot.min.js"></script>
		<script src="<?php echo Yii::app()->baseUrl ?>/js/flot/jquery.flot.pie.min.js"></script>
		<script src="<?php echo Yii::app()->baseUrl ?>/js/flot/jquery.flot.resize.min.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/ace-elements.min.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/ace.min.js"></script>

		<script>
				$('#fuelux-wizard').ace_wizard().on('change' , function(e, info){
					$forms = jQuery(this).parent().find('form');

					$forms.each(function(index, value) {
						jQuery(index).submit();
					});
					/*if(info.step == 1 && $validation) {
						if(!$('#validation-form').valid()) return false;
					}*/
				}).on('finished', function(e) {
					bootbox.dialog("Thank you! Your information was successfully saved!", [{
						"label" : "OK",
						"class" : "btn-small btn-primary",
						}]
					);
				});
		</script>
	</body>
</html>
