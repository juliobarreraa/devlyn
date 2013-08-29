<?php

class m130827_212545_dinamics extends CDbMigration
{
	public function up()
	{
		/**
		 * Crea la tabla de dinámicas que permite almacenar las dinámicas del sitio
		 * acompañadas de diversas tablas para almacenar la media, el contenido, instrucciones
		 * galería e ingreso respuesta.
		 */
        $this->createTable('{{dynamics}}', array(
			'id' =>  'pk',
		  	'title' =>  'varchar(255) NOT NULL',
		  	'content' =>  'text NOT NULL',
		  	'instructions_content' => "text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL",
		  	'answer' => 'text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL',
		  	'enabled_at' => 'int(10) unsigned DEFAULT NULL',
		  	'updated_at' =>  'int(10) unsigned DEFAULT NULL',
		  	'created_at' =>  'int(10) unsigned NOT NULL'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=latin1' );

        /**
         * Colección de media 
         * 	+ SWF
         * 	+ JPEG
         * 	+ BMP
         * 	+ GIF
         * 	+ PNG
         */
        $this->createTable('{{resources}}', array(
			'id' =>  'pk',
		  	'name' =>  'varchar(100) NOT NULL',
		  	'updated_at' =>  'int(10) unsigned DEFAULT NULL',
		  	'created_at' =>  'int(10) unsigned NOT NULL'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=latin1' );

        /**
         * Tabla que crea el conjunto de recursos disponibles para la sección de galerías
         * se relaciona con una dinámica en particular la cual decidirá que elementos se
         * muestran en pantalla, el recurso de relación con esta tabla es un elemento media
         * (veasé descripción media permitidos)
         */
        $this->createTable('{{galleries_dynamic}}', array(
        	'id' => 'pk',
        	'dynamic_id' => 'INT(10) NOT NULL',
        	'resource_id' => 'INT(10) NOT NULL',
		  	'updated_at' =>  'int(10) unsigned DEFAULT NULL',
		  	'created_at' =>  'int(10) unsigned NOT NULL'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=latin1');

		$this->addForeignKey('{{galleries_dynamic_ibfk_1}}', '{{galleries_dynamic}}', 'dynamic_id', '{{dynamics}}', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('{{galleries_dynamic_ibfk_2}}', '{{galleries_dynamic}}', 'resource_id', '{{resources}}', 'id', 'CASCADE', 'CASCADE');

        /**
         * Conjunto de artículos para la sección ingresar respuesta
         * relacionados con una dinámica, los artículos se muestran en base
         * al identificador de alta en forma progresiva.
         */
        $this->createTable('{{articles_dynamic}}', array(
        	'id' => 'pk',
        	'dynamic_id' => 'INT(10) NOT NULL',
        	'title' => 'VARCHAR(255) NOT NULL',
        	'content' => 'TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL',
		  	'updated_at' =>  'int(10) unsigned DEFAULT NULL',
		  	'created_at' =>  'int(10) unsigned NOT NULL'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=latin1');

        $this->addForeignKey('{{articles_dynamic_ibfk_1}}', '{{articles_dynamic}}', 'dynamic_id', '{{dynamics}}', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		$this->dropTable('{{articles_dynamic}}');
		$this->dropTable('{{galleries_dynamic}}');
		$this->dropTable('{{resources}}');
		$this->dropTable('{{dynamics}}');
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