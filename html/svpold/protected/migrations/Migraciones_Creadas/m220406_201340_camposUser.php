<?php

class m220406_201340_camposUser extends CDbMigration
{
	public function up()
	{
		$this->addColumn("ses_User", "goal", "int(10)");
		$this->addColumn("ses_User", "area", "int(10)");
	}

	public function down()
	{
		$this->dropColumn('ses_User', 'goal');
		$this->dropColumn('ses_User', 'area');
		return true;
	}

}