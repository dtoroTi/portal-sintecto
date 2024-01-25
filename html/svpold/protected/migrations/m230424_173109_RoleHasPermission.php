<?php

class m230424_173109_RoleHasPermission extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_RoleHasPermission', array(
			'id'=>'pk',
			'roleId'=>'int',
			'permissionId'=>'int'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		//FK se envia el nombre de la tabla destino con el campo y el de la tabla origen con el campo PK
		$this->addForeignKey('FK_ses_RoleHasPermission_roleId_ses_Role_id','ses_RoleHasPermission','roleId','ses_Role','id'); 
		$this->addForeignKey('FK_ses_RoleHasPermission_permissionId_ses_Permission_id','ses_RoleHasPermission','permissionId','ses_Permission','id'); 
	}

	public function down()
	{
		$this->dropForeignKey('FK_ses_RoleHasPermission_roleId_ses_Role_id','ses_RoleHasPermission','roleId','ses_Role','id');
		$this->dropForeignKey('FK_ses_RoleHasPermission_permissionId_ses_Permission_id','ses_RoleHasPermission','permissionId','ses_Permission','id');
		$this->dropTable('ses_RoleHasPermission');
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