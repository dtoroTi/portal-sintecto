<?php

class m220211_165609_log_DynamicForm extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_LogDynamicForm', array(
			'id'=>'pk',
			'idDynamicForm'=>'int',
			'backgroundcheckId'=>'int',
			'ip'=>'varchar(50)',
			'detail'=>'text',
			'createdAt'=>'datetime'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->createIndex('Uq_ses_LogDynamicForm_idDynamicForm','ses_LogDynamicForm',array('idDynamicForm'),true);

		//FK se envia el nombre de la tabla destino con el campo y el de la tabla origen con el campo PK
		$this->addForeignKey('FK_ses_LogDynamicForm_backgroundcheckId_ses_BackgroundCheck_id','ses_LogDynamicForm','backgroundcheckId','ses_BackgroundCheck','id'); 
	}

	public function down()
	{
		$this->dropForeignKey('FK_ses_LogDynamicForm_backgroundcheckId_ses_BackgroundCheck_id','ses_LogDynamicForm','backgroundcheckId','ses_BackgroundCheck','id');
		$this->dropTable('ses_LogDynamicForm');
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