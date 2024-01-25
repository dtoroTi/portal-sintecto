<?php

class m220907_134322_calledUserList extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_CandidateCalls', array(
			'id'=>'pk',
			'backgroundcheckId'=>'int',
			'callManagerId'=>'int',
			'callReschedulingManagerId'=>'int',
			'dateCreate'=>'datetime',
			'dateRegistrationEffective'=>'datetime',
			'dateRegistrationNotEffective'=>'datetime',
			'observation'=>'text',
			'confirmationVisitId'=>'int',
			'typeVisit'=>'varchar(50)',
			'authorizationFormat'=>'varchar(50)',
			'responsibleVisitId'=>'int',		
			'visitProgramdate'=>'datetime',
			'location'=>'varchar(150)',
			'referenceAddress'=>'varchar(150)',
			'neighborhood'=>'varchar(150)',
			'availability'=>'varchar(150)',
			'availabilitydate'=>'datetime',
			'statusVisit'=>'varchar(50)',
			'formVisit'=>'varchar(50)',
			'typeEvent'=>'varchar(50)'

		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->addForeignKey('FK_ses_CandidateCalls_backgroundcheckId_ses_BackgroundCheck_id','ses_CandidateCalls','backgroundcheckId','ses_BackgroundCheck','id'); 
		$this->addForeignKey('FK_ses_CandidateCalls_callManagerId_ses_User_id1','ses_CandidateCalls','callManagerId','ses_User','id'); 
		$this->addForeignKey('FK_ses_CandidateCalls_responsibleVisitId_ses_User_id2','ses_CandidateCalls','responsibleVisitId','ses_User','id');
		$this->addForeignKey('FK_ses_CandidateCalls_confirmationVisitId_ses_User_id3','ses_CandidateCalls','confirmationVisitId','ses_User','id');
		$this->addForeignKey('FK_ses_CandidateCalls_callReschedulingManagerId_ses_User_id4','ses_CandidateCalls','callReschedulingManagerId','ses_User','id');
	}

	public function down()
	{
		$this->dropTable('ses_CandidateCalls');
		return true;
	}
}