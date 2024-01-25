<?php

class m220713_204457_tablaSurveyLink extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_SurveyLink', array(
			'id'=>'pk',
			'name'=>'varchar(150)',
			'link'=>'varchar(250)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('ses_SurveyLink');
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