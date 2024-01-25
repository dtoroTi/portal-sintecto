<?php

class m230510_132741_TabladynamicFormJSON extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_DynamicFormJSON', array(
			'id'=>'pk',
			'name'=>'varchar(50)',
			'questionnaireJSON'=>'text',
			'createdAt'=>'datetime'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('ses_DynamicFormJSON');
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