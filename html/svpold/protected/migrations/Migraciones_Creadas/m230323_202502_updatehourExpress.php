<?php

class m230323_202502_updatehourExpress extends CDbMigration
{
	public function up()
	{
		//Yii::import('application.models.*');
		/*
		$model = BackgroundCheck::model()->findByAttributes(['id'=>'303852']);
		$model->studyLimitOn="CONCAT(DATE($model->studyLimitOn), ' 20:59:59')";
		$model->execute();*/

		/*$query_A = "UPDATE ses_BackgroundCheck bck SET bck.studyStartedOn=CONCAT(DATE(bck.studyStartedOn),' 00:00:00')";
		$this->execute($query_A);*/

		$query_A = "UPDATE ses_BackgroundCheck bck SET bck.studyLimitOn=CONCAT(DATE(bck.studyLimitOn),' 23:59:59'), bck.dateLimitQuality=CONCAT(DATE(bck.dateLimitQuality),' 23:59:59')";
		$this->execute($query_A);
	}

	public function down()
	{
		//echo "m230321_190535_updatehourExpress does not support migration down.\n";
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