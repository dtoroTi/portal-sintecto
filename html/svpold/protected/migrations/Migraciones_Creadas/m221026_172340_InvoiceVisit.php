<?php

class m221026_172340_InvoiceVisit extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_InvoiceVisit', array(
			'id'=>'pk',
			'from'=>'datetime',
			'until'=>'datetime',
			'created'=>'datetime',
			'visitId'=>'int',
			'numberStudies'=>'int',
			'totalValueStudies'=>'decimal(10,0)',
			'statusInvoice'=>'tinyint(1) DEFAULT 0',
			'description'=>'text',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->addForeignKey('FK_ses_InvoiceVisit_visitId_ses_User_id','ses_InvoiceVisit','visitId','ses_User','id'); 
	}

	public function down()
	{
		$this->dropTable('ses_InvoiceVisit');
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