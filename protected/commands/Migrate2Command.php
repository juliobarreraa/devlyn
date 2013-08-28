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
	 * @constant(Start_Members_profile)
	 */
	const Start_Member_Profile = 0;
	/**
	 * @constant(Start_Members)
	 */
	const Start_Members = 1;

	/**
	 * Realiza la migración del esquema de datos de invision power board a globalcms
	 * @param  integer $complete Especifica el nivel del cual se iniciará la importación. Por defecto 0 para iniciar desde el nivel de usuarios.
	 * @return boolean            Si todo fue correcto arroja true.
	 */
	public function actionIndex($complete = 0) {

		switch($complete ) {
			case self::Start_Member:
				print "Importación de usuarios\n";

				/**
				 * 0. Reiniciamos las tablas de datos para instalar los nuevos usuarios de la aplicación.
				 */
				//Yii::app()->db->createCommand( "DELETE FROM {{member_profile}} WHERE 1" )->execute();
				//Yii::app()->db->createCommand( "DELETE FROM {{members}} WHERE 1" )->execute();

				/**
				 * 1. Comenzamos migración de usuarios
				 */
				Yii::app()->migrate2new->active = true;
				
				//Usuarios antiguo esquema BD empleados.
				$command = Yii::app()->migrate2new->createCommand("SELECT s.id, s.employee_number, s.name, s.branch_office, s.department, s.region, s.team, s.leader FROM {{sucursales}} s");

				$rows = $command->queryAll();

				//Dejamos inactiva la conexión migrate2new para poder usar la conexión principal hacia nuestra base de datos.
				Yii::app()->migrate2new->active = false;

				//Insertamos los datos en el nuevo modelo.
				/** @type array $row */
				foreach($rows as $row) {
					if(Members::create($row)) {
						print "Usuario {$row['employee_number']} - {$row['name']} importado exitosamente\n";
					}
					else {
						print "Ocurrio un error con el registro: {$row['id']}\n";
					}//echo "termino";exit;
				}

			case self::Start_Members:
				print "creación de contraseñas\n";

				/**
				 * 1. Comenzamos a crear las contraseñas
				 */
				Yii::app()->migrate2new->active = true;

				//Creamos la contraseña.
				$command = Yii::app()->migrate2new->createCommand( "SELECT id, employee_number, name, CONCAT(employee_number, name) password FROM sucursales"); 
				preg_match("/^[\d+\w+]/", $passwordgenerada, $match);
				//Inseramos la nueva contraseña.
				

				$rows = $command->queryAll();

				//Dejamos inactiva la conexiÃ³n migrate2new para poder usar la conexiÃ³n principal hacia nuestra base de datos.
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
			break;

			default:
				print "No implementado aun";
		}
	}
}


