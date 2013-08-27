/**
 * Nombre de la cookie de la sesión
 * @type {String}
 */
var COOKIE_NAME = "PHPSESSID"
/**
 * Nombre del campo prefix para obtener el username
 * @type {String}
 */
,SESS_USERNAME = 'name'
/**
 * Nombre del campo prefix para obtener el identificador
 * @type {String}
 */
,SESS_ID = 'id'
/**
 * Nombre del campo prefix para obtener el nombre de la sesión
 * @type {String}
 */
,SESS_PREFIX = 'session_'
/**
 * Manipulador de la cookie
 * @type {Object}
 */
,cookie = require('./../lib/cookie.js')
/**
 * Redis client
 * @type {Object}
 */
,redis = require('redis')
/**
 * Colección de mensajes
 * @type {Array}
 */
,messages = []
/**
 * Colección de sockets conectados. Pueden existir en diferentes pestañas.
 * @type {Array}
 */
,sockets = []
/**
 * Listado de contactos
 * @type {Array}
 */
,contacts = []
/**
 * Funciones helpers
 * @type {Object}
 */
,utils = require('./../lib/utils.js')
/**
 * Objeto json socket io
 * @type {Object}
 */
,result = {}
/**
 * Nombre de la sesión del usuario
 * @type {String}
 */
,session_name = '';

//Socket
geddy.io.sockets.on('connection', function(socket) {
  var cookieManager = new cookie.cookie(socket.handshake.headers.cookie);
  var sid = cookieManager.get(COOKIE_NAME);
  var clientSession = new redis.createClient();

  socket.private = null;

  clientSession.get("sessions/"+sid, function(error, result){
      //Convertimos la respuesta en un objeto json
      result = eval('(' + result + ')');

      //Si tenemos resultado, es que hay una sesión abierta
      if(result && result.toString()){
          //Prefix sesión
          var prefix = result.keyPrefix + '__';

          //Identificador del usuario
          socket.userid = result[prefix + SESS_ID];

          //Sala a la que nos uniremos
          var room = SESS_PREFIX + socket.userid;

          //Nos unimos a una sala.
          socket.join(room);

          //Nombre del usuario
          socket.username = result[prefix + SESS_USERNAME];

          //Nombre sesión
          session_name = SESS_PREFIX + socket.userid;

          /**
           * Contacto añadido
           * @type {Object}
           */
          var contact = searchUserById(socket.userid, {returnFields: ['id', 'username']});

          //Agregamos un nuevo contacto solo si este no existe
          if(!contact) {
            //Contacto nuevo
            contact = {id: socket.userid, username: socket.username};

            contacts.push(contact);
          }

          //Recorremos cada uno de los contactos
          for (x in contacts) {
              //Contacto en individual
              var contact = contacts[x];

              //Emitimos el nuevo contacto
              socket.emit('contact new', contact);
          };

          /**
           * Enviamos la colección de mensajes en la pila messages
           */
          for(x in messages) {
              //Mensaje individual
              var message = messages[x];

              /**
               * Si el usuario al que le enviaron el mensaje coincide con mi userid
               * entonces me envia el mensaje en otro caso solo si este fuera global a todos los usuarios
               */
              var toid = utils.isNumber(message.toid) ? parseInt(message.toid) : null;

              //Al usuario le enviaron el mensaje
              if(!toid || toid == socket.userid)
                  socket.emit('chat new', message);
              //El usuario envio el mensaje
              else if(message.userid == socket.userid)
                  socket.emit('chat new', message);
          }
      }

      /**
       * Nos une a un canal privado con identificador t.userid
       * @param  {Object} t Contiene colección de datos a utilizar
       * @return void
       */
      socket.on('private open', function(t) {
          var userid = parseInt(t.userid);

          if(isNaN(userid))
              userid = null;

          if(userid != socket.userid)
          {
              //Configuramos los parámetros que enviaremos al cliente
              var userInfo = searchUserById(userid, {returnFields: ['userid', 'username']});

              //Confirmamos al usuario que se ha unido a un canal privado de forma exitosa.
              socket.emit('private open', userInfo);

              socket.private = userid;
          }
          else {
              socket.emit('error private');
          }
      });

      /**
       * Cierra el canal privado
       */
      socket.on('private close', function() {
          socket.private = null;

          //Enviamos confirmación al cliente de que se ha salido del canal privado de forma exitosa
          socket.emit('private close');
      });

      /**
       * Listener para recepción de mensajes, principal envia y decide de quien son cada mensaje recibido.
       * @param  {Object} t Datos enviados desde el cliente
       */
      socket.on('chat new', function(t) {
        //Enviamos el nombre del usuario que envio el mensaje
        t.username = socket.username;
        t.userid = socket.userid;
        t.datepost = utils.getDate();

        //Si la cadena viene en blanco enviamos un error al cliente
        if(utils.trim(t.message) == '') {
            socket.emit('error chat');
            return;
        }

        //Quitamos los caracteres especiales
        t.message = utils.htmlEncode(t.message);
        
        //Atributo para saber si el mensaje se envia a alguien o no.
        t.toid = socket.private;

        //Si es diferente de nulo
        if(t.toid)
            t.to = searchUserById(t.toid, {returnFields: ['id', 'username']})

        //Mensaje nuevo recibido y almacenado en la pila de mensajes
        messages.push(t);

        //Disparamos el envio de mensajes al cliente
        
        //Envia al emisor, el mensaje.
        socket.emit('chat new', t);

        /**
         * Decide si se envia el mensaje a un canal privado o se envia a todo el público
         */
        if(utils.isNumber(socket.private))
            geddy.io.sockets.in(SESS_PREFIX + socket.private).emit('chat new', t);
        else
            socket.broadcast.emit('chat new', t);
      });
  });

  /**
   * Cuando la sesión del usuario se desconecta
   */
	socket.on('disconnect', function() {
    /*if(typeof sockets[session_name] !== 'undefined') {
      //Recorremos los sockets para eliminar el socket de la pestaña que se cierra
      for(x in sockets[session_name]) {
        //Si coincide con el socket.id, lo eliminamos
        if(sockets[session_name][x].id == socket.id)
          sockets[session_name].splice(x, 1);
      }

      //Si ya no hay sesiones abiertas entonces eliminamos el socket
      if(utils.getLength(sockets[session_name]) == 0) {
          delete sockets[session_name];
          refreshContacts();
      }
    }*/
  });

  /**
   * Busca información en el socket referente al usuario userid
   * @param  {integer} userid Identificador del usuario a buscar
   * @return {Object}        La información del usuario
   */
  function searchUserById(userid, params) {
      //Verificamos que params no tenga datos nulos
      params = params || {};

      //Información del usuario a retornar
      var userInfo = null;

      //Recorremos todo el listado de contactos
      for(x in contacts) {
          //Contacto individual
          var contact = contacts[x];
          //Si tienen el mismo identificador
          if(contact && contact.id == socket.userid) {

              userInfo = {};

              for(x in params.returnFields) {
                  //Valor obtenido del socket
                  var userValueOfSocket = contact[params.returnFields[x]];

                  if(typeof userValueOfSocket != 'undefined')
                      userInfo[params.returnFields[x]] = userValueOfSocket;
              }

              break;
          }
      }

      return userInfo;
  }

  /**
   * Refresca el listado de contactos
   */
  function refreshContacts() {
    /*for(x in sockets) {
      //Parseamos la información del usuario que será enviada
      var contact = {userid: sockets[x].userid, username: sockets[x].username};
      //Disparamos el evento
      socket.emit('contacts new', contact);
      socket.broadcast.emit('contacts new', contact);
    }*/
  }
});