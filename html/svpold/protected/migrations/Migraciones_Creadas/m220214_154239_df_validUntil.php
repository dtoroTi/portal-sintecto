<?php

class m220214_154239_df_validUntil extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_BackgroundCheck", "mobile", "varchar(20)");
		$this->addColumn("ses_BackgroundCheck", "ooidFD", "varchar(100)");
		$this->addColumn("ses_BackgroundCheck", "validuntilFD", "datetime");
		$this->addColumn("ses_BackgroundCheck", "statusFD", "tinyint(1) DEFAULT 0");
	}

	public function down()
	{
		$this->dropColumn('ses_BackgroundCheck', 'mobile');
		$this->dropColumn('ses_BackgroundCheck', 'ooidFD');
		$this->dropColumn('ses_BackgroundCheck', 'validuntilFD');
		$this->dropColumn('ses_BackgroundCheck', 'statusFD');
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