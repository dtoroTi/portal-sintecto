<?php

class m220608_213332_camposcalidadcumpli extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_BackgroundCheck", "qualityShareholder", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualitytextShareholder", "varchar(255)");
		$this->addColumn("ses_BackgroundCheck", "qualityShareholderPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityShareholderPNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityCustomer", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualitytextCustomer", "varchar(255)");
		$this->addColumn("ses_BackgroundCheck", "qualityCustomerPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityCustomerPNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityProvider", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualitytextProvider", "varchar(255)");
		$this->addColumn("ses_BackgroundCheck", "qualityProviderPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityProviderPNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityFinance", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualitytextFinance", "varchar(255)");
		$this->addColumn("ses_BackgroundCheck", "qualityFinancePQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityFinancePNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityFinantialAnalys", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualitytextFinantialAnalys", "varchar(255)");
		$this->addColumn("ses_BackgroundCheck", "qualityFinantialAnalysPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityFinantialAnalysPNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityCompanyVisit", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualitytextCompanyVisit", "varchar(255)");
		$this->addColumn("ses_BackgroundCheck", "qualityCompanyVisitPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityCompanyVisitPNC", "tinyint(1) DEFAULT 0");

	}

	public function down()
	{

		$this->dropColumn("ses_BackgroundCheck", "qualityShareholder");
		$this->dropColumn("ses_BackgroundCheck", "qualitytextShareholder");
		$this->dropColumn("ses_BackgroundCheck", "qualityShareholderPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityShareholderPNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityCustomer");
		$this->dropColumn("ses_BackgroundCheck", "qualitytextCustomer");
		$this->dropColumn("ses_BackgroundCheck", "qualityCustomerPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityCustomerPNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityProvider");
		$this->dropColumn("ses_BackgroundCheck", "qualitytextProvider");
		$this->dropColumn("ses_BackgroundCheck", "qualityProviderPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityProviderPNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityFinance");
		$this->dropColumn("ses_BackgroundCheck", "qualitytextFinance");
		$this->dropColumn("ses_BackgroundCheck", "qualityFinancePQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityFinancePNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityFinantialAnalys");
		$this->dropColumn("ses_BackgroundCheck", "qualitytextFinantialAnalys");
		$this->dropColumn("ses_BackgroundCheck", "qualityFinantialAnalysPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityFinantialAnalysPNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityCompanyVisit");
		$this->dropColumn("ses_BackgroundCheck", "qualitytextCompanyVisit");
		$this->dropColumn("ses_BackgroundCheck", "qualityCompanyVisitPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityCompanyVisitPNC");
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