<?php

/**
 * This is the model class for table "{{InvoiceVisitCost}}".
 *
 * The followings are the available columns in table '{{InvoiceVisitCost}}':
 * @property integer $id
 * @property string $businessLine
 * @property string $descriptionCost
 * @property string $totalVisitCost
 *
 * The followings are the available model relations:
 * @property CustomerProduct[] $customerProducts
 * @property InvoiceVisitDetail[] $invoiceVisitDetails
 */
class InvoiceVisitCost extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{InvoiceVisitCost}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('businessLine', 'length', 'max'=>50),
			array('descriptionCost', 'length', 'max'=>150),
			array('totalVisitCost', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, businessLine, descriptionCost, totalVisitCost', 'safe', 'on'=>'search'),
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
			'customerProducts' => array(self::HAS_MANY, 'CustomerProduct', 'costVisitId'),
			'invoiceVisitDetails' => array(self::HAS_MANY, 'InvoiceVisitDetail', 'costVisitId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'businessLine' => 'Linea de negocio',
			'descriptionCost' => 'Descripción del Costo',
			'totalVisitCost' => 'Total Costo Visita',
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
		$criteria->compare('businessLine',$this->businessLine,true);
		$criteria->compare('descriptionCost',$this->descriptionCost,true);
		$criteria->compare('totalVisitCost',$this->totalVisitCost,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvoiceVisitCost the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getSummaryLineVisit() {
        return "{$this->businessLine} : {$this->descriptionCost} ";
    }

}
