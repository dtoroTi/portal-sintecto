<?php

class m240129_213448_foreignkey extends CDbMigration
{
	public function up()
	{
		$this->addColumn('ses_Pqr','tipoReclamoId','int');
		$this->addForeignKey('FK_ses_tipoReclamo','ses_Pqr','tipoReclamoId','ses_TipoPqr','id');
	}

	public function down()
	{
		echo "m240129_213448_foreignkey does not support migration down.\n";
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