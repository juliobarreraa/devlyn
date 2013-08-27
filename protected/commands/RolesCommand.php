<?php 
/**
 * $File$
 *
 * @author $Author$
 * @link http://www.codebit.org/
 * @copyright Copyright &copy; 2013-2015 Codebit
 * @license http://www.codebit.org/license/
 */

/**
 * Crea los roles de usuarios, gestiona los accesos de la aplicación, solo se gestionan los roles básicos pero se pueden añadir más roles desde el adminsitrador.
 *
 *
 * <ul>
 *    <li>operations.system
 *        <dl>
 *        	<dt>webViewOnline</dt>
 * 			<dd>Permiso para ver el sitio web cuando este se encuentra activo para todos los usuarios. (En línea)</dd>
 *    		<dt>webViewOffline</dt>
 *			<dd>Permiso para ver el sitio web cuando este se encuentra fuera de linea.</dd>
 *   		<dt>templatesEdit</dt>
 *			<dd>Permite editar plantillas</dd>
 *   		<dt>templatesDelete</dt>
 *			<dd>Permite borrar plantillas</dd>
 * 	 		<dt>templatesCreate</dt>
 *			<dd>Permite crear plantillas</dd>
 *   		<dt>languageCreate</dt>
 *			<dd>Permite crear nuevos archivos de lenguaje</dd>
 *   		<dt>languageEdit</dt>
 *			<dd>Permite editar los archivos existentes de lenguaje</dd>
 *   		<dt>languageDelete</dt>
 * 			<dd>Permite eliminar archivos de lenguaje</dd>
 *    		<dt>pluginsCreate</dt>
 * 			<dd>Crear plugins en modo desarrollador.</dd>
 *    		<dt>pluginsExport</dt>
 * 			<dd>Exportar plugins para empaquetado</dd>
 *    		<dt>pluginsEdit</dt>
 * 			<dd>Editar plugins</dd>
 *    		<dt>pluginsDelete</dt>
 * 			<dd>Borrar plugins</dd>
 *    		<dt>pluginsUpload</dt>
 * 			<dd>Subir Plugins</dd>
 *    		<dt>webdav</dt>
 * 			<dd>Editar mediante protocolo webdav los archivos de plantilla.</dd>
 *    		<dt>recache</dt>
 *		    <dd>Permite cachear la información del sistema, conteo de datos.</dd>
 *      	<dt>systemConfiguration</dt>
 *       	<dd>Cambiar datos de la configuración general.</dd>
 *        	<dt>rolesCreate</dt>
 *         	<dd>Crea nuevos roles con selección de operaciones</dd>
 *          <dt>rolesEdit</dt>
 *          <dd>Edición de roles con selección de operaciones</dd>
 *          <dt>rolesDelete</dt>
 *          <dd>Baja de roles.</dd>
 * 		 </dl>
 * 	   </li>
 * 	   <li>operations.members
 *        <dl>
 *     		<dt>messagesSubmit</dt>
 *       	<dd>Permite enviar un mensaje a un usuario particular. El envio se hace a usuarios amigos y el rol puede permitir enviar mensajes a usuarios que no son amigos entre si.</dd>
 *        	<dt>messagesReply</dt>
 *         	<dd>Responder al usuario que envio el mensaje.</dd>
 *          <dt>messagesDelete</dt>
 *          <dd>Eliminar un mensaje. Solo permite eliminar mensajes propios y a administradores eliminar los de otros usuarios.</dd>
 *          <dt>usersView</dt>
 *          <dd>Ver listado de usuarios</dd>
 *          <dt>usersCreate</dt>
 *          <dd>Crear usuarios en el sistema, generando una contraseña y configurando la información así como el rol de usuario, si se contará con este permiso.</dd>
 *          <dt>usersEdit</dt>
 *          <dd>Editar un usuario y su configuración personal.</dd>
 *          <dt>usersKick</dt>
 *          <dd>Bannear usuarios del sitio, los usuarios banneados no tendrán acceso al sitio, su rol base será banned</dd>
 *          <dt>usersDelete</dt>
 *          <dd>Elimina un usuario o usuarios en masa.</dd>
 *          <dt>rolesUsersAssign</dt>
 *          <dd>Asigna nuevos roles a los usuarios</dd>
 *          <dt>rolesUsersDelete</dt>
 *          <dd>Borra roles de usuarios.</dd>
 * 		 </dl>
 * 	   </li>
 * 	   <li>operations.forums
 *        <dl>
 *     		<dt>forumsView</dt>
 *       	<dd>Ver foros creados, algunos foros están ocultos, estos no se muestran.</dd>
 *        	<dt>forumsHiddenView</dt>
 *         	<dd>Ver foros ocultos.</dd>
 *          <dt>forumsCreate</dt>
 *          <dd>Permite crear foros</dd>
 *          <dt>forumsEdit</dt>
 *          <dd>Editar foros</dd>
 *          <dt>forumsDelete</dt>
 *          <dd>Borrar foros</dd>
 *          <dt>forumsStats</dt>
 *          <dd>Ver estadisticas de acceso a foro,
 *              <ul>
 *                     <li>respuestas,</li>
 *                     <li>artículos creados</li>
 *                     <li>Top users</li>
 *              </ul>
 *          </dd>
 *          <dt>topicsView</dt>
 *          <dd>Ver listado de temas</dd>
 *          <dt>topicsDelete</dt>
 *          <dd>Permite borrar un tema</dd>
 *          <dt>topicsEdit</dt>
 *          <dd>Permite editar un tema</dd>
 *          <dt>topicsCreate</dt>
 *          <dd>Permite crear un tema</dd>
 *          <dt>topicsReply</dt>
 *          <dd>Responder un tema</dd>
 *          <dt>forumsConfiguration</dt>
 *          <dd>Modificar la configuración de los foros.</dd>
 * 		 </dl>
 * 	   </li>
 * 	   <li>operations.chat
 *        <dl>
 *     		<dt>chatSubmit</dt>
 *       	<dd>Enviar mensajes
 *        		<ul>
 *          		<li>Amigos</li>
 *            		<li>Global</li>
 *              </ul>
 *          </dd>
 *          <dt>chatView</dt>
 *          <dd>Recibir mensajes</dd>
 *          <dt>chatHistorySave</dt>
 *          <dd>Almacenamiento de historial de mensajes</dd>
 *          <dt>chatHistoryDelete</dt>
 *          <dd>Borrar historial de mensajes</dd>
 * 		 </dl>
 * 	   </li>
 * </ul>
 * 
 * $Source$
 * $File$
 *
 * @property CDbAuthManager $_authManager Manejador de roles
 * 
 * @package system.commands
 * @category commands
 * @version $Id$
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 * @author   $Author$
 * @since   # $Date$
 */
