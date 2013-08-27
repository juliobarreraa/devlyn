<?php
/**
 * <pre>
 * 	Crea las tablas de configuración del sistema
 * 	[+] Tabla de aplicación
 * 	[+] Tabla de de grupos de aplicación
 * 	[+] Tabla de configuración por grupo
 * </pre>
 * $Source$
 * $File$
 * $Revision$
 * @version $Id$
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 * @author   $Author$
 * @since   # $Date$
*/
class m130724_232435_settings extends CDbMigration
{
	public function up()
	{
		//Clave de aplicación para colección de configuraciones, solo sirve visualmente
		$this->createTable('{{settingsApp}}', array(
			 'id' => 'pk'
			,'member_id' => 'int(11) NOT NULL'
			,'name' => 'varchar(100) NOT NULL'
			,'updated_at' => 'int(10) DEFAULT NULL'
			,'created_at' => 'int(10) NOT NULL'
			,'UNIQUE KEY name(name)'
		));

		//$this->addForeignKey('{{settingsApp_ibfk_1}}', '{{settingsApp}}', 'member_id', '{{members}}', 'id', 'CASCADE', 'CASCADE');

		/** @type string $item */
		foreach(array(1 => 'System', 'Members') as $item) {
			//Insertamos la aplicación
			$this->insert('{{settingsApp}}', array('member_id' => Members::MEMBER_DEFAULT, 'name' => $item, 'created_at' => time()));
		}

		//Tabla de grupos de configuraciones para una aplicación
		$this->createTable('{{settingsGroup_app}}', array(
			 'id' => 'pk'
			,'member_id' => 'int(11) NOT NULL'
			,'setting_app_id' => 'int(11) NOT NULL'
			,'name' => 'varchar(200) NOT NULL'
			,'updated_at' => 'int(10) DEFAULT NULL'
			,'created_at' => 'int(10) NOT NULL'
			,'UNIQUE KEY app_name(setting_app_id, name)'
		));

		//$this->addForeignKey('{{settingsGroup_app_ibfk_1}}', '{{settingsGroup_app}}', 'setting_app_id', '{{settingsApp}}', 'id', 'CASCADE', 'CASCADE');
		//$this->addForeignKey('{{settingsGroup_app_ibfk_2}}', '{{settingsGroup_app}}', 'member_id', '{{members}}', 'id', 'CASCADE', 'CASCADE');

		/** @type string $item */
		foreach(array(
					 1 => array()
					,array(
						'profile' //Settings para perfil de usuario
					)
				) as $key => $item) {
			foreach($item as $value)
				//Insertamos la aplicación
				$this->insert('{{settingsGroup_app}}', array('member_id' => Members::MEMBER_DEFAULT, 'setting_app_id' => $key, 'name' => $value, 'created_at' => time()));
		}

		//Tabla de colección de cache de configuraciones
        $this->createTable('{{settingsCacheStore_group}}', array(
        	 'settingGroup_id' => 'int(11) NOT NULL'
        	,'member_id' => 'int(11) NOT NULL'
        	,'cs_key' => 'varchar(255) NOT NULL'
        	,'cs_value' => 'mediumtext'
        	,'cs_array' => "tinyint(1) NOT NULL DEFAULT '0'"
        	,'cs_updated'	=> "int(10) NOT NULL DEFAULT '0'"
			,'UNIQUE KEY cs_key(settingGroup_id, cs_key)'
        ), 'ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1');

		//$this->addForeignKey('{{settingsCacheStore_group_ibfk_1}}', '{{settingsCacheStore_group}}', 'settingGroup_id', '{{settingsGroup_app}}', 'id', 'CASCADE', 'CASCADE');
		//$this->addForeignKey('{{settingsCacheStore_group_ibfk_2}}', '{{settingsCacheStore_group}}', 'member_id', '{{members}}', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		$this->dropTable('{{settingsCacheStore_group}}');
		$this->dropTable('{{settingsGroup_app}}');
		$this->dropTable('{{settingsApp}}');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}