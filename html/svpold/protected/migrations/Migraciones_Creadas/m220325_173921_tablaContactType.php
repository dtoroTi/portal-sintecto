<?php

class m220325_173921_tablaContactType extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_ContactType', array(
			'id'=>'pk',
			'Type'=>'varchar(50)'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

	}

	public function down()
	{
		$this->dropTable('ses_ContactType');
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