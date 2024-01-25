<?php

class m230816_124352_updateHasPermissionFields2 extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->dropForeignKey('FK_ses_RoleHasPermission_permissionId_ses_Permission_id', 'ses_RoleHasPermission');
		$this->alterColumn('ses_RoleHasPermission', 'permissionId', 'INT(10) NOT NULL');
		$this->addForeignKey('FK_ses_RoleHasPermission_permissionId_ses_Permission_id', 'ses_RoleHasPermission', 'permissionId', 'ses_Permission', 'id');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_ses_RoleHasPermission_permissionId_ses_Permission_id', 'ses_RoleHasPermission');
		$this->alterColumn('ses_RoleHasPermission', 'permissionId', 'INT(10) NULL DEFAULT NULL');
		$this->addForeignKey('FK_ses_RoleHasPermission_permissionId_ses_Permission_id', 'ses_RoleHasPermission', 'permissionId', 'ses_Permission', 'id');
	}

}
//comment