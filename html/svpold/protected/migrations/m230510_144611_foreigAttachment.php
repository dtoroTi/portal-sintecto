<?php

class m230510_144611_foreigAttachment extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_AttachmentFile", "idFDJson", "int");

		$this->addForeignKey('FK_ses_AttachmentFile_idFDJson_ses_DynamicFormJSON_id','ses_AttachmentFile','idFDJson','ses_DynamicFormJSON','id'); 
	}

	public function down()
	{
		echo "m230510_144611_foreigAttachment does not support migration down.\n";
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