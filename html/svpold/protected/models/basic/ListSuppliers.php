<?php

/**
 * Clase ListSuppliers
 *
 * Esta clase representa un proveedor de lista y gestiona la información relacionada con los proveedores.
 */
class ListSuppliers extends CActiveRecord
{
	/**
     * @var integer Identificador único del proveedor.
     */
    public $id;

    /**
     * @var string Nombre del proveedor.
     */
    public $name;

    /**
     * @var string Tipo de documento del proveedor (CC, NIT, TI, RC, etc.).
     */
    public $typeDoc;

    /**
     * @var string Número de documento del proveedor.
     */
    public $document;

    /**
     * @var string Número de teléfono del proveedor.
     */
    public $phone;

    /**
     * @var string Correo electrónico del proveedor.
     */
    public $email;

    /**
     * @var string Ciudad donde se ofrece el servicio.
     */
    public $cityService;

    /**
     * @var string Dirección del proveedor.
     */
    public $address;

    /**
     * @var string Tarifa del proveedor.
     */
    public $price;

    /**
     * @var integer Identificador del servicio proporcionado por el proveedor.
     */
    public $serviceProvidedId;

    /**
     * @inheritdoc
     */
	public function tableName()
	{
		return '{{ListSuppliers}}';
	}

	/**
     * @inheritdoc
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
     * @inheritdoc
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
     * @inheritdoc
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
     * @inheritdoc
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

	/**
     * Obtiene la lista de proveedores para exportar.
     *
     * @return array La lista de proveedores para exportar.
     */
	public static function getExportListSuppliers(){

		$criteria = new CDbCriteria;
		$criteria->with = array(
			'serviceProvided'
		);

		$criteria->order = 't.id DESC';

		$reports = ListSuppliers::model()->findAll($criteria);
		return $reports;
	}

	/**
     * Obtiene el tipo de documento formateado del proveedor.
     *
     * @return string El tipo de documento formateado.
     */
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
