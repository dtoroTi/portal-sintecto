<?php

/**
 * This is the model class for table "{{ListSuppliers}}".
 *
 * The followings are the available columns in table '{{ListSuppliers}}':
 * @property integer $id
 * @property string $name
 * @property string $typeDoc
 * @property string $document
 * @property string $phone
 * @property string $email
 * @property string $cityService
 * @property string $address
 * @property string $price
 * @property integer $serviceProvidedId
 *
 * The followings are the available model relations:
 * @property ServiceProvided $serviceProvided
 */
class ListSuppliers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ListSuppliers}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('serviceProvidedId', 'numerical', 'integerOnly'=>true),
			array('name, document, phone, email, cityService', 'length', 'max'=>255),
			array('typeDoc', 'length', 'max'=>5),
			array('address', 'length', 'max'=>200),
			array('price', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, typeDoc, document, phone, email, cityService, address, price, serviceProvidedId', 'safe', 'on'=>'search'),
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
			'serviceProvided' => array(self::BELONGS_TO, 'ServiceProvided', 'serviceProvidedId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			// 'id' => 'ID',
			'name' => 'Nombre',
			'typeDoc' => 'Tipo de Documento',
			'document' => 'Numero de Documento',
			'phone' => 'Telefono',
			'email' => 'Email',
			'cityService' => 'Ciudad de Servicio',
			'address' => 'Direccion',
			'price' => 'Tarifa',
			'serviceProvidedId' => 'Servicio Prestado',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('typeDoc',$this->typeDoc,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('cityService',$this->cityService,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('serviceProvidedId',$this->serviceProvidedId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ListSuppliers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getExportListSuppliers(){

		$criteria = new CDbCriteria;
		$criteria->with = array(
			'serviceProvided'
		);

		$criteria->order = 't.id DESC';

		$reports = ListSuppliers::model()->findAll($criteria);
		return $reports;
	}

	public function getTypeDocument() {
		$ansStr = "";
		switch($this->typeDoc){

			case 'CC':
				$pr = "Cedula";
				break;
			case 'NIT':
				$pr = 'Nit';
				break;
			case 'TI':
				$pr = 'Tarjeta Identidad';
				break;
			case 'RC':
				$pr = 'Registro Civil';
				break;
		}
		$ansStr = $pr;

		return $ansStr;
	}
}
