<?php

class m130827_212545_dinamics extends CDbMigration
{
	public function up()
	{
		//Tabla de dinámicas
        $this->createTable('{{dinamics}}', array(
			'id' =>  'int(11) NOT NULL AUTO_INCREMENT',
		  	'title' =>  'varchar(255) NOT NULL',
		  	'content' =>  'text NOT NULL',
		  	'image' =>  'varchar(255) NOT NULL',
		  	'updated_at' =>  'int(10) unsigned DEFAULT NULL',
		  	'created_at' =>  'int(10) unsigned NOT NULL',
			"PRIMARY KEY (id)",
        ), 'ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1' );
	}

	public function down()
	{
		echo "m130827_212545_dinamics does not support migration down.\n";
		return false;
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