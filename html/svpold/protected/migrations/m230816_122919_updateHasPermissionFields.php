<?php

class m230816_122919_updateHasPermissionFields extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->dropForeignKey('FK_ses_RoleHasPermission_roleId_ses_Role_id', 'ses_RoleHasPermission');
		$this->alterColumn('ses_RoleHasPermission', 'roleId', 'INT(10) NOT NULL');
		$this->addForeignKey('FK_ses_RoleHasPermission_roleId_ses_Role_id', 'ses_RoleHasPermission', 'roleId', 'ses_Role', 'id');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_ses_RoleHasPermission_roleId_ses_Role_id', 'ses_RoleHasPermission');
		$this->alterColumn('ses_RoleHasPermission', 'roleId', 'INT(10) NULL DEFAULT NULL');
		$this->addForeignKey('FK_ses_RoleHasPermission_roleId_ses_Role_id', 'ses_RoleHasPermission', 'roleId', 'ses_Role', 'id');
	}

}
//comment