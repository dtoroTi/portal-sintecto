<?php

/**
 * This is the model class for table "{{ImageSize}}".
 *
 * The followings are the available columns in table '{{ImageSize}}':
 * @property integer $id
 * @property string $name
 * @property integer $maxWidth
 * @property integer $maxHeight
 *
 * The followings are the available model relations:
 * @property Document[] $documents
 */
class ImageSize extends CActiveRecord
{
  
  const FRONT_PAGE = 1;
  const IMG_3_X_PAGE = 2;
  const IMG_1_X_PAGE = 3;
  const IMG_4_X_PAGE = 4;

  
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ImageSize the static model class
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
		return '{{ImageSize}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('maxWidth, maxHeight, landscape, imagesPerRow, newPage', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, maxWidth, maxHeight', 'safe', 'on'=>'search'),
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
			'documents' => array(self::HAS_MANY, 'Document', 'imageSizeId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'maxWidth' => 'Max Width',
			'maxHeight' => 'Max Height',
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
		$criteria->compare('maxWidth',$this->maxWidth);
		$criteria->compare('maxHeight',$this->maxHeight);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}