<?php

class m240206_143829_campoTypeDoc extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_DetailShareholder", "typeDoc", "varchar(5)");
	}

	public function down()
	{
		echo "m240206_143829_campoTypeDoc does not support migration down.\n";
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