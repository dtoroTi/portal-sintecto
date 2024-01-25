<?php

class m230810_134831_campofechaListaCont extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_EducationalInstitution", "dateCreated", "date DEFAULT NULL");
	}

	public function down()
	{
		$this->dropColumn('ses_EducationalInstitution', 'dateCreated');
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
//coment