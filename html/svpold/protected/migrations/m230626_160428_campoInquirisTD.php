<?php

class m230626_160428_campoInquirisTD extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_InquiriesTDT", "dateExpirationDoc", "date DEFAULT NULL");
	}

	public function down()
	{
		$this->dropColumn('ses_InquiriesTDT', 'dateExpirationDoc');
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