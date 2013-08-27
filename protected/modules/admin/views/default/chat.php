<?php 
$this->breadcrumbs=array(
	Yii::t('adminModule.chat', 'Chat')
);

Yii::app()->clientScript->registerScriptFile('//underscorejs.org/underscore-min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/soundmanager2.min.js', CClientScript::POS_END);
?>

<div class="row-fluid">
	<div class="span12">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="lighter smaller">
					<i class="icon-comment blue"></i>
					<?php echo Yii::t('adminModule.chat', 'Conversación'); ?> - <a href="#" id="chat-join-channel-global"><?php echo Yii::t('adminModule.chat', 'Global'); ?></a><b><span id="chat-channel"></span></b>
				</h4>
			</div>

			<div class="widget-body">
				<div class="widget-main span10 no-padding">
					<div class="dialogs" id="dialogs">
						<!-- Items -->
						<div id="chat-dialogs-inner"></div>
						<!-- /Items -->
					</div>
					<form id="send-chat-msg" method="POST">
						<div class="form-actions input-append">
							<input placeholder="<?php echo Yii::t('adminModule.chat', 'Escriba su mensaje&hellip;'); ?>" type="text" class="width-75" name="message" autocomplete="off" />
							<button class="btn btn-small btn-info no-radius" type="submit">
								<i class="icon-share-alt"></i>
								<span class="hidden-phone"><?php echo Yii::t('adminModule.chat', 'Enviar'); ?></span>
							</button>
						</div>
					</form>
				</div><!--/widget-main-->
				<div class="span2">
					<ul id="chat-contact-list">
						<li><?php echo Yii::t('adminModule.chat', 'No hay contactos'); ?></li>
					</ul>
				</div>
			</div><!--/widget-body-->
		</div><!--/widget-box-->
	</div><!--/span-->
</div>

<!-- Área destinada a plantillas -->
<script id="tmpl-chat-item" type="text/template">
<div class="itemdiv dialogdiv">
	<div class="user">
		<!-- <img alt="Alexa's Avatar" src="assets/avatars/avatar1.png" /> -->
	</div>

	<div class="body">
		<div class="time">
			<i class="icon-time"></i>
			<span class="green"><%= model.datepost %></span>
		</div>

		<div class="name">
			<a href="#"><%= model.username %></a><% if(typeof model.to != 'undefined') { %> <i class="icon-share-alt"></i> <a href="#"><%= model.to.username %></a><% } %>
		</div>
		<div class="text"><%= model.message %></div>

		<% if(model.userid != <?php echo Yii::app()->user->id; ?>) { %>
		<div class="tools">
			<a href="#" class="btn btn-minier btn-info reply" data-userid="<%= model.userid %>">
				<i class="icon-only icon-share-alt"></i>
			</a>
		</div>
		<% } %>
	</div>
</div>
</script>
<script id="tmpl-chat-errors" type="text/template">
<div class="alert alert-error">
	<%= message %>
</div>
</script>

<script id="tmpl-chat-contact" type="text/template">
<li><%= model.username %></li>
</script>
<!-- /Plantillas -->

