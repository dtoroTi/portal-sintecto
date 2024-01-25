<?php

class m220304_205946_tablacalidad extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_QualityPorc', array(
			'id'=>'pk',
			'valueSection'=>'double',
			'valuePQR'=>'double',
			'valuePNC'=>'double'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('ses_QualityPorc');
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