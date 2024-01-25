<?php

class m230126_145622_SeniorAssignment extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_SeniorAssignment', array(
			'id'=>'pk',
			'userSeniorId'=>'int',
			'userAnalystId'=>'int',
			'created'=>'datetime',
			'modified'=>'datetime',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->addForeignKey('FK_ses_SeniorAssignment_userSeniorId_ses_UserSenior_id','ses_SeniorAssignment','userSeniorId','ses_UserSenior','id'); 
		$this->addForeignKey('FK_ses_SeniorAssignment_userAnalystId_ses_User_id','ses_SeniorAssignment','userAnalystId','ses_User','id'); 
	}

	public function down()
	{
		$this->dropTable('ses_SeniorAssignment');
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