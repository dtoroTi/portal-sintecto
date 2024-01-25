<?php

class m221026_200356_camposproduct2 extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_CustomerProduct", "costVisitId", "int");
		$this->addForeignKey('FK_ses_CustomerProduct_costVisitId_ses_InvoiceVisitCost_id','ses_CustomerProduct','costVisitId','ses_InvoiceVisitCost','id'); 
	}

	public function down()
	{
		$this->dropColumn('ses_CustomerProduct', 'costVisitId');
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