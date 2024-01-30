<?php

class m240126_173738_TablaPqr extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_Pqr', array(
			'id'=>'pk',
			'nombreId'=>'int(100)',
			'tipoReclamoId'=>'varchar(100)',
			'nota'=>'varchar(100)',
			'descripcion'=>'varchar(200)',
			'fechaReclamo'=>'datetime',
			'estadoReclamo'=>'varchar(100)',
			'fechaRespuesta'=>'datetime'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

	}

	public function down()
	{
		$this->dropTable('ses_Pqr');
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