<?php
/**
 * <pre>
 * 	Crea las tablas iniciales del sistema
 * 	[+] Tabla de usuarios
 * 	[+] Tabla de perfil de usuario
 * 	[+] Tablas de authmanager
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
class m130612_025736_base_tables extends CDbMigration
{
	/**
	 * Actualiza el sistema, crea tablas base del sistema
	 * @return boolean Si no tiene soporte para actualizar una versión devuelve false
	 */
	public function up()
	{
		//Tabla de usuarios
        $this->createTable('{{members}}', array(
        	'id' => 'pk',
        	'name' => 'varchar(50) NOT NULL',
        	'lastname' => 'VARCHAR(100) NULL',
        	'username' => 'varchar(50) NOT NULL',
        	'date_birth' => 'INT( 10 ) UNSIGNED NULL',
        	'nationality' => 'tinyint(5) NULL',
        	'nationality_other' => 'varchar(100) NULL',
        	'sex'  => 'TINYINT( 1 ) UNSIGNED NULL',
        	'language' => 'TINYINT( 3 ) UNSIGNED NULL',
        	'email'	=> 'varchar(100) DEFAULT NULL',
        	'pass_hash' => 'varchar(60) NOT NULL',
        	'pass_salt' => 'varchar(20) NOT NULL',
        	'tmp_hash' => 'VARCHAR( 100 ) NULL',
        	'tmp_hash_updated_at'  => 'INT( 10 ) UNSIGNED',
        	'partial' => 'tinyint(1) UNSIGNED DEFAULT NULL',
        	'fb_uid' => "bigint(20) unsigned NOT NULL DEFAULT '0'",
			'twitter_id' =>  'varchar(255) DEFAULT NULL',
			'twitter_token' =>  'varchar(255) DEFAULT NULL',
			'twitter_secret' =>  'varchar(255) DEFAULT NULL',
			'signature' =>  'varchar(255) CHARACTER SET utf8 DEFAULT NULL',
			'last_login_time' =>  'int(10) unsigned DEFAULT NULL',
			'ip_address' =>  "varchar(20) DEFAULT '::1'",
			'block' =>  "tinyint(3) unsigned NOT NULL DEFAULT '0'",
			'enabled' => "tinyint(1) unsigned NOT NULL DEFAULT '1'",
			'validate' => "tinyint(1) unsigned NOT NULL DEFAULT '1'",
			'updated_at' =>  'int(10) unsigned DEFAULT NULL',
			'created_at' =>  'int(10) unsigned NOT NULL',
			"UNIQUE KEY username (username)",
			"UNIQUE KEY email (email)",
        ), 'ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1');

		//Tabla de perfiles de usuarios
        $this->createTable('{{member_profile}}', array(
			'id' =>  'pk',
			'member_id' =>  'int(11) NOT NULL',
			'picture' =>  'varchar(100) CHARACTER SET utf8 DEFAULT NULL',
			'picture_thumb' =>  'varchar(100) CHARACTER SET utf8 DEFAULT NULL',
			'curriculum' =>  'varchar(100) CHARACTER SET utf8 DEFAULT NULL',
			'biography' =>  'text CHARACTER SET utf8 DEFAULT NULL',
			'extra_info' =>  'text CHARACTER SET utf8',
            'employee_number' =>  'int(10) DEFAULT NULL',
            'branch_office' =>  'int(10) DEFAULT NULL',
            'department'  => 'varchar(50) DEFAULT NULL',
            'region'  => 'varchar(30) DEFAULT NULL',
            'team'  => 'int(10) DEFAULT NULL',
            'leader'  => 'tinyint(1) DEFAULT NULL',
			"UNIQUE KEY member_id (member_id)",
        ), 'ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1' );

        $this->addForeignKey('{{member_profile_ibfk_1}}', '{{member_profile}}', 'member_id', '{{members}}', 'id', 'CASCADE', 'CASCADE');

        //Tabla de permisos
        $this->createTable( '{{auth_item}}', array(
        	'name' =>    'varchar(64) not null',
			'type' =>    'integer not null',
   			'description' => 'text',
   			'bizrule' => 'text',
   			'data' => 'text',
   			'primary key (name)'
        ), 'ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1' );

        //Tabla de relaciones con permisos
        $this->createTable( '{{auth_item_child}}', array(
        	'parent' =>    'varchar(64) not null',
			'child' =>    'varchar(64) not null',
   			'primary key (parent,child)',
   			'foreign key (parent) references {{auth_item}} (name) on delete cascade on update cascade',
   			'foreign key (child) references {{auth_item}} (name) on delete cascade on update cascade',
        ), 'ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1' );

        $this->createTable( '{{auth_assignment}}', array(
        	'itemname' =>    'varchar(64) not null',
			'userid' =>    'int(11) NOT NULL',
			'bizrule' =>    'text',
   			'data' =>    'text',
   			'primary key (itemname,userid)',
   			'foreign key (itemname) references {{auth_item}} (name) on delete cascade on update cascade',
        ), 'ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1' );

        $this->addForeignKey('{{auth_assignment_ibfk_2}}', '{{auth_assignment}}', 'userid', '{{members}}', 'id', 'CASCADE', 'CASCADE');

        /**
         * Estructura de la tabla de idiomas,
         * Relaciones: 
         */
        $this->createTable('{{language}}', array(
            'id' => 'pk',
            'dir' => 'varchar(64) DEFAULT NULL',
            'name' => 'varchar(250) NOT NULL',
            'author' => 'varchar(250) DEFAULT NULL',
            'email' => 'varchar(250) DEFAULT NULL',
            'updated_at' => 'int(10) unsigned DEFAULT NULL',
            'created_at' => 'int(10) unsigned NOT NULL',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1');

        //Insertamos datos necesarios para comenzar a hacer uso de la plataforma.
        $this->insert('{{language}}', array(
             'dir' => 'es-MX'
            ,'name' => 'Español'
            ,'author' => 'Julio Barrera'
            ,'email' => 'juliobarreraa@gmail.com'
            ,'created_at' => time()
        ));

        $this->insert('{{language}}', array(
             'dir' => 'en-US'
            ,'name' => 'Inglés'
            ,'author' => 'Julio Barrera'
            ,'email' => 'juliobarreraa@gmail.com'
            ,'created_at' => time()
        ));
	}

	/**
	 * Downgrade una versión
	 * @return boolean Si no tiene soporte para regresar una versión devuelve false
	 */
	public function down()
	{
		//Eliminamos las relaciones para evitar problemas con claves foraneas.
		$this->dropTable('{{language}}');
		$this->dropTable('{{auth_assignment}}');
		$this->dropTable('{{auth_item_child}}');
		$this->dropTable('{{auth_item}}');
		$this->dropTable('{{member_profile}}');
		$this->dropTable('{{members}}');
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