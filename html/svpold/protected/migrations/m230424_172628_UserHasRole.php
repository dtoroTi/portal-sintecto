<?php

class m230424_172628_UserHasRole extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_UserHasRole', array(
			'id'=>'pk',
			'userId'=>'int',
			'roleId'=>'int'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		//FK se envia el nombre de la tabla destino con el campo y el de la tabla origen con el campo PK
		$this->addForeignKey('FK_ses_UserHasRole_userId_ses_User_id','ses_UserHasRole','userId','ses_User','id'); 
		$this->addForeignKey('FK_ses_UserHasRole_roleId_ses_Role_id','ses_UserHasRole','roleId','ses_Role','id'); 
	}

	public function down()
	{
		$this->dropForeignKey('FK_ses_UserHasRole_userId_ses_User_id','ses_UserHasRole','userId','ses_User','id');
		$this->dropForeignKey('FK_ses_UserHasRole_roleId_ses_Role_id','ses_UserHasRole','roleId','ses_Role','id');
		$this->dropTable('ses_UserHasRole');
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