<?php

class m230810_134846_tablalistaLaboral extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_JobCompany', array(
			'id'=>'pk',
			'name'=>'varchar(255)',
			'phone'=>'varchar(45)',
			'city'=>'varchar(255)',
			'country'=>'varchar(128)',
			'email'=>'varchar(64)',
			'contact'=>'varchar(128)',
			'dateCreated'=>'date'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

	}

	public function down()
	{
		$this->dropTable('ses_JobCompany');
		return true;
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
//coment