<?php 
$not_permission_white_message = Yii::t('adminModule.chat', 'Ocurrio un error al enviar el mensaje.');
$not_permission_chat_withyou = Yii::t('adminModule.chat', 'No tienes permitido realizar esta acción.'); 
?>
<?php Yii::app()->clientScript->registerScript('load_jscripts_chat', 
<<<EOF
	//Click sound
	var newMessage = null;

	/**
	 * Dispara un sonido multimedia para hacer referencia al nuevo mensaje recibido
	 */	
	function triggerSound() {
		soundManager.setup({
		  url: gcms.baseUrl + '/js/sounds/swf/',
		  flashVersion: 9, // optional: shiny features (default = 8)
		  preferFlash: false,
		  onready: function() {
			newMessage = soundManager.createSound({
				id: 'newMessage',
			  	url: gcms.baseUrl + '/js/sounds/001.mp3',
			});
		  }
		});
	}

	triggerSound();


	//Capturamos el evento de envio
	jQuery("#send-chat-msg").submit(function(e) {
		//Capturamos la información que envia el usuario
		var messageText = jQuery(this).find("[name='message']:input").val();
		//Enviamos al servidor nodejs el nuevo mensaje
		socket.emit('chat new', {message: messageText});

		//Limpiamos el formulario
		jQuery(this).find(":input").each(function(index, obj) {
			jQuery(this).val("");
		});
		//Evitamos la redirección
		e.preventDefault();
	});

	/**
	 * Detecta el click y envia un disparador al servidor que nos saca de cualquier ventana privada.
	 */	
	jQuery('#chat-join-channel-global').click(function(e) {
		//Cerramos la conexión del canal privado
		socket.emit('private close');

		//Evitamos la redirección
		e.preventDefault();
	});

	/**
	 * Recibe datos del servidor
	 * @param  {Object} t Datos enviados desde el servidor
	 */
	socket.on('chat new', function(t) {
		var  \$inner = jQuery('#chat-dialogs-inner');
		//Objeto sobre el cual se muestran los mensajes del servidor al cliente
		var \$dialogs = jQuery('#dialogs');
		//Generamos la plantilla a utilizar a través de underscore
		var template = _.template(jQuery('#tmpl-chat-item').html());
		//Añadimos el contenido interpretado de la plantilla en \$dialogs
		
		newMessage.play();

		\$inner.append(template({model: t}));
		\$dialogs.animate({ scrollTop: \$inner.height() },0);
		setEventClick();
	});

	socket.on('contacts new', function(t) {
		console.log(t);
	});

	/**
	 * Configura el título de la ventana de chat con el nombre del usuario que se inicio la Conversación
	 * @param  {Object} t Datos enviados desde el servidor
	 */
	socket.on('private open', function(t) {
		jQuery('#chat-channel').text(' - ' + t.username);
	});

	/**
	 * Visualmente confirma la salida de un canal privado
	 */
	socket.on('private close', function() {
		//Eliminamos visualmente canales privados en los que estuvieramos unidos
		jQuery('#chat-channel').text('');
	});

	/**
	 * Visualmente muestra un error al usuario en dialogo.
	 */
	socket.on('error chat', function() {
		var  \$inner = jQuery('#chat-dialogs-inner');
		//Objeto sobre el cual se muestran los mensajes del servidor al cliente
		var \$dialogs = jQuery('#dialogs');

		//Mostramos el error al usuario en un espacio de la ventana de dialogo
		//Plantilla de errores
		var template = _.template(jQuery('#tmpl-chat-errors').html());

		\$inner.append(template({message: '$not_permission_white_message'}));
		\$dialogs.animate({ scrollTop: \$inner.height() },0);
	});

	/**
	 * Visualmente muestra un error al usuario en dialogo.
	 */
	socket.on('error private', function() {
		var  \$inner = jQuery('#chat-dialogs-inner');
		//Objeto sobre el cual se muestran los mensajes del servidor al cliente
		var \$dialogs = jQuery('#dialogs');

		//Mostramos el error al usuario en un espacio de la ventana de dialogo
		//Plantilla de errores
		var template = _.template(jQuery('#tmpl-chat-errors').html());

		\$inner.append(template({message: '$not_permission_chat_withyou'}));
		\$dialogs.animate({ scrollTop: \$inner.height() },0);
	});

	/**
	 * Refresca listado de contactos
	 */
	socket.on('contact new', function(t) {
		//Listado de contactos
		\$contacts = \$('#chat-contact-list');
		//Plantilla
		var template = _.template($('#tmpl-chat-contact').html());
		\$contacts.prepend(template({model: t}));
	});

	function setEventClick() {
		//Capturamos el click a una respuesta para generar un chat privado
		jQuery('.btn.btn-minier.btn-info.reply').unbind('click');

		jQuery('.btn.btn-minier.btn-info.reply').click(function(e) {
			//Usuario con el que queremos platicar de forma privada
			var userid = parseInt(jQuery(this).data('userid'));

			socket.emit('private open', {userid: userid});
			//Evitamos la redirección
			e.preventDefault();
		});
	}
EOF
, CClientScript::POS_READY); ?>