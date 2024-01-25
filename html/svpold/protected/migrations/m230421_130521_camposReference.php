<?php

class m230421_130521_camposReference extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_BackgroundCheck", "qualityReference", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualitytextReference", "varchar(255)");
		$this->addColumn("ses_BackgroundCheck", "qualityReferencePQR", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_BackgroundCheck", "qualityReferencePNC", "tinyint(1) DEFAULT 0");

	}

	public function down()
	{

		$this->dropColumn("ses_BackgroundCheck", "qualityReference");
		$this->dropColumn("ses_BackgroundCheck", "qualitytextReference");
		$this->dropColumn("ses_BackgroundCheck", "qualityReferencePQR");
		$this->dropColumn("ses_BackgroundCheck", "qualityReferencePNC");
		return true;
	}
}