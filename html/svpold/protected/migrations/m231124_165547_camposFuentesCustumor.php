<?php

class m231124_165547_camposFuentesCustumor extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_Customer", "isJepms", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isPolicia", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isProcuraduria", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isContaduria", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isRnmc", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isInpec", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isJuzgadostyba", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isSimit", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isLibretamilitar", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isInhabilidades", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isListaonu", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isOfac", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_Customer", "isInterpol", "tinyint(1) DEFAULT 0");
	}

	public function down()
	{

		$this->dropColumn('ses_Customer', 'isJepms');
		$this->dropColumn('ses_Customer', 'isPolicia');
		$this->dropColumn('ses_Customer', 'isProcuraduria');
		$this->dropColumn('ses_Customer', 'isContaduria');
		$this->dropColumn('ses_Customer', 'isRnmc');
		$this->dropColumn('ses_Customer', 'isInpec');
		$this->dropColumn('ses_Customer', 'isJuzgadostyba');
		$this->dropColumn('ses_Customer', 'isSimit');
		$this->dropColumn('ses_Customer', 'isLibretamilitar');
		$this->dropColumn('ses_Customer', 'isInhabilidades');
		$this->dropColumn('ses_Customer', 'isListaonu');
		$this->dropColumn('ses_Customer', 'isOfac');
		$this->dropColumn('ses_Customer', 'isInterpol');
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