<?php

class m230817_213227_updateUserhasRole extends CDbMigration
{
	public function safeUp()
	{
		$this->dropForeignKey('FK_ses_UserHasRole_roleId_ses_Role_id', 'ses_UserHasRole');
		$this->alterColumn('ses_UserHasRole', 'roleId', 'INT(10) NOT NULL');
		$this->addForeignKey('FK_ses_UserHasRole_roleId_ses_Role_id', 'ses_UserHasRole', 'roleId', 'ses_Role', 'id');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_ses_UserHasRole_roleId_ses_Role_id', 'ses_UserHasRole');
		$this->alterColumn('ses_UserHasRole', 'roleId', 'INT(10) NOT NULL');
		$this->addForeignKey('FK_ses_UserHasRole_roleId_ses_Role_id', 'ses_UserHasRole', 'roleId', 'ses_Role', 'id');
	}
}
//comment