<?php

class m230518_142757_campoattachmentProduct extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_CustomerProduct", "attachmentFileId2", "int");
		$this->addForeignKey('FK_ses_CustomerProduct_attachmentFileId2_ses_AttachmentFile_id','ses_CustomerProduct','attachmentFileId2','ses_AttachmentFile','id'); 
	}

	public function down()
	{
		$this->dropColumn('ses_CustomerProduct', 'attachmentFileId2');
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