<?php

/**
 * This is the model class for table "{{VerifiedRecords}}".
 *
 * The followings are the available columns in table '{{VerifiedRecords}}':
 * @property integer $id
 * @property string $user
 * @property string $hashrecord
 * @property string $hashperson
 * @property string $fecha_reg
 */
class VerifiedRecords extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{VerifiedRecords}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numerical', 'integerOnly'=>true),
			array('hashrecord, hashperson', 'user', 'length', 'max'=>100),
			array('fecha_reg', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user, hashrecord, hashperson, fecha_reg', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user' => 'Usuario',
			'hashrecord' => 'Hashrecord',
			'hashperson' => 'Hashperson',
			'fecha_reg' => 'Fecha Reg',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user',$this->user);
		$criteria->compare('hashrecord',$this->hashrecord,true);
		$criteria->compare('hashperson',$this->hashperson,true);
		$criteria->compare('fecha_reg',$this->fecha_reg,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VerifiedRecords the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
