<?php

class m230907_132327_fieldsInvoice extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_InvoiceVisitDetail", "isApprovedOP", "tinyint(1) DEFAULT null");
		$this->addColumn("ses_InvoiceVisitDetail", "ApprovedOPId", "int");
		$this->addColumn("ses_InvoiceVisitDetail", "DateApprovedOP", "datetime");
		$this->addForeignKey('FK_ses_InvoiceVisitDetail_ApprovedOPId_ses_User_id', 'ses_InvoiceVisitDetail', 'ApprovedOPId', 'ses_User', 'id');
	}

	public function down()
	{
		$this->dropForeignKey('FK_ses_InvoiceVisitDetail_ApprovedOPId_ses_User_id', 'ses_InvoiceVisitDetail');
		$this->dropColumn('ses_InvoiceVisitDetail', 'isApprovedOP');
		$this->dropColumn('ses_InvoiceVisitDetail', 'ApprovedOPId');
		$this->dropColumn('ses_InvoiceVisitDetail', 'DateApprovedOP');
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