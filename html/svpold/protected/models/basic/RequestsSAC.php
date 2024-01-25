<?php

use RequestsSAC as GlobalRequestsSAC;

/**
 * This is the model class for table "{{RequestsSAC}}".
 *
 * The followings are the available columns in table '{{RequestsSAC}}':
 * @property integer $id
 * @property integer $backgroundcheckId
 * @property integer $idUserRequest
 * @property integer $deliveryDays
 * @property string $typeRequest
 * @property string $dateRequest
 * @property string $dateAnswer
 * @property string $shockedby
 * @property string $status
 * @property string $observation
 *
 * The followings are the available model relations:
 * @property BackgroundCheck $backgroundcheck
 * 
 * @property string $backgroundcheckCode
 * @property string $backgroundcheckidNumber
 * @property string $backgroundcheckFirstname
 * @property string $backgroundcheckLastname
 * @property string $customerBusinessLine
 * @property string $backgroundcheckApplyToPosition
 * @property string $customerName
 * @property string $customerProductName
 * @property string $dateUpdate
 * @property string $observationOPS
 */
class RequestsSAC extends CActiveRecord
{
	public $backgroundcheckCode=null;
	public $backgroundcheckidNumber=null;
	public $backgroundcheckFirstname=null;
	public $backgroundcheckLastname=null;
	public $customerBusinessLine=null;
	public $backgroundcheckApplyToPosition=null;
	public $customerName=null;
	public $customerProductName=null;
	public $userName=null;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{RequestsSAC}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('backgroundcheckId, typeRequest, dateRequest','required'),
			array('backgroundcheckId, userId, deliveryDays', 'numerical', 'integerOnly'=>true),
			array('typeRequest, shockedby, status', 'length', 'max'=>50),
			array('id, backgroundcheckId, userId, typeRequest, dateRequest, dateAnswer, shockedby, status, observation, deliveryDays, dateUpdate, observationOPS', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, backgroundcheckId, userId, typeRequest, dateRequest, dateAnswer, shockedby, status, observation, deliveryDays, backgroundcheckCode, backgroundcheckidNumber, backgroundcheckFirstname, backgroundcheckLastname, customerBusinessLine, backgroundcheckApplyToPosition, customerName, customerProductName, userName, dateUpdate, observationOPS', 'safe', 'on'=>'search'),
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
			'backgroundcheck' => array(self::BELONGS_TO, 'BackgroundCheck', 'backgroundcheckId'),
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
			/*'backgroundcheck' => array(
                self::HAS_MANY,
                'BackgroundCheck',
                'backgroundcheckId',
            ),*/
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'backgroundcheckId' => 'Referencia Estudio de Seguridad',
			'userId' => 'Persona que solicita',
			'typeRequest' => 'Tipo de Solicitud',
			'dateRequest' => 'Fecha de Solicitud por SAC',
			'dateAnswer' => 'Fecha de Entrega Ops a SAC',
			'deliveryDays'=>'Días de Entrega',
			'shockedby' => 'Eslabón Prioritario',
			'status' => 'Estado',
			'observation' => 'Observación de SAC',
			'dateUpdate'=> 'Fecha Actualización',
			'observationOPS'=>'Observación de OPS'
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
	public function search($pagesize=100)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('backgroundcheckId',$this->backgroundcheckId);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('typeRequest',$this->typeRequest,true);
		$criteria->compare('dateRequest',$this->dateRequest,true);
		$criteria->compare('dateAnswer',$this->dateAnswer,true);
		$criteria->compare('deliveryDays',$this->deliveryDays,true);
		$criteria->compare('shockedby',$this->shockedby,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('observation',$this->observation,true);
		$criteria->compare('backgroundcheck.code', $this->backgroundcheckCode,true);
		$criteria->compare('backgroundcheck.idNumber', $this->backgroundcheckidNumber,true);
		$criteria->compare('backgroundcheck.firstName', $this->backgroundcheckFirstname,true);
		$criteria->compare('backgroundcheck.lastName', $this->backgroundcheckLastname,true);
		$criteria->compare('customer.businessLine', $this->customerBusinessLine,true);
		$criteria->compare('backgroundcheck.applyToPosition', $this->backgroundcheckApplyToPosition,true);
		$criteria->compare('customer.name', $this->customerName,true);
		$criteria->compare('customerProduct.name', $this->customerProductName,true);
		$criteria->compare('user.username', $this->userName,true);
		$criteria->compare('dateUpdate',$this->dateUpdate,true);
		$criteria->compare('observationOPS',$this->observationOPS,true);
		
		$criteria->with=['backgroundcheck.customerProduct', 'backgroundcheck.customer', 'user'];

		GridViewFilter::setFilter($this, 'search');

		return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
				'pageSize' => $pagesize,
            ),
            'sort' => array(
                'defaultOrder' => 't.id DESC',
            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestsSAC the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getDateBackground($id)
	{
		$criteria = new CDbCriteria;

        $criteria->addCondition("t.id=:id");
        $criteria->with=['customerProduct','customer'];
        $criteria->params=[':id'=>$id,];
        $datebackground= BackgroundCheck::model()->findAll($criteria);
        
        $datebackgroundRequests=[];
  
        foreach ($datebackground as $date){
            $datebackgroundRequests[]=[
                'businessLine'=>$date->customer->businessLine,
                'code'=>$date->code,
                'idNumber'=>$date->idNumber,
                'applyToPosition'=>$date->applyToPosition,
                'Nombre'=>($date->firstName.' '.$date->lastName),
				'nameProduct'=>$date->customerProduct->name,
				'nameCliente'=>$date->customer->name
            ];
        }
        
		return $datebackgroundRequests;
	}

	public static function getExportRequestsSAC(){

		$criteria = new CDbCriteria;
        $criteria->with = array(
            'backgroundcheck.customerProduct',
            'backgroundcheck.customer',
            'backgroundcheck',
            'user'
        );

        $criteria->order = 't.id DESC';

        $reports = RequestsSAC::model()->findAll($criteria);
        return $reports;
	}
}
