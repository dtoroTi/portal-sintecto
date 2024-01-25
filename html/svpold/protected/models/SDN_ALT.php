<?php

/**
 * This is the model class for table "{{SDN_ALT}}".
 *
 * The followings are the available columns in table '{{SDN_ALT}}':
 * @property integer $entNum
 * @property integer $altNum
 * @property string $altType
 * @property string $altName
 * @property string $altRemarks
 *
 * The followings are the available model relations:
 * @property SDN $entNum0
 */
class SDN_ALT extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SDN_ALT the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{SDN_ALT}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('entNum', 'required'),
			array('entNum', 'numerical', 'integerOnly'=>true),
			array('altType', 'length', 'max'=>8),
			array('altName', 'length', 'max'=>350),
			array('altRemarks', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('entNum, altNum, altType, altName, altRemarks', 'safe', 'on'=>'search'),
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
			'entNum0' => array(self::BELONGS_TO, 'SDN', 'entNum'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'entNum' => 'Ent Num',
			'altNum' => 'Alt Num',
			'altType' => 'Alt Type',
			'altName' => 'Alt Name',
			'altRemarks' => 'Alt Remarks',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('entNum',$this->entNum);
		$criteria->compare('altNum',$this->altNum);
		$criteria->compare('altType',$this->altType,true);
		$criteria->compare('altName',$this->altName,true);
		$criteria->compare('altRemarks',$this->altRemarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}