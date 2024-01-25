<?php

class m220119_170749_tus_datos extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_TusDatosResponse", "tusdatosRequestTime", "datetime");
		$this->createIndex('ses_TusDatosResponse_status','ses_TusDatosResponse',array('status'));
		$this->createIndex('ses_TusDatosResponse_created','ses_TusDatosResponse',array('created'));
		$this->createIndex('ses_TusDatosResponse_tusdatosRequestTime','ses_TusDatosResponse',array('tusdatosRequestTime'));
	}

	public function down()
	{
		$this->dropIndex('ses_TusDatosResponse_status', 'ses_TusDatosResponse');
		$this->dropIndex('ses_TusDatosResponse_created', 'ses_TusDatosResponse');
		$this->dropIndex('ses_TusDatosResponse_tusdatosRequestTime', 'ses_TusDatosResponse');
		$this->dropColumn('ses_TusDatosResponse', 'tusdatosRequestTime');
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