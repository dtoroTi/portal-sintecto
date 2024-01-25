<?php

class m220823_143934_pdfcerticate extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_PdfReportType", "islogSintecto", "tinyint(1) DEFAULT 0");
	}

	public function down()
	{
		$this->dropColumn("ses_PdfReportType", "islogSintecto");
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