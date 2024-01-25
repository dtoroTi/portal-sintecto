<?php

class m230809_130059_ses_byroll extends CDbMigration
{
	/*public function up()
	{

	}

	public function down()
	{
		echo "m230809_130059_ses_byroll does not support migration down.\n";
		return false;
	}*/

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		Yii::import('application.models.*');
		
		$userType=new UserType();
		$userType->id=UserType::SES_BY_ROLL;
		$userType->name='Roles';
		return $userType->save();
	}

	public function safeDown()
	{
		Yii::import('application.models.*');

		UserType::model()->deleteByPk(UserType::SES_BY_ROLL);

	}
	
}
//comment