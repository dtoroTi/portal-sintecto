<?php

class m220803_214536_requestsSAC extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_RequestsSAC', array(
			'id'=>'pk',
			'backgroundcheckId'=>'int',
			'userId'=>'int',
			'typeRequest'=>'varchar(50)',
			'dateRequest'=>'datetime',
			'dateAnswer'=>'datetime',
			'deliveryDays'=>'int',
			'shockedby'=>'varchar(50)',
			'status'=>'varchar(50)',
			'observation'=>'text'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->addForeignKey('FK_ses_RequestsSAC_backgroundcheckId_ses_BackgroundCheck_id','ses_RequestsSAC','backgroundcheckId','ses_BackgroundCheck','id'); 
		$this->addForeignKey('FK_ses_RequestsSAC_userId_ses_User_id','ses_RequestsSAC','userId','ses_User','id'); 
	}

	public function down()
	{
		$this->dropTable('ses_RequestsSAC');
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