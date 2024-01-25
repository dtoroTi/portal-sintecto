<?php

class m220325_174630_tablaContact extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_Contact', array(
			'id'=>'pk',
			'backgroundCheckId'=>'int',
			'comments'=>'text',
			'statusContact'=>'varchar(50)',
			'contactType'=>'int',
			'created'=>'datetime',
			'modified'=>'datetime',
			'transactionId'=>'varchar(150)'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		//FK se envia el nombre de la tabla destino con el campo y el de la tabla origen con el campo PK
		$this->addForeignKey('FK_ses_Contact_backgroundcheckId_ses_BackgroundCheck_id','ses_Contact','backgroundcheckId','ses_BackgroundCheck','id'); 
		$this->addForeignKey('FK_ses_Contact_contactType_ses_ContactType_id','ses_Contact','contactType','ses_ContactType','id'); 
	}


	public function down()
	{
		$this->dropForeignKey('FK_ses_Contact_contactType_ses_ContactType_id','ses_Contact','contactType','ses_ContactType','id');
		$this->dropForeignKey('FK_ses_Contact_backgroundcheckId_ses_BackgroundCheck_id','ses_Contact','backgroundcheckId','ses_BackgroundCheck','id');
		$this->dropTable('ses_Contact');
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