<?php

class m240208_203509_TablaListSuppliers extends CDbMigration
{
	public function up()
	{
		$this->createTable('ses_ListSuppliers', array(
			'id'=>'pk',
			'name'=>'varchar(255)',
			'typeDoc'=>'varchar(5)',
			'document'=>'varchar(255)',
			'phone'=>'varchar(255)',
			'email'=>'varchar(255)',
			'cityService'=>'varchar(255)',
			'address'=>'varchar(200)',
			'price'=>'decimal(10,0)'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		echo "m240208_203509_TablaListSuppliers does not support migration down.\n";
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