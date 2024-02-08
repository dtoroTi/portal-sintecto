<?php

class m240206_204909_campoContactChargeDetailEducation extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_DetailEducation", "contactCharge", "varchar(255)");
	}

	public function down()
	{
		echo "m240206_204909_campoContactChargeDetailEducation does not support migration down.\n";
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