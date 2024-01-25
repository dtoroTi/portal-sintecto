<?php

class m230411_202523_campoStandard extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_CustomerProduct", "isStandard", "tinyint(1) DEFAULT 0");
	}

	public function down()
	{
		//echo "m230411_202523_campoStandard does not support migration down.\n";
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