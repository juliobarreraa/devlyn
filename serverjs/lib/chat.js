//Inicializamos el objeto
var chat = {
	/**
	 * Socket utilizado por la conexión actual.
	 * @type {[type]}
	 */
	 socket: null
	/**
	 * Colección de mensajes
	 * @type {Array}
	 */
	,messages: []
	/**
	 * Nombre del campo prefix para obtener el nombre de la sesión
	 * @type {String}
	 */
	,SESS_PREFIX: 'session_'
	/**
	 * Colección de sockets conectados. Pueden existir en diferentes pestañas.
	 * @type {Array}
	 */
	,sockets: []
}
/**
 * Funciones helpers
 * @type {Object}
 */
,utils = require('./../lib/utils.js')
/**
 * Referencia this
 * @type {Object}
 */
,self = null;

/**
 * Funciones iniciales para correr el objeto chat
 * @param  {Object} socket Socket creado
 */
chat.init = function(socket) {
	  //Referencia this
	  self = this;

	  //Inicializamos el socket
	  this.socket = socket;
      /**
       * Listener para recepción de mensajes, principal envia y decide de quien son cada mensaje recibido.
       * @param  {Object} t Datos enviados desde el cliente
       */
      this.socket.on('message new', function(t) {
        //Enviamos el nombre del usuario que envio el mensaje
        t.username = self.socket.username;
        t.userid = self.socket.userid;
        t.datepost = utils.getDate();

        //Si la cadena viene en blanco enviamos un error al cliente
        if(utils.trim(t.message) == '') {
            self.socket.emit('error message');
            return;
        }

        //Quitamos los caracteres especiales
        t.message = utils.htmlEncode(t.message);
        
        //Atributo para saber si el mensaje se envia a alguien o no.
        t.toid = self.socket.private;

        //Mensaje nuevo recibido y almacenado en la pila de mensajes
        self.messages.push(t);

        //Disparamos el envio de mensajes al cliente
        
        //Envia al emisor, el mensaje.
        self.socket.emit('message new', t);

        /**
         * Decide si se envia el mensaje a un canal privado o se envia a todo el público
         */
        if(utils.isNumber(self.socket.private))
            geddy.io.sockets.in(self.SESS_PREFIX + self.socket.private).emit('message new', t);
        else
            self.socket.broadcast.emit('message new', t);
      });

      /**
       * Cierra el canal privado
       */
      this.socket.on('private close', function() {
          self.socket.private = null;

          //Enviamos confirmación al cliente de que se ha salido del canal privado de forma exitosa
          self.socket.emit('private close');
      });

      /**
       * Nos une a un canal privado con identificador t.userid
       * @param  {Object} t Contiene colección de datos a utilizar
       * @return void
       */
      this.socket.on('private open', function(t) {
          var userid = parseInt(t.userid);

          if(isNaN(userid))
              userid = null;

          if(userid != self.socket.userid)
          {
              //Configuramos los parámetros que enviaremos al cliente
              var userInfo = self.searchUserById(userid, {returnFields: ['userid', 'username']});

              //Confirmamos al usuario que se ha unido a un canal privado de forma exitosa.
              self.socket.emit('private open', userInfo);

              self.socket.private = userid;
          }
          else {
              self.socket.emit('error private');
          }
      });
}

/**
 * Envia la colección de mensajes en pila
 */
chat.sendMessages = function() {
	  /**
	   * Enviamos la colección de mensajes en la pila messages
	   */
	  for(x in this.messages) {
	      //Mensaje individual
	      var message = this.messages[x];

	      /**
	       * Si el usuario al que le enviaron el mensaje coincide con mi userid
	       * entonces me envia el mensaje en otro caso solo si este fuera global a todos los usuarios
	       */
	      var toid = utils.isNumber(message.toid) ? parseInt(message.toid) : null;

	      //Al usuario le enviaron el mensaje
	      if(!toid || toid == this.socket.userid)
	          this.socket.emit('message new', message);
	      //El usuario envio el mensaje
	      else if(message.userid == this.socket.userid)
	          this.socket.emit('message new', message);
	  }
}

/**
 * Busca información en el socket referente al usuario userid
 * @param  {integer} userid Identificador del usuario a buscar
 * @return {Object}        La información del usuario
 */
chat.searchUserById = function(userid, params) {
      //Armamos la sesión del usuario a investigar
      var session_name = self.SESS_PREFIX + userid;

      //Verificamos que params no tenga datos nulos
      params = params || {};

      //Si returnFields tiene valores en arreglo, regresamos todos los campos solicitados, asegurandonos que cada campo exista en el socket.
      if(typeof this.sockets[session_name] != 'undefined' && typeof params.returnFields != 'undefined')
      {
          //Información del usuario a retornar
          var userInfo = {};

          for(x in params.returnFields) {
              //Valor obtenido del socket
              var userValueOfSocket = self.sockets[session_name][0][params.returnFields[x]];

              if(typeof userValueOfSocket != 'undefined')
                  userInfo[params.returnFields[x]] = userValueOfSocket;
          }

          return userInfo;
      }
      else {
        self.socket.emit('error message');
      }

      return this.sockets[session_name];
  }

//Exportamos funciones
module.exports = chat;