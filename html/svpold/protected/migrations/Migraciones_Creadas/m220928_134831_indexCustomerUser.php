<?php

class m220928_134831_indexCustomerUser extends CDbMigration
{
	/*public function up()
	{
		$this->createIndex('ses_CustomerUser_username','ses_CustomerUser',['username']);
	}

	public function down()
	{
		$this->dropIndex('ses_CustomerUser_username', 'ses_CustomerUser');
		return true;
	}*/

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->createIndex('ses_CustomerUser_username','ses_CustomerUser',['username'], true);
	}

	public function safeDown()
	{
		$this->dropIndex('ses_CustomerUser_username', 'ses_CustomerUser');
		return true;
	}
}