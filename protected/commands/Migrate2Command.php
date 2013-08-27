<?php 
/**
 * $File$
 * @author $Author$
 * @link http://www.codebit.org/
 * @copyright Copyright &copy; 2013-2015 Codebit
 * @license http://www.codebit.org/license/
 */

/**
 * Realiza la migración de datos de la plataforma <a href="http://www.invisionpower.com/apps/board/" target="_blank">Invision Power Board</a> a globalcms
 * los datos se extraen de la base de datos codebit_org, deberá estar previamente configurada en el archivo protected/config/console.php, en otro caso generara error.
 * Usage: php protected/yiic migrate2 --complete=0
 * 
 * $Revision$
 * $Source$
 * $File$
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 * @package system.commands
 * @category commands
 * @version $Revision$
 * @author   $Author$
 * @since   # $Date$
 */
class Migrate2Command extends CConsoleCommand
{
	/**
	 * @constant(Start_Members)
	 */
	const Start_Members = 0;
	/**
	 * @constant(Start_Forums)
	 */
	const Start_Forums = 1;
	/**
	 * @constant(Start_Topics)
	 */
	const Start_Topics=2;

	/**
	 * Realiza la migración del esquema de datos de invision power board a globalcms
	 * @param  integer $complete Especifica el nivel del cual se iniciará la importación. Por defecto 0 para iniciar desde el nivel de usuarios.
	 * @return boolean            Si todo fue correcto arroja true.
	 */
	public function actionIndex($complete = 0) {

		switch($complete ) {
			case self::Start_Members:
				print "Importación de usuarios\n";

				/**
				 * 0. Reiniciamos las tablas de datos para instalar los nuevos usuarios de la aplicación.
				 */
				Yii::app()->db->createCommand( "DELETE FROM `{{member_profile}}` WHERE 1" )->execute();
				Yii::app()->db->createCommand( "DELETE FROM `{{members}}` WHERE 1" )->execute();

				/**
				 * 1. Comenzamos migración de usuarios
				 */
				Yii::app()->migrate2new->active = true;

				//Usuarios antiguo esquema.
				$command = Yii::app()->migrate2new->createCommand( "SELECT m.id, m.name, m.email, m.mgroup, m.members_l_username, m.joined, m.last_activity, m.ip_address, mc.converge_pass_hash, mc.converge_pass_salt, me.avatar_location, me.bio
																	FROM `{{members}}` m
																	INNER JOIN `{{members_converge}}` mc ON m.id = mc.converge_id
																	INNER JOIN `{{member_extra}}` me ON m.id = me.id" );

				$rows = $command->queryAll();

				//Dejamos inactiva la conexión migrate2new para poder usar la conexión principal hacia nuestra base de datos.
				Yii::app()->migrate2new->active = false;

				//Insertamos los datos en el nuevo modelo.
				/** @type array $row */
				foreach($rows as $row) {
					if(Members::create($row)) {
						print "Usuario {$row['id']} - {$row['name']} importado exitosamente\n";
					}
					else {
						print "Ocurrio un error con el registro: {$row['id']}\n";
					}
				}
			case self::Start_Forums:
				/**
				 * 2. Comienza la migración de los foros
				 */
				
				print "Importación de foros\n";
				
				//Reseteamos la tabla de foros.
				Yii::app()->db->createCommand( "DELETE FROM `{{forums}}` WHERE 1" )->execute();

				Yii::app()->migrate2new->active = true; //Activamos la conexión

				$command = Yii::app()->migrate2new->createCommand( "SELECT id, last_poster_id, name, description, position, password, last_id, show_rules, parent_id, rules_title, rules_text, status FROM `{{forums}}` f" );
				$rows = $command->queryAll();

				//Dejamos inactiva la conexión migrate2new para poder usar la conexión principal hacia nuestra base de datos.
				Yii::app()->migrate2new->active = false;

				/** @type array $row */
				foreach($rows as $row) {
					if(Forums::create($row)) {
						print "Foro {$row['id']} - {$row['name']} importado exitosamente\n";
					}
					else {
						print "Ocurrio un error con el registro: {$row['id']}\n";
					}
				}
			case self::Start_Topics:
				/**
				 * 3. Comienza la migración de los Topics
				 */
				print "Importacion de Topics";

				//Reseteamos la tabla de topics
				Yii::app()->db->createCommand("DELETE FROM {{topics}} WHERE 1")->execute();
				Yii::app()->migrate2new->active = true; //Activamos la conexión a migrate2new

				$command =Yii::app()->migrate2new->createCommand("SELECT * FROM `{{topics}}` t
																		   INNER JOIN `{{posts}}` p ON t.topic_firstpost = p.pid");
				$rows = $command->queryAll();

				//Dejamos inactiva la conexión migrate2new para poder usar la conexión principal hacia nuestra base de datos.
				Yii::app()->migrate2new->active = false;

				/** @type array $row */
				foreach($rows as $row){
					if (Topics::create($row)) {
						print "Topic {$row['tid']} - {$row['title']} importado exitosamente\n";
					}
					else {
						print "Ocurrio un error con el registro: {$row['tid']}\n";
					}
				}
			break;

			default:
				print "No implementado aun";
		}
	}
}


