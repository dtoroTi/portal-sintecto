<?php

class m230424_161559_role extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_Role', array(
			'id'=>'pk',
			'name'=>'varchar(50) NOT NULL'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->createIndex('ses_Role_name','ses_Role',['name'], true);
	}

	public function down()
	{
		$this->dropIndex('ses_Role_name', 'ses_Role');
		$this->dropTable('ses_Role');
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