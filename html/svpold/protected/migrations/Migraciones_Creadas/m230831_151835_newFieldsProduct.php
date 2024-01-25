<?php

class m230831_151835_newFieldsProduct extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_CustomerProduct", "isTusDatos", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_CustomerProduct", "isWC", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_CustomerProduct", "isSico", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_CustomerProduct", "isRamaUnif", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_CustomerProduct", "isMediosAbrt", "tinyint(1) DEFAULT 0");
		$this->addColumn("ses_CustomerProduct", "isJurad", "tinyint(1) DEFAULT 0");
	}

	public function down()
	{

		$this->dropColumn('ses_CustomerProduct', 'isTusDatos');
		$this->dropColumn('ses_CustomerProduct', 'isWC');
		$this->dropColumn('ses_CustomerProduct', 'isSico');
		$this->dropColumn('ses_CustomerProduct', 'isRamaUnif');
		$this->dropColumn('ses_CustomerProduct', 'isMediosAbrt');
		$this->dropColumn('ses_CustomerProduct', 'isJurad');
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
//comment