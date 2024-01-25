<?php

class m230329_213638_campoHourExpress extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_CustomerProduct", "hourExpress", "int DEFAULT 0");
	}

	public function down()
	{
		$this->dropColumn('ses_CustomerProduct', 'hourExpress');
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