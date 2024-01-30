<?php

class m240129_215321_foreignkey extends CDbMigration
{
	public function up()
	{
		$this->addColumn('ses_Pqr','nombreId','int');
		$this->addForeignKey('FK_ses_nombre','ses_Pqr','nombreId','ses_User','id');
	}

	public function down()
	{
		echo "m240129_215321_foreignkey does not support migration down.\n";
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