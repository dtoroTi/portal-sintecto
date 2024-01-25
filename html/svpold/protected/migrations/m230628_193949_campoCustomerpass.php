<?php

class m230628_193949_campoCustomerpass extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_Customer", "certificateKey", "tinyint(1) DEFAULT 1");
	}

	public function down()
	{
		$this->dropColumn('ses_Customer', 'certificateKey');
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