<?php

class m230817_213425_updateUserhasRole2 extends CDbMigration
{
	public function safeUp()
	{
		$this->dropForeignKey('FK_ses_UserHasRole_userId_ses_User_id', 'ses_UserHasRole');
		$this->alterColumn('ses_UserHasRole', 'userId', 'INT(10) NOT NULL');
		$this->addForeignKey('FK_ses_UserHasRole_userId_ses_User_id', 'ses_UserHasRole', 'userId', 'ses_User', 'id');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_ses_UserHasRole_userId_ses_User_id', 'ses_UserHasRole');
		$this->alterColumn('ses_UserHasRole', 'userId', 'INT(10) NOT NULL');
		$this->addForeignKey('FK_ses_UserHasRole_userId_ses_User_id', 'ses_UserHasRole', 'userId', 'ses_User', 'id');
	}
}
//comment