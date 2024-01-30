<?php

class m240129_164112_TablaTipoPqr extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_TipoPqr', array(
			'id'=>'pk',
			'tipoReclamo'=>'int'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

	}

	public function down()
	{
		return false;
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