<?php

class m230718_152500_campoGrupo extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_CustomerGroup", "alertGroupDoc", "tinyint(1) DEFAULT 0");
	}

	public function down()
	{
		$this->dropColumn('ses_CustomerGroup', 'alertGroupDoc');
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