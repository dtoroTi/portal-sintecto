<?php

class m221026_180054_camposbackground extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_BackgroundCheck", "typeVisit", "varchar(50)");
		$this->addColumn("ses_BackgroundCheck", "addValueVisit", "decimal(10,0)");
	}

	public function down()
	{
		$this->dropColumn('ses_BackgroundCheck', 'typeVisit');
		$this->dropColumn('ses_BackgroundCheck', 'addValueVisit');
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