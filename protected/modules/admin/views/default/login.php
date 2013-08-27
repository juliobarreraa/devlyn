<div class="position-relative">
	<div id="login-box" class="visible widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header blue lighter bigger">
					<i class="icon-coffee green"></i>
					<?php echo Yii::t('adminModule.login', 'Identificarse'); ?>
				</h4>

				<div class="space-6"></div>

				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); ?>
					<?php if ($model->hasErrors()): ?>
					<div class="alert alert-error">
						<?php echo Yii::t('adminModule.login', 'Asegurese de que los datos sean correctos.') ?>
					</div>
					<?php endif ?>
					<fieldset>
						<label>
							<span class="block input-icon input-icon-right">
								<?php echo $form->textField($model,'username', array('class' => 'span12', 'placeholder' => $model->getAttributeLabel('username'))); ?>
								<i class="icon-user"></i>
							</span>
						</label>

						<label>
							<span class="block input-icon input-icon-right">
								<?php echo $form->passwordField($model,'password', array('class' => 'span12', 'placeholder' => $model->getAttributeLabel('password'))); ?>
								<i class="icon-lock"></i>
							</span>
						</label>

						<div class="space"></div>

						<div class="row-fluid">
							<label class="span8">
								<?php echo $form->checkBox($model,'rememberMe'); ?>
								<span class="lbl"><?php echo $model->getAttributeLabel('rememberMe') ?></span>
							</label>

							<button class="span4 btn btn-small btn-primary" type="submit">
								<i class="icon-key"></i>
								<?php echo Yii::t('adminModule.login', 'Entrar'); ?>
							</button>
						</div>
					</fieldset>
				<?php $this->endWidget(); ?>
			</div><!--/widget-main-->

			<div class="toolbar clearfix">
				<div>
					<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
						<i class="icon-arrow-left"></i>
						<?php echo Yii::t('adminModule.login', 'Olvide mi contraseña'); ?>
					</a>
				</div>

				<div>
					<a href="#" onclick="show_box('signup-box'); return false;" class="user-signup-link">
						<?php echo Yii::t('adminModule.login', 'Registrarme'); ?>
						<i class="icon-arrow-right"></i>
					</a>
				</div>
			</div>
		</div><!--/widget-body-->
	</div><!--/login-box-->

	<div id="forgot-box" class="widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header red lighter bigger">
					<i class="icon-key"></i>
					Retrieve Password
				</h4>

				<div class="space-6"></div>
				<p>
					Enter your email and to receive instructions
				</p>

				<form>
					<fieldset>
						<label>
							<span class="block input-icon input-icon-right">
								<input type="email" class="span12" placeholder="Email" />
								<i class="icon-envelope"></i>
							</span>
						</label>

						<div class="row-fluid">
							<button onclick="return false;" class="span5 offset7 btn btn-small btn-danger">
								<i class="icon-lightbulb"></i>
								Send Me!
							</button>
						</div>
					</fieldset>
				</form>
			</div><!--/widget-main-->

			<div class="toolbar center">
				<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
					Back to login
					<i class="icon-arrow-right"></i>
				</a>
			</div>
		</div><!--/widget-body-->
	</div><!--/forgot-box-->

	<div id="signup-box" class="widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header green lighter bigger">
					<i class="icon-group blue"></i>
					New User Registration
				</h4>

				<div class="space-6"></div>
				<p>
					Enter your details to begin:
				</p>

				<form>
					<fieldset>
						<label>
							<span class="block input-icon input-icon-right">
								<input type="email" class="span12" placeholder="Email" />
								<i class="icon-envelope"></i>
							</span>
						</label>

						<label>
							<span class="block input-icon input-icon-right">
								<input type="text" class="span12" placeholder="Username" />
								<i class="icon-user"></i>
							</span>
						</label>

						<label>
							<span class="block input-icon input-icon-right">
								<input type="password" class="span12" placeholder="Password" />
								<i class="icon-lock"></i>
							</span>
						</label>

						<label>
							<span class="block input-icon input-icon-right">
								<input type="password" class="span12" placeholder="Repeat password" />
								<i class="icon-retweet"></i>
							</span>
						</label>

						<label>
							<input type="checkbox" />
							<span class="lbl">
								I accept the
								<a href="#">User Agreement</a>
							</span>
						</label>

						<div class="space-24"></div>

						<div class="row-fluid">
							<button type="reset" class="span6 btn btn-small">
								<i class="icon-refresh"></i>
								Reset
							</button>

							<button onclick="return false;" class="span6 btn btn-small btn-success">
								Register
								<i class="icon-arrow-right icon-on-right"></i>
							</button>
						</div>
					</fieldset>
				</form>
			</div>

			<div class="toolbar center">
				<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
					<i class="icon-arrow-left"></i>
					Back to login
				</a>
			</div>
		</div><!--/widget-body-->
	</div><!--/signup-box-->
</div><!--/position-relative-->