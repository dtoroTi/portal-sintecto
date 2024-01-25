<?php

class m230523_150706_campoRecaudiBg extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_BackgroundCheck", "startStudy", "tinyint(1) DEFAULT 0");
	}

	public function down()
	{
		$this->dropColumn('ses_BackgroundCheck', 'startStudy');
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