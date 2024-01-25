<?php

/**
 * This is the model class for table "{{Result}}".
 *
 * The followings are the available columns in table '{{Result}}':
 * @property integer $id
 * @property string $name
 * @property string $nick
 */
class Result extends CActiveRecord
{
  
    const PENDING = 1;
    const FAVORABLE = 2;
    const NO_FAVORABLE = 3;
    const TO_BE_REVIEWED = 4;
    const NO_RESULT = 5;
    const NOT_FINISHED = 6;
    const NOT_FINISHED_FAVORABLE = 7;
    const DESFAVORABLE = 9;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Result the static model class
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
		return '{{Result}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, nick', 'required'),
			array('name, nick', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, nick', 'safe', 'on'=>'search'),
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
			'name' => 'Resultado',
			'nick' => 'Res.',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('nick',$this->nick,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  
  public function isPending(){
    return $this->id==Result::PENDING;
  }
  
}