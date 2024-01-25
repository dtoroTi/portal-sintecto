<?php

class m230126_144548_userSenior extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_UserSenior', array(
			'id'=>'pk',
			'userId'=>'int',
			'usernameSenior'=>'varchar(255)',
			'created'=>'datetime',
			'modified'=>'datetime',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->addForeignKey('FK_ses_UserSenior_userId_ses_User_id','ses_UserSenior','userId','ses_User','id'); 
	}

	public function down()
	{
		$this->dropTable('ses_UserSenior');
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