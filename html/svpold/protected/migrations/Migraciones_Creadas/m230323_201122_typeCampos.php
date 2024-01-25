<?php

class m230323_201122_typeCampos extends CDbMigration
{
	public function up()
	{
		$this->alterColumn("ses_BackgroundCheck", "studyStartedOn", "datetime");
		$this->alterColumn("ses_BackgroundCheck", "studyLimitOn", "datetime");
		$this->alterColumn("ses_BackgroundCheck", "dateLimitQuality", "datetime");
	}

	public function down()
	{
		//echo "m230323_194420_typeCampos does not support migration down.\n";
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