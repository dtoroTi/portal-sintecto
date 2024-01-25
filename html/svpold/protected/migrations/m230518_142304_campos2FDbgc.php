<?php

class m230518_142304_campos2FDbgc extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_BackgroundCheck", "reciptFileooid", "varchar(100)");
		$this->addColumn("ses_BackgroundCheck", "reciptExpiration", "datetime");
		$this->addColumn("ses_BackgroundCheck", "reciptFileStatus", "tinyint(1) DEFAULT 0");
	}

	public function down()
	{
		$this->dropColumn('ses_BackgroundCheck', 'reciptFileooid');
		$this->dropColumn('ses_BackgroundCheck', 'reciptExpiration');
		$this->dropColumn('ses_BackgroundCheck', 'reciptFileStatus');
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