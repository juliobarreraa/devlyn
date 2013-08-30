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

		<link rel="stylesheet" async href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/ace-ie.min.css" />
		<![endif]-->
        <?php Yii::app()->clientScript->scriptMap=array(
                'jquery.js'=>false,
                'jquery.min.js'=>false,
                'jquery.yii.js' => false,
        );?>
		<!--inline styles if any-->
		<?php Yii::app()->clientScript->registerScript('var_init', "
			var gcms = {
				baseUrl: '" . Yii::app()->baseUrl . "/',
				controller: '" . Yii::app()->controller->getId() . "',
				action: '" . Yii::app()->controller->action->getId() . "',
				baseUrlLanguageTables: '" . Yii::app()->theme->baseUrl . "/js/language/es_ES.txt'
			};
", CClientScript::POS_BEGIN) ?>

		<?php Yii::app()->clientScript->registerScriptFile('//underscorejs.org/underscore-min.js', CClientScript::POS_END); ?>

	</head>
	<body>
		<?php Yii::app()->clientScript->registerScript('load_language_strings', '
			gcms.lang = {
				socket_not_defined: "' . Yii::t('adminModule.jscript', 'No se puede conectar con el servidor nodejs') . '",
				new_message_count: "' . Yii::t('adminModule.jscript', '{{count}} mensajes') . '",
			};
		', CClientScript::POS_BEGIN); ?>

		<?php if (!$this->iframe): ?>
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<i class="icon-leaf"></i>
							<?php echo Yii::app()->name ?>
						</small>
					</a><!--/.brand-->

					<?php if (Yii::app()->user->checkAccess('usersEdit')): ?>
					<ul class="nav ace-nav pull-right">
						<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-tasks"></i>
								<span class="badge badge-grey">1</span>
							</a>

							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
								<li class="nav-header">
									<i class="icon-ok"></i>
									1 Tarea por completar
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">Software Update</span>
											<span class="pull-right">65%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:65%" class="bar"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										See tasks with details
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-bell-alt icon-only icon-animated-bell"></i>
								<span class="badge badge-important">1</span>
							</a>

							<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-closer">
								<li class="nav-header">
									<i class="icon-warning-sign"></i>
									1 notificación
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-mini no-hover btn-pink icon-comment"></i>
												New Comments
											</span>
											<span class="pull-right badge badge-info">+12</span>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										See all notifications
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="green" id="message-list-badge">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-envelope-alt icon-only icon-animated-vertical"></i>
								<span class="badge badge-success"></span>
							</a>

							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
								<li class="nav-header">
									<i class="icon-envelope"></i>
									<?php echo Yii::t('adminModule.general', '0 mensajes'); ?>
								</li>
								<li>
									<a href="<?php echo CHtml::normalizeUrl(array('default/chat')) ?>">
										<?php echo Yii::t('adminModule.general', 'Ver todos los mensajes'); ?>
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="light-blue user-profile">
							<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo Yii::app()->baseUrl ?>/uploads/avatars/user.jpg" alt="Jason's Photo" />
								<span id="user_info">
									<small><?php echo Yii::t('adminModule.general', 'Bienvenido'); ?></small>
									<?php echo Yii::app()->user->name ?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">
								<li>
									<a href="#">
										<i class="icon-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="<?php echo CHtml::normalizeUrl(array('members/view', 'id' => Yii::app()->user->id)); ?>">
										<i class="icon-user"></i>
										<?php echo Yii::t('adminModule.general', 'Mi perfil') ?>
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php echo CHtml::normalizeUrl(array('default/logout')) ?>">
										<i class="icon-off"></i>
										<?php echo Yii::t('adminModule.general', 'Salir'); ?>
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
					<?php endif ?>
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>
		<?php endif ?>

		<div class="container-fluid" id="main-container">
			<?php if (!$this->iframe): ?>
			<a id="menu-toggler" href="#">
				<span></span>
			</a>
			<?php endif ?>

			<?php if (!$this->iframe): ?>
			<div id="sidebar">
				<div id="sidebar-shortcuts">
					<div id="sidebar-shortcuts-large">
						<button class="btn btn-small btn-success">
							<i class="icon-signal"></i>
						</button>

						<button class="btn btn-small btn-info">
							<i class="icon-pencil"></i>
						</button>

						<a href="<?php echo CHtml::normalizeUrl(array('/admin/members/index')) ?>" class="btn btn-small btn-warning">
							<i class="icon-group"></i>
						</a>

						<a href="<?php echo CHtml::normalizeUrl(array('settings/index')) ?>" class="btn btn-small btn-danger">
							<i class="icon-cogs"></i>
						</a>
					</div>

					<div id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!--#sidebar-shortcuts-->

				
				<ul class="nav nav-list">
					<li>
						<a href="<?php echo CHtml::normalizeUrl(array('default/index')) ?>">
							<i class="icon-dashboard"></i>
							<span><?php echo Yii::t('adminModule.general', 'Escritorio'); ?></span>
						</a>
					</li>

					<li>
						<a href="<?php echo CHtml::normalizeUrl(array('dynamics/index')) ?>">
							<i class="icon-laptop"></i>
							<span><?php echo Yii::t('adminModule.general', 'Dinámicas'); ?></span>
						</a>
					</li>

					<li>
						<a href="<?php echo CHtml::normalizeUrl(array('language/index')) ?>">
							<i class="icon-cny"></i>
							<span><?php echo Yii::t('adminModule.general', 'Idiomas'); ?></span>
						</a>
					</li>

					<!--<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-desktop"></i>
							<span>UI Elements</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="elements.html">
									<i class="icon-double-angle-right"></i>
									Elements
								</a>
							</li>

							<li>
								<a href="buttons.html">
									<i class="icon-double-angle-right"></i>
									Buttons &amp; Icons
								</a>
							</li>

							<li>
								<a href="treeview.html">
									<i class="icon-double-angle-right"></i>
									Treeview
								</a>
							</li>
						</ul>
					</li>-->

				</ul><!--/.nav-list-->

				<div id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>
			<?php endif ?>

			<div id="main-content" class="clearfix" style="<?php if ($this->iframe): ?>margin-left: 0px;<?php endif ?>">
				<?php if (!$this->iframe): ?>
				<div id="breadcrumbs">
					<?php if(isset($this->breadcrumbs)):?>
						<?php $this->widget('GCBreadcrumbs', array(
							'homeLink' => '<i class="icon-home"></i>' . CHtml::link(Yii::t('adminModule.general','Inicio'), array('default/index')) . '<span class="divider"><i class="icon-angle-right"></i></span>',
							'links'=>$this->breadcrumbs,
						)); ?><!-- breadcrumbs -->
					<?php endif?>

					<div id="nav-search">
						<form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="<?php echo Yii::t('adminModule.general', 'Buscar') ?>" class="input-small search-query" id="nav-search-input" autocomplete="off" />
								<i class="icon-search" id="nav-search-icon"></i>
							</span>
						</form>
					</div><!--#nav-search-->
				</div>
				<?php endif ?>

				<div id="page-content" class="clearfix">
					<?php if (Yii::app()->user->hasFlash('error')): ?>
						<div class="alert alert-error"><?php echo Yii::app()->user->getFlash('error') ?></div>
					<?php elseif(Yii::app()->user->hasFlash('success')): ?>
						<div class="alert alert-success"><?php echo Yii::app()->user->getFlash('success') ?></div>
					<?php endif ?>
					<?php echo $content ?>
				</div><!--/#page-content-->

				<!--
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
				</div>
			--><!--/#ace-settings-container-->
			</div><!--/#main-content-->
		</div><!--/.fluid-container#main-container-->

		<script id="tmpl-layout-chat-item" type="text/template">
		<li>
			<a href="#">
				<img src="<?php echo Yii::app()->baseUrl ?>/uploads/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
				<span class="msg-body">
					<span class="msg-title">
						<span class="blue"><%= model.username %></span>
						<%= model.message %>
					</span>

					<span class="msg-time">
						<i class="icon-time"></i>
						<span><%= model.datepost %></span>
					</span>
				</span>
			</a>
		</li>
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo Yii::app()->baseUrl ?>/js/jquery-1.9.1.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo Yii::app()->baseUrl ?>/js/jQuery.yii.js"></script>
		<script src="<?php echo Yii::app()->baseUrl ?>/js/bootstrap.min.js"></script>
		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="/js/"></script>
		<![endif]-->
		<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/jquery.dataTables.bootstrap.js"></script>
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

	</body>
</html>
