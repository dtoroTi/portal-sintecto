<?php

class m230515_131610_camporecaudo extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_Customer", "isRecover", "tinyint(1) DEFAULT 0");
	}

	public function down()
	{
		//echo "m230515_131610_camporecaudo does not support migration down.\n";
		//return false;
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