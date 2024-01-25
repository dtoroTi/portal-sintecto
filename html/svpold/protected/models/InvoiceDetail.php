<?php

/**
 * This is the model class for table "{{InvoiceDetail}}".
 *
 * The followings are the available columns in table '{{InvoiceDetail}}':
 * @property integer $id
 * @property integer $invoiceId
 * @property integer $productId
 * @property double $qty
 * @property double $unitValue
 * @property string $unitType
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Invoice $invoice
 * @property Product $product
 */
class InvoiceDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{InvoiceDetail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('invoiceId, productId', 'required'),
			array('invoiceId, productId', 'numerical', 'integerOnly'=>true),
			array('qty, unitValue', 'numerical'),
			array('unitType', 'length', 'max'=>10),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, invoiceId, productId, qty, unitValue, unitType, description', 'safe', 'on'=>'search'),
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
			'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoiceId'),
			'product' => array(self::BELONGS_TO, 'Product', 'productId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'invoiceId' => 'Factura',
			'productId' => 'Producto',
			'qty' => 'Cantidad',
			'unitValue' => 'Costo Unitario',
			'unitType' => 'Unidad',
			'description' => 'Descripción',
                        'total'=> 'Total',
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
		$criteria->compare('invoiceId',$this->invoiceId);
		$criteria->compare('productId',$this->productId);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('unitValue',$this->unitValue);
		$criteria->compare('unitType',$this->unitType,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvoiceDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getTotal(){
            return ($this->qty * $this->unitValue);
        }
}
