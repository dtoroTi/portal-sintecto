<?php

class m230725_140824_TablaTempoIG extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_TempDaysInfG', array(
			'id'=>'pk',
			'idCustomerGroup'=>'int',
			'typeProduct'=>'varchar(255)',
			'code'=>'varchar(12)',
			'deliveredToCustomerOn'=>'datetime',
			'studyStartedOn'=>'datetime',
			'daysStudy'=>'int'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

	}

	public function down()
	{
		$this->dropTable('ses_TempDaysInfG');
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