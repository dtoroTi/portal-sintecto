<?php

class m220222_144426_bgc_campos extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_BackgroundCheck", "qualityGesDocument", "tinyint");
		$this->addColumn("ses_BackgroundCheck", "qualityTextGesDocument", "varchar(255)");
		$this->addColumn("ses_BackgroundCheck", "qualityReturn", "varchar(255)");
		$this->addColumn("ses_BackgroundCheck", "qualityReturnPer", "varchar(255)");

	}

	public function down()
	{
		$this->dropColumn('ses_BackgroundCheck', 'qualityGesDocument');
		$this->dropColumn('ses_BackgroundCheck', 'qualityTextGesDocument');
		$this->dropColumn('ses_BackgroundCheck', 'qualityReturn');
		$this->dropColumn('ses_BackgroundCheck', 'qualityReturnPer');
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