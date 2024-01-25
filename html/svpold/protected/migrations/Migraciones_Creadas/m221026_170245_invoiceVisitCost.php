<?php

class m221026_170245_invoiceVisitCost extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_InvoiceVisitCost', array(
			'id'=>'pk',
			'businessLine'=>'varchar(50)',
			'descriptionCost'=>'varchar(150)',
			'totalVisitCost'=>'decimal(10,0)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('ses_InvoiceVisitCost');
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