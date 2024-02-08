<?php

class m240208_210446_TablaServiceProvided extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_ServiceProvided', array(
			'id'=>'pk',
			'name'=>'varchar(255)'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		echo "m240208_210446_TablaServiceProvided does not support migration down.\n";
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