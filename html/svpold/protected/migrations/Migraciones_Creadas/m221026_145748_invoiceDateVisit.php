<?php

class m221026_145748_invoiceDateVisit extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_VisitInvoiceDate', array(
			'id'=>'pk',
			'invoiceClosingDay'=>'int',
			'invoiceDay'=>'int',
			'paymentTerms'=>'varchar(30)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('ses_VisitInvoiceDate');
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