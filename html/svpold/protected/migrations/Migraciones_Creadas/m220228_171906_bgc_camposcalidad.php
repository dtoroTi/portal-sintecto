<?php

class m220228_171906_bgc_camposcalidad extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_BackgroundCheck", "qualityLaboralPNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityLaboralPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityEducationPNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityEducationPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityFinanlcialPNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityFinanlcialPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityAdversePNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityAdversePQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityVisitPNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityVisitPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityPolygraphPNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityPolygraphPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityTestPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityTestPNC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityGesDocumentPQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityGesDocumentPNC", "tinyint(1) DEFAULT 0");
	}

	public function down()
	{
		$this->dropColumn("ses_BackgroundCheck", "qualityLaboralPNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityLaboralPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityEducationPNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityEducationPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityFinanlcialPNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityFinanlcialPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityAdversePNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityAdversePQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityVisitPNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityVisitPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityPolygraphPNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityPolygraphPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityTestPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityTestPNC");
		$this->dropColumn("ses_BackgroundCheck", "qualityGesDocumentPQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityGesDocumentPNC");
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