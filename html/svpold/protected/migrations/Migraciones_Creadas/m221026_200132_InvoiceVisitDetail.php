<?php

class m221026_200132_InvoiceVisitDetail2 extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_InvoiceVisitDetail', array(
			'id'=>'pk',
			'invoiceVisitId'=>'int',
			'backgroundId'=>'int',
			'productId'=>'int',
			'costVisitId'=>'int',
			'description'=>'text',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->addForeignKey('FK_ses_InvoiceVisitDetail_invoiceVisitId_ses_InvoiceVisit_id','ses_InvoiceVisitDetail','invoiceVisitId','ses_InvoiceVisit','id'); 
		$this->addForeignKey('FK_ses_InvoiceVisitDetail_backgroundId_ses_BackgroundCheck_id','ses_InvoiceVisitDetail','backgroundId','ses_BackgroundCheck','id'); 
		$this->addForeignKey('FK_ses_InvoiceVisitDetail_productId_ses_CustomerProduct_id','ses_InvoiceVisitDetail','productId','ses_CustomerProduct','id'); 
		$this->addForeignKey('FK_ses_InvoiceVisitDetail_costVisitId_ses_InvoiceVisitCost_id','ses_InvoiceVisitDetail','costVisitId','ses_InvoiceVisitCost','id'); 
	}

	public function down()
	{
		$this->dropTable('ses_InvoiceVisitDetail');
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