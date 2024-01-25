<?php

class m220325_203201_tablaAttachmentFile extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_AttachmentFile', array(
			'id'=>'pk',
			'name_doc'=>'varchar(255)',
			'fileName'=>'varchar(255)',
			'fileName1'=>'varchar(255)',
			'fileName2'=>'varchar(255)',
			'fileName3'=>'varchar(255)',
			'fileName4'=>'varchar(255)',
			'questionnaire'=>'text'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		//FK se envia el nombre de la tabla destino con el campo y el de la tabla origen con el campo PK
		/*$this->addColumn('ses_AttachmentFile','backgroundcheckId','int');
		$this->addForeignKey('FK_ses_AttachmentFile_backgroundcheckId_ses_BackgroundCheck_id','ses_AttachmentFile','backgroundcheckId','ses_BackgroundCheck','id'); */
	}

	public function down()
	{
		/*$this->dropForeignKey('FK_ses_AttachmentFile_backgroundcheckId_ses_BackgroundCheck_id','ses_AttachmentFile','backgroundcheckId','ses_BackgroundCheck','id');*/
		$this->dropTable('ses_AttachmentFile');
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