class RolesCommand extends CConsoleCommand
{
	/**
	 * Componente Authmanager
	 * @var CDbAuthManager
	 */
	private $_authManager;

	/**
	 * Crea los roles de usuario básicos.
	 *
	 * <code>
	 * Usage: protected/yiic roles create [--users=1]
	 * </code>
	 * 
	 * @param  boolean $users Se crean usuarios de prueba
	 * @return boolean         Todo se ejecuto de forma correcta
	 */
	public function actionCreate($users = true) {
		//Verificamos que el objeto authManager este configurado en config/console.php
		if( ( $this->_authManager = Yii::app()->authManager ) === null )
        {
            echo "Error: an authorization manager, named 'authManager' must be configured to use this command.\n
                  If you already added 'authManager' component in application configuration,\n
                  please quit and re-enter the yiic shell.\n";
            return false;
        }

        echo "¿Desea continuar? [Si|No] ";

        if( ! strncasecmp( trim( fgets( STDIN ) ), 's', 1) )
        {
        	//Reiniciamos todos los permisos de roles configurados anteriormente.
        	$this->_authManager->clearAll();

        	/**
        	 * @todo Implementar acciones que resulten ventajosas en actualizaciones de sistema.
        	 */
        	//Creamos las operaciones que pueden realizar los diferentes usuarios de la plataforma
        	
        	//operations.system
        	$this->_authManager->createOperation('webViewOnline', 'View Site Online');
        	$this->_authManager->createOperation('webViewOffline', 'View Site Offline');
        	$this->_authManager->createOperation('templatesEdit', 'Permite editar plantillas');
        	$this->_authManager->createOperation('templatesDelete', 'Permite borrar plantillas');
        	$this->_authManager->createOperation('templatesCreate', 'Permite crear plantillas');
        	$this->_authManager->createOperation('languageCreate', 'Permite crear nuevos archivos de lenguaje');
        	$this->_authManager->createOperation('languageEdit', 'Permite editar los archivos existentes de lenguaje');
        	$this->_authManager->createOperation('languageDelete', 'Permite eliminar archivos de lenguaje');
        	$this->_authManager->createOperation('pluginsCreate', 'Crear plugins en modo desarrollador.');
        	$this->_authManager->createOperation('pluginsExport', 'Exportar plugins para empaquetado');
        	$this->_authManager->createOperation('pluginsEdit', 'Editar plugins');
        	$this->_authManager->createOperation('pluginsDelete', 'Borrar plugins');
        	$this->_authManager->createOperation('pluginsUpload', 'Subir Plugins');
        	$this->_authManager->createOperation('webdav', 'Editar mediante protocolo webdav los archivos de plantilla.');
        	$this->_authManager->createOperation('recache', 'Permite cachear la información del sistema, conteo de datos.');
        	$this->_authManager->createOperation('systemConfiguration', 'Cambiar datos de la configuración general.');
        	$this->_authManager->createOperation('rolesCreate', 'Crea nuevos roles con selección de operaciones');
        	$this->_authManager->createOperation('rolesEdit', 'Edición de roles con selección de operaciones');
        	$this->_authManager->createOperation('rolesDelete', 'Baja de roles.');

        	//operations.members
        	$this->_authManager->createOperation('messagesSubmit', 'Permite enviar un mensaje a un usuario particular. El envio se hace a usuarios amigos y el rol puede permitir enviar mensajes a usuarios que no son amigos entre si.');
        	$this->_authManager->createOperation('messagesReply', 'Responder al usuario que envio el mensaje.');
        	$this->_authManager->createOperation('messagesDelete', 'Eliminar un mensaje. Solo permite eliminar mensajes propios y a administradores eliminar los de otros usuarios.');
        	$this->_authManager->createOperation('usersView', 'Ver listado de usuarios');
        	$this->_authManager->createOperation('usersCreate', 'Crear usuarios en el sistema, generando una contraseña y configurando la información así como el rol de usuario, si se contará con este permiso.');
        	$this->_authManager->createOperation('usersEdit', 'Editar un usuario y su configuración personal.');
        	$this->_authManager->createOperation('usersKick', 'Bannear usuarios del sitio, los usuarios banneados no tendrán acceso al sitio, su rol base será banned');
        	$this->_authManager->createOperation('usersDelete', 'Elimina un usuario o usuarios en masa.');
        	$this->_authManager->createOperation('rolesUsersAssign', 'Asigna nuevos roles a los usuarios');
        	$this->_authManager->createOperation('rolesUsersDelete', 'Borra roles de usuarios.');

        	//operations.forums
        	$this->_authManager->createOperation('forumsView', 'Ver foros creados, algunos foros están ocultos, estos no se muestran.');
        	$this->_authManager->createOperation('forumsHiddenView', 'Ver foros ocultos.');
        	$this->_authManager->createOperation('forumsCreate', 'Permite crear foros');
        	$this->_authManager->createOperation('forumsEdit', 'Editar foros');
        	$this->_authManager->createOperation('forumsDelete', 'Borrar foros');
        	$this->_authManager->createOperation('forumsStats', 'Ver estadisticas de acceso a foro, respuestas, artículos creados, Top users');
        	$this->_authManager->createOperation('topicsView', 'Ver listado de temas');
        	$this->_authManager->createOperation('topicsDelete', 'Permite borrar un tema');
        	$this->_authManager->createOperation('topicsEdit', 'Permite editar un tema');
        	$this->_authManager->createOperation('topicsCreate', 'Permite crear un tema');
        	$this->_authManager->createOperation('topicsReply', 'Responder un tema');
        	$this->_authManager->createOperation('forumsConfiguration', 'Modificar la configuración de los foros.');

        	//operations.chat
        	$this->_authManager->createOperation('chatSubmit', 'Enviar mensajes, amigos/global');
        	$this->_authManager->createOperation('chatView', 'Recibir mensajes');
        	$this->_authManager->createOperation('chatHistorySave', 'Almacenamiento de historial de mensajes');
        	$this->_authManager->createOperation('chatHistoryDelete', 'Borrar historial de mensajes');

        	//Roles
        	//Invitado
        	$guest = $this->_authManager->createRole('guest');
        	$guest->addChild('webViewOnline');
        	$guest->addChild('forumsView');
        	$guest->addChild('topicsView');

        	//Registrado
        	$registered = $this->_authManager->createRole('registered');
        	$registered->addChild('guest');
        	$registered->addChild('messagesSubmit');
        	$registered->addChild('messagesReply');
        	$registered->addChild('messagesDelete');
        	$registered->addChild('usersView');
        	$registered->addChild('topicsCreate');
        	$registered->addChild('topicsReply');
        	$registered->addChild('topicsEdit');
        	$registered->addChild('chatSubmit');
        	$registered->addChild('chatView');
        	$registered->addChild('chatHistorySave');
        	$registered->addChild('chatHistoryDelete');

        	//Administrador
        	$administrator = $this->_authManager->createRole('administrator');
        	$administrator->addChild('registered');
        	$administrator->addChild('webViewOffline');
        	$administrator->addChild('pluginsUpload');
        	$administrator->addChild('recache');
        	$administrator->addChild('systemConfiguration');
        	$administrator->addChild('rolesCreate');
        	$administrator->addChild('rolesEdit');
        	$administrator->addChild('rolesDelete');
            $administrator->addChild('rolesUsersAssign');
            $administrator->addChild('rolesUsersDelete');
            $administrator->addChild('usersKick');
            $administrator->addChild('usersEdit');
            $administrator->addChild('usersCreate');
            $administrator->addChild('usersDelete');
            $administrator->addChild('forumsEdit');
            $administrator->addChild('forumsCreate');
            $administrator->addChild('forumsHiddenView');
            $administrator->addChild('forumsDelete');
            $administrator->addChild('forumsStats');
            $administrator->addChild('forumsConfiguration');

        	//Developer
        	$developer = $this->_authManager->createRole('developer');
        	$developer->addChild('administrator');
        	$developer->addChild('templatesEdit');
            $developer->addChild('templatesDelete');
        	$developer->addChild('templatesCreate');
        	$developer->addChild('languageCreate');
            $developer->addChild('languageDelete');
        	$developer->addChild('languageEdit');
        	$developer->addChild('pluginsCreate');
        	$developer->addChild('pluginsExport');
        	$developer->addChild('webdav');
        	$developer->addChild('pluginsDelete');

            //Root admin
            $rootAdmin = $this->_authManager->createRole('rootAdmin');
            $rootAdmin->addChild('developer');

            if($users) {
                $adminUser = Members::model()->findByAttributes(array( 'username' => 'admin' ));

               if( ! $adminUser )
                {
                    $adminUser = new Members;
                    $adminUser->scenario = 'automatic';

                    $adminUser->setAttributes( array( 
                        'name' => 'admin',
                        'username' => 'admin',
                        'email' => Yii::app()->params['adminEmail'],
                        'date_birth' => date('d-m-Y', time()),
                        'password' => '123456',
                        'terms_conditions' => true,
                        'nationality' => Members::NATIONALITY_FOREIGN,
                        'nationality_other' => 'Español',
                    ) );

                    $adminUser->save();
                    $this->_authManager->assign('rootAdmin', $adminUser->id);
                }
            }
        }

		return true;
	}
}