<?php

class m231006_165045_Tableagreements extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_Agreements', array(
			'id'=>'pk',
			'title'=>'varchar(250)',
			'agreementsText'=>'text',
			'created'=>'datetime',
			'modified'=>'datetime'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('ses_Agreements');
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