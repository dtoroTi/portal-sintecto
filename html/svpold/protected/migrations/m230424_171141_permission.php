<?php

class m230424_171141_permission extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_Permission', array(
			'id'=>'pk',
			'controller'=>'varchar(50) NOT NULL',
			'action'=>'varchar(50) NOT NULL',
			'permission'=>'varchar(50)',
			'description'=>'text'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->createIndex('ses_Permission_controller_action_permission','ses_Permission',['controller','action','permission'], true);
	}

	public function down()
	{
		$this->dropIndex('ses_Permission_controller_action_permission', 'ses_Permission');
		$this->dropTable('ses_Permission');
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
//